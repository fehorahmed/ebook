<?php

namespace App\Http\Controllers\Front;

use Artisan;
use Session;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Writer;
use Illuminate\Support\Str;
use App\Models\BookCategory;
use App\Models\UserTraining;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Models\BookPageContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Session::get('customerId');
            // dd($this->user);
            return $next($request);
        });
    }


    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->terms = 1;
            $user->registered_by = 'google';
            $user->user_type = 'customer';
            $user->status = 'active';
            $user->payment_method_status = 'inactive';
            $user->registered_at = now();
            //process profile
            $fileContents = file_get_contents($data->avatar);
            $filename = $data->id . '.jpg';
            Storage::disk('public')->put('upload/avatar_images/' . $filename, $fileContents);
            $user->avatar = $filename;

            $user->save();
            $user->attachRole('customer');
        }
        Auth::login($user);
    }

    public function passwordUpdate()
    {
        $trainings = UserTraining::with('training', 'training.videos', 'trainingExam', 'trainingExam.questions')->where('user_id', auth()->user()->id)->get();
        $purchaseTrainingCategories = $this->purchaseTrainingCategories($trainings);
        return view('frontend.users.password_update', compact('purchaseTrainingCategories'));
    }

    public function storePasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);
        $user = User::select('id', 'password')->where('id', auth()->user()->id)->first();

        $checkPassword = Hash::check($request->old_password, $user->password);
        if ($checkPassword) {
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success_message', "Password updated successfully");
            return redirect()->back();
        }
        session()->flash('error_message', "Password do not match");
        return redirect()->back();
    }

    public function userDashboard()
    {
        $userData = Session::get('customerId');
        $user = User::find($userData);
        $books = Book::count();
        return view('frontend.users.dashboard',compact('userData','user','books'));
    }

    public function customerProfile()
    {

        $userData = Session::get('customerId');
        $user = User::where('id', $userData)->first();
        return view('frontend.users.customer_profile', compact('user'));
    }

    public function customerProfileUpdate(Request $request)
    {
        $request->validate([
            'email'  => 'required|email|unique:users,email,' . Session::get('customerId'),
            'name' => 'required|string|max:255',
        ]);

        $user = User::find(Session::get('customerId'));
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        session()->flash('success', 'Details has been updated successfully !!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'  => 'required|min:6',
            'password' => 'confirmed|min:6|different:old_password'
        ]);

        $user = User::where('id', $this->user)->first();
        if (Hash::check($request->old_password, $user->password)) {
            $user = User::find(Session::get('customerId'));
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Password Mismatch!');
        }
    }

    public function customerLogin()
    {
        $user = User::first();
        return view('frontend.users.customer_login',compact('user'));
    }

    public function customerRegister(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            User::create([
                'name' => null,
                'email' => $request->email,
                'user_type' => 'customer',
                'password' => Hash::make($request->password),
            ]);
        }else{
            return redirect()->back()->with('error', 'User Already exists! Please log in.');
        }

        return redirect()->back()->with('success', 'Registration successful! Please log in.');
    }
    public function customerLoginPost(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','min:6'],
        ]);

        $un = $request->email;
        $pw = Hash::make($request->password);

        $data = DB::table('users')->where('email' , $un)->first(['password' , 'id']);

        if($data){
            if(Hash::check($request->password, $data->password)) {
                session(['customerId' => $data->id]);
                return redirect('customer/dashboard');
            }else{
                return redirect()->back()->with('error', 'Please Enter Correct Password');
            }
        }else{
            return redirect()->back()->with('error', 'Please Enter Correct E-mail');
        }
    }

    public function logout() {

        Session::flush();
        Artisan::call('view:clear');
        return redirect('customer/dashboard');
    }

    public function bookStore(Request $request) {
            // dd($request->all());
            $request->validate([
                'name' => 'required',
                'short_description' => 'required',
                'image' => 'required',
            ]);
            try {
                DB::beginTransaction();
                    $book = new Book();
                    $book->name = $request->name;
                    $book->user_id = Session::get('customerId');
                    $book->category_id = $request->category_id;
                    $book->writer_id = $request->writer_id;
                    $book->description = $request->short_description;
                    // dd($book->description);
                    $book->status = 1;
                    if (!is_null($request->image)) {
                        $book->image = UploadHelper::upload('book_image', $request->image, Str::slug($request->name) . '-' . time(), 'upload/book_image');
                    }
                    $book->save();
                    $counter = 0;
                    foreach($request->content_name as $content){
                        // dd($request->content_name);
                        BookPageContent::create([
                            'book_id' => $book->id,
                            'content_name' => $request->content_name[$counter],
                            'description' => $request->description[$counter]
                        ]);
                        $counter++;
                    }

                DB::commit();
                session()->flash('success', 'Book has been Inserted successfully !!');
                return redirect()->back();
            } catch (\Exception $e) {
                session()->flash('sticky_error', $e->getMessage());
                DB::rollBack();
                return back();
            }
    }

    public function ownBookList($id){
        $data = decrypt($id);
        $books = book::where('user_id', $data)->get();
        // dd($book);
        return view('frontend.users.own_bool_list',compact('books'));
    }
}
