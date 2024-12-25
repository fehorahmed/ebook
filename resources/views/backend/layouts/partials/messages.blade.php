@if (Session::has('sticky_error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        {!! Session::get('sticky_error') !!}
    </div>
@endif

@if (Session::has('sticky_success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <i class="icofont icofont-close-line-circled"></i>
        </button>
        {!! Session::get('sticky_success') !!}
    </div>
@endif

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

@if ($errors->any())
<div class="alert alert-danger mb-2">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <i class="icofont icofont-close-line-circled"></i>
    </button>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
@endif

