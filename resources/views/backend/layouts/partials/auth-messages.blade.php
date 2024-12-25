@if (Session::has('register_success'))
    <div class="alert alert-success mb-2">
        {!! Session::get('register_success') !!}
    </div>
@endif

@if (Session::has('login_error'))
    <div class="alert alert-danger mb-2">
        {!! Session::get('login_error') !!}
    </div>
@endif

