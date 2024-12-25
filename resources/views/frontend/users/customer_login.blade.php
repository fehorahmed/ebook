@extends('frontend.master')

@section('title')
    Book Writer
@endsection

@section('styles')
    <style>
        .card_height{
            height: 65px;
        }
    </style>
@endsection

@section('main-content')
<main class="main">
    <main class="main">
        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    @include('_message')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Login</h2>
                            </div>

                            <form action="{{ route('customer_login_post') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="login-email">
                                    Username Email address
                                    <span class="required">*</span>
                                </label>
                                <input type="email" name="email" class="form-input form-wide" id="login-email" required />

                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" class="form-input form-wide" id="login-password" required />
                                <button type="submit" class="btn btn-dark btn-md w-100 mt-3">
                                    LOGIN
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Register</h2>
                            </div>
                            <form action="{{ route('customer_registration') }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="register-email">
                                    Email address
                                </label>
                                <input type="email" name="email" class="form-input form-wide" id="register-email"/>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <label for="register-password">
                                    Password
                                </label>
                                <input type="password" name="password" class="form-input form-wide" id="register-password"
                                    />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                <label for="confirm-password">
                                    Confirm Password
                                </label>
                                <input type="password" name="confirm_password" class="form-input form-wide" id="confirm-password"
                                />
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                <div class="form-footer mb-2">
                                    <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

</main>
@endsection

@section('scripts')

@endsection
