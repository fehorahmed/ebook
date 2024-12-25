@if (Route::is('users.index'))
    Users
@elseif(Route::is('users.show'))
    View User - {{ $user->name }}
@endif
    | Admin Panel -
    @prop(app_name)
