@extends('frontend.master')

@section('title')
    Book Writer
@endsection

@section('styles')
    <style>
        .card_height {
            height: 200px;
            border-radius: 10px;
            position: relative;
        }

        .card_height h5 {
            font-size: 40px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
        }

        @media only screen and (max-width: 1200px) {
            .container {
                min-width: 100%;
            }
        }

        @media only screen and (max-width: 1000px) {
            .container .col-lg-3 {
                min-width: 33% !important;
                max-width: 33% !important;
            }

            .card_height h5 {
                font-size: 30px;
            }

        }
        @media only screen and (max-width: 550px) {
            .container .col-lg-3 {
                min-width: 50% !important;
                max-width: 50% !important;
            }
        }
        @media only screen and (max-width: 400px) {
            .container .col-lg-3 {
                min-width: 100% !important;
                max-width: 100% !important;
            }
        }
        .card-body a {
            text-decoration: none!important;
        }
    </style>
@endsection

@section('main-content')
<main class="main">
    <div class="features-section bg-gray">
        <div class="container">
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » লেখক</h5>
            <div class="row mt-5">
                @include('_message')
                <div class="col-lg-12 mx-auto">
                    <div class="card card_height shadow">
                        <h4 class="ml-4 mt-1">Personal Info</h4>
                        <div class="card-body">
                            <form action="{{ route('customer_profile_update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="login-email">
                                                Email
                                                <span class="required">*</span>
                                            </label>
                                            <input type="email" name="email" value="{{ $user->email ?? '' }}" class="form-input form-wide" id="login-email" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">
                                                Name
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" name="name" value="{{ $user->name ?? '' }}" class="form-input form-wide" id="name" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn-sm rounded"> Update</button>
                                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm rounded">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- End .row -->
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card card_height shadow">
                        <h4 class="ml-4 mt-1">Change Password</h4>
                        <div class="card-body">
                            <form action="{{ route('password_update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="Old_Password">
                                                Old Password
                                                <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" required=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="password">
                                                New Password
                                                <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="confirm_password">
                                                Confirm Password
                                                <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" required=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info btn-sm rounded"> Update</button>
                                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm rounded">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .features-section -->

</main>
@endsection

@section('scripts')
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // update password
        $('#updateBtn').click(function (e) {
            e.preventDefault();
            let formData = {
                old_password: $('#passwordForm input[name="old_password"').val(),
                password: $('#passwordForm input[name="password"').val(),
                password_confirmation: $('#passwordForm input[name="password_confirmation"').val(),
            };

            $.ajax({
                data: formData,
                type: "POST",
                url: "{{ route('update_password') }}",
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(response.success){
                       toastr.success(response.message);
                    }else{
                        toastr.error(response.message);
                    }

                },
                error: function (error) {
                    $.each(error.responseJSON.errors, function(index, value){
                        toastr.error(value);
                    })
                }
            });
        });

    });
</script>
@endsection
