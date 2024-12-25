<style>
    .page-header-title h5{
        margin-left: 26px;
    }
    /* .create_page, h5{
        margin-left: 3px;
    } */
</style>
<div class="page-header mt-2">
    <div class="page-header-title create_page">
        <h5>
            @if (Route::is('users.index'))
                User List
            @elseif(Route::is('users.show'))
                View User
            @elseif(Route::is('users.edit'))
                User Edit
            @elseif(Route::is('users.create'))
                Add New
            @endif
        </h5>
    </div>
    {{-- <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            @if (Route::is('users.index'))
                <li class="breadcrumb-item" aria-current="page">User List</li>
            @elseif(Route::is('users.show'))
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User List</a></li>
                <li class="breadcrumb-item" aria-current="page">Show User</li>
            @elseif(Route::is('users.edit'))
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Edit</a></li>
                <li class="breadcrumb-item" aria-current="page">User Edit</li>
            @endif
        </ul>
    </div> --}}
</div>