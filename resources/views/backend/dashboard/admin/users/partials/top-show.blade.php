<div class="col-md-6 col-xl-4" onclick="location.href='{{ route('users.index') }}'">
    <div class="card social-widget-card social-widget-card-custom">
        <div class="card-block-big bg-primary">
            <h3>{{ $count_users }}</h3>
            <span class="m-t-10">Total Users</span>
            <i class="icofont icofont-ui-user-group"></i>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4" onclick="location.href='{{ route('users.verified') }}'">
    <div class="card social-widget-card social-widget-card-custom">
        <div class="card-block-big bg-success">
            <h3>{{ $count_verified_users }}</h3>
            <span class="m-t-10">Verified Users</span>
            <i class="icofont icofont-ui-user-group"></i>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4" onclick="location.href='{{ route('users.unverified') }}'">
    <div class="card social-widget-card social-widget-card-custom">
        <div class="card-block-big bg-danger">
            <h3>{{ $count_unverified_users }}</h3>
            <span class="m-t-10">Unverified Users</span>
            <i class="icofont icofont-ui-user-group"></i>
        </div>
    </div>
</div>
