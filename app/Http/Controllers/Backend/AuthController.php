<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Artisan;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function adminLogin()
    {
        if (!empty(Auth::check())) {
            return redirect('/dashboard');
        }else{
            return view('backend.auth.login');
        }
    }

    public function authCheck(Request $req){

        $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required','min:6'],
        ]);

        $un = $req->email;
        $pw = Hash::make($req->password);

        $data = DB::table('users')->where('email' , $un)->first(['password' , 'id']);

        if($data){
            if(Hash::check($req->password, $data->password)) {
                session(['authId' => $data->id]);
                return redirect('/dashboard');
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
        return redirect('/admin');
    }
}
