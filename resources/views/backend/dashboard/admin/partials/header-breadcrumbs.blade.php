<div class="page-header">
    <div class="page-header-title">
        <h4>Hello, @if(Auth::user()->first_name && Auth::user()->last_name) {{ Auth::user()->first_name .' '. Auth::user()->last_name }} @else {{ Auth::user()->name }} @endif Welcome to Your Dashboard</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
        </ul>
    </div>
</div>