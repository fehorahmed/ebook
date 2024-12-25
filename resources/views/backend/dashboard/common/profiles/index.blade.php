@extends('backend.layouts.backend_master')
@section('title')

@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="row">
    <div class="col-md-12">
        @include('backend.layouts.partials.messages')
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="card-header-text">Personal Info</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('update_user_details') }}" method="POST" data-parsley-validate data-parsley-focus="first">
                    @csrf
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $userData->email ?? '' }}" placeholder="Enter Email" required=""/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="email">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $userData->name ?? '' }}" required=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info"> Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
                <h6 class="card-header-text">Change Password</h6>
            </div>
            <div class="card-body">
                <form id="passwordForm" name="passwordForm" method="POST" data-parsley-validate data-parsley-focus="first">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="old_password">Old Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" required=""/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="password">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required=""/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm Password" required=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info" id="updateBtn"> <i class="icofont icofont-check"></i> Update</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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