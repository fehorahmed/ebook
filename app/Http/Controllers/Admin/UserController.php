<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Order;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

    /**
     * admin login
     */
    public function adminLogin()
    {
        if(!empty(Auth::check())){
            if(Auth::check()){
                return redirect('admin/dashboard');
            }
        }
        return view('backend.auth.login');
    }
    /**
     * admin login post
     */
    public function adminLoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid Email and Password');
        }
    }
    /**
     * admin logout
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('name', '!=', 'Admin')->orderBy('id', 'desc')->get();

        return view('backend.dashboard.admin.users.index', compact('user'));
    }


    public function create()
    {
        return view('backend.dashboard.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => ['required', Password::min(8)],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->registered_at = \Carbon\Carbon::now();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/avatar_images'), $filename);
            $user->avatar = $filename;
        }
        $user->registered_by = 'admin';
        $user->user_type = 'customer';
        $user->save();
        $user->attachRole('customer');
        session()->flash('success', 'New User has been created successfully !!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        return view('backend.dashboard.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => ['nullable', Password::min(8)],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->status = $request->status;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/avatar_images'), $filename);
            $user->avatar = $filename;
        }
        $user->save();

        session()->flash('success', 'User has been Updated successfully !!');
        return redirect()->route('users.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }
        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        $orders = Order::with('user')->where('user_id', $user->id)->whereIn('order_status', ['accepted', 'delivered', 'canceled'])->orderBy('id', 'desc')->get();
        return view('backend.dashboard.admin.users.show', compact('user', 'orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->name == 'Admin') {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        if ($user->avatar) {
            UploadHelper::deleteFile('upload/avatar_images/' . $user->avatar);
        }
        $user->delete();

        session()->flash('success', 'User has been deleted permanently !!');
        return redirect()->back();
    }

    /**
     * verify
     *
     * @param integer $id
     * @return Remove the item from trash to active -> make deleted_at = null
     */
    public function verify($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        $user->email_verified_at = now();
        $user->save();

        session()->flash('success', 'User verified successfully !!');
        return redirect()->back();
    }

    /**
     * verify
     *
     * @param integer $id
     * @return Remove the item from trash to active -> make deleted_at = null
     */
    public function unverify($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        $user->email_verified_at = null;
        $user->save();

        session()->flash('success', 'User unverified successfully !!');
        return redirect()->back();
    }



    /**
     * verify
     *
     * @param integer $id
     * @return Remove the item from trash to active -> make deleted_at = null
     */
    public function blocked($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        $user->blocked = 1;
        $user->save();

        session()->flash('success', 'User blocked successfully !!');
        return redirect()->back();
    }

    /**
     * verify
     *
     * @param integer $id
     * @return Remove the item from trash to active -> make deleted_at = null
     */
    public function unblocked($id)
    {
        if (is_null($this->user) || !$this->user->hasRole('admin')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
        }

        $user = User::find($id);
        if (is_null($user)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('users.index');
        }
        $user->blocked = 0;
        $user->save();

        session()->flash('success', 'User unblocked successfully !!');
        return redirect()->back();
    }

    /**
     * trashed
     *
     * @return view the trashed data list -> which data status = 0 and deleted_at != null
     */
    // public function verified()
    // {
    //     if (is_null($this->user) || !$this->user->hasRole('admin')) {
    //         $message = 'You are not allowed to access this page !';
    //         return view('errors.403', compact('message'));
    //     }
    //     return $this->index('email_verified_at');
    // }
    /**
     * trashed
     *
     * @return view the trashed data list -> which data status = 0 and deleted_at != null
     */
    // public function unverified()
    // {
    //     if (is_null($this->user) || !$this->user->hasRole('admin')) {
    //         $message = 'You are not allowed to access this page !';
    //         return view('errors.403', compact('message'));
    //     }
    //     return $this->index('email_verified_at');
    // }


}
