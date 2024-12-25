<div class="page-header">
    <div class="page-header-title">
        <h4>
            @if (Route::is('testimonials.index'))
                Testimonial List
            @elseif(Route::is('testimonials.create'))
                Create New Testimonial    
            @elseif(Route::is('testimonials.edit'))
                Edit Testimonial
            @elseif(Route::is('testimonials.show'))
                View Testimonial
            @endif
        </h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            @if (Route::is('testimonials.index'))
                <li class="breadcrumb-item" aria-current="page">Testimonial List</li>
            @elseif(Route::is('testimonials.create'))
                <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimonial List</a></li>
                <li class="breadcrumb-item" aria-current="page">Create New Testimonial</li>
            @elseif(Route::is('testimonials.edit'))
                <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimonial List</a></li>
                <li class="breadcrumb-item" aria-current="page">Edit Testimonial</li>
            @elseif(Route::is('testimonials.show'))
                <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">Testimonial List</a></li>
                <li class="breadcrumb-item" aria-current="page">Show Testimonial</li>
            @endif
        </ul>
    </div>
</div>