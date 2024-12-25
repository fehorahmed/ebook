@if (Route::is('testimonials.index'))
    Testimonials
@elseif(Route::is('testimonials.create'))
    Create New Testimonial
@elseif(Route::is('testimonials.edit'))
    Edit Testimonial - {{ $testimonial->title }}
@elseif(Route::is('testimonials.show'))
    View Testimonial - {{ $testimonial->title }}
@endif
    | Admin Panel -
    @prop(app_name)
