<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\AuthContent;
use App\Models\Country;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $auth_page = AuthContent::first();
        return view('auth.register', compact('auth_page'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => ['required', 'confirmed', Password::min(8)],
            'terms' => 'required'
        ],[
            'terms.required' => 'Please check terms and privacy checkbox.'
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->terms = $request->terms;
        $user->registered_by = 'web';
        $user->user_type = 'customer';
        $user->status = 'active';
        $user->payment_method_status = 'inactive';
        $user->registered_at = now();
        $user->save();
        $user->attachRole('customer');

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}