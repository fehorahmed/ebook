@extends('backend.layouts.backend_master')
@section('title')
   
@endsection
@section('styles')
    
@endsection

@section('admin-content')
<section>
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Navbar Section</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            {{-- <a href="{{ route('users.index') }}" class="btn btn-info float-right">back to list</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('nav_section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Navbar Background Color</label>
                                    <input type="color" name="background_color" value="{{ old('background_color', $navSection->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Menu Text Color</label>
                                    <input type="color" name="text_color" value="{{ old('text_color', $navSection->text_color ?? '') }}" id="text_color" class="form-control w-100" style="height: 60px;">
                                    @error('text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Menu Text Hover Color</label>
                                    <input type="color" name="text_hover_color" value="{{ old('text_hover_color', $navSection->text_hover_color ?? '') }}" id="text_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Border Hover</label>
                                    <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $navSection->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                        </div>    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Text Hover</label>
                                    <input type="color" name="button_text_hover_color" data-height="150" value="{{ old('button_text_hover_color', $navSection->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mx-0">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Border Color</label>
                                    <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $navSection->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Hover Color</label>
                                    <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $navSection->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $navSection->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Start Free Trial Button Background Color</label>
                                    <input type="color" name="button_background_color" value="{{ old('button_background_color', $navSection->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Login Button Text Color</label></label>
                                    <input type="color" name="login_text_color" value="{{ old('login_text_color', $navSection->login_text_color ?? '') }}" id="login_text_color" class="form-control" style="height: 60px;">
                                    @error('login_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Login Button Border Hover Color</label>
                                    <input type="color" name="login_hover_color" value="{{ old('login_hover_color', $navSection->login_hover_color ?? '') }}" id="login_hover_color" class="form-control" style="height: 60px;">
                                    @error('login_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ old('button_text', $navSection->button_text ?? '') }}" id="button_text" class="form-control">
                                    @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <div class="form-group">
                                    <label for="" class="form-label"></label>
                                    <input type="submit" class="btn btn-info" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
<section class="py-1">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Top Section</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            {{-- <a href="{{ route('users.index') }}" class="btn btn-info float-right">back to list</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                       <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Video Upload</label>
                                <input type="file" name="video" id="video" data-height="150" class="form-control dropify" data-default-file="{{ isset($data->video) ? asset('upload/videos/'.$data->video) : null }}">
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       </div> 
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-1">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Home Second Section</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            {{-- <a href="{{ route('users.index') }}" class="btn btn-info float-right">back to list</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('second_section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Image</label>
                                    <input type="file" name="section_image" id="section_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($second->section_image) ? asset('upload/second_section_image/'.$second->section_image) : null }}">
                                    @error('section_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Main Title</label>
                                <input type="text" name="main_title" value="{{ old('main_title', $second->main_title ?? '') }}" id="title" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Sub Title</label>
                                <input type="text" name="sub_title" value="{{ old('sub_title', $second->sub_title ?? '') }}" id="title" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       </div> 
                       <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Section Background Color</label>
                                <input type="color" name="background_color" value="{{ old('background_color', $second->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Button Border Hover Color</label>
                                <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $second->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                @error('button_hover_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Button Text Hover Color</label>
                                <input type="color" name="button_text_hover_color" data-height="150" value="{{ old('button_text_hover_color', $second->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                @error('button_text_hover_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mx-0">
                            <div class="form-group">
                                <label for="" class="form-label">Button Border Color</label>
                                <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $second->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                @error('button_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                       </div> 
                       <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ old('button_text', $second->button_text ?? '') }}" id="button_text" class="form-control">
                                    @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Color</label>
                                    <input type="color" name="button_background_color" value="{{ old('button_background_color', $second->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Hover Color</label>
                                    <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $second->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $second->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Main Title Color</label>
                                    <input type="color" name="main_title_color" id="main_title_color" value="{{ old('main_title_color', $second->main_title_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('main_title_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Sub Title Color</label>
                                    <input type="color" name="sub_title_color" id="sub_title_color" value="{{ old('sub_title_color', $second->sub_title_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('sub_title_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div>
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>  
<section class="py-1">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Home Third Section</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('third_section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Right Image</label>
                                    <input type="file" name="section_right_image" id="section_right_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($third->section_right_image) ? asset('upload/section_right_image/'.$third->section_right_image) : null }}">
                                    @error('section_right_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="top_title" class="form-label">Top Title </label>
                                    <input type="text" name="top_title" value="{{ old('top_title', $third->top_title ?? '') }}" id="top_title" class="form-control">
                                    @error('top_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="top_title_color" class="form-label">Top Title Color</label>
                                    <input type="color" name="top_title_color" id="top_title_color" value="{{ old('top_title_color', $third->top_title_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('top_title_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Description </label>
                                    <textarea name="description" rows="5" class="form-control">{{ old('description', $third->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Description Color</label>
                                    <input type="color" name="description_color" id="description_color" value="{{ old('description_color', $third->description_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('description_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div> 
                       <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Section Background Color</label>
                                <input type="color" name="background_color" value="{{ old('background_color', $third->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Button Border Hover Color</label>
                                <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $third->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                @error('button_hover_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="form-label">Button Text Hover Color</label>
                                <input type="color" name="button_text_hover_color" data-height="150" value="{{ old('button_text_hover_color', $third->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                @error('button_text_hover_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mx-0">
                            <div class="form-group">
                                <label for="" class="form-label">Button Border Color</label>
                                <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $third->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                @error('button_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                       </div> 
                       <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ old('button_text', $third->button_text ?? '') }}" id="button_text" class="form-control">
                                    @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Color</label>
                                    <input type="color" name="button_background_color" value="{{ old('button_background_color', $third->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Hover Color</label>
                                    <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $third->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $third->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div>
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
  
{{-- <section>
    <div class="row py-1">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Top Gallery</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('gallery_section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Left Image</label>
                                    <input type="file" name="section_left_image" id="section_left_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($gallery->section_left_image) ? asset('upload/gallery_section_image/'.$gallery->section_left_image) : null }}">
                                    @error('section_left_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Right Top Image</label>
                                    <input type="file" name="section_right_top_image" id="section_right_top_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($gallery->section_right_top_image) ? asset('upload/gallery_section_image/'.$gallery->section_right_top_image) : null }}">
                                    @error('section_right_top_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Right Bottom Left Image</label>
                                    <input type="file" name="section_right_bottom_left_image" id="section_right_bottom_left_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($gallery->section_right_bottom_left_image) ? asset('upload/gallery_section_image/'.$gallery->section_right_bottom_left_image) : null }}">
                                    @error('section_right_bottom_left_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Right Bottom Right Image</label>
                                    <input type="file" name="section_right_bottom_right_image" id="section_right_bottom_right_image" data-height="150" class="form-control dropify" data-default-file="{{ isset($gallery->section_right_bottom_right_image) ? asset('upload/gallery_section_image/'.$gallery->section_right_bottom_right_image) : null }}">
                                    @error('section_right_bottom_right_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Section Background Color</label>
                                    <input type="color" name="background_color" value="{{ old('background_color', $gallery->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3" style="padding-right: 2px;">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Hover Color</label>
                                    <input type="color" name="button_text_hover_color" data-height="150" value="{{ old('button_text_hover_color', $gallery->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Border Color</label>
                                    <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $gallery->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Hover Border Color</label>
                                    <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $gallery->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_border_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div> 
                       <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Hover Color</label>
                                    <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $gallery->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text Color</label>
                                    <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $gallery->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('button_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Background Color</label>
                                    <input type="color" name="button_background_color" value="{{ old('button_background_color', $gallery->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                                    @error('button_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ old('button_text', $gallery->button_text ?? '') }}" id="button_text" class="form-control">
                                    @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div> 
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>    --}}
{{-- <section class="py-1">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Home Gellery</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('top_gallery_section') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Top Title</label>
                                    <input type="text" name="top_title" id="top_title" class="form-control">
                                    @error('top_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" id="sub_title" class="form-control">
                                    @error('sub_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" data-height="100" class="form-control dropify">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Background Color</label>
                                    <input type="color" name="background_color" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Link</label>
                                    <input type="text" name="link" id="link" class="form-control">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> 
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- <section class="py-1">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table table-bordered table-striped align-items-center mb-0" id="users_table">
                    <thead>
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Top Title</th>
                        <th width="20%" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sub Title</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                        <th class="text-secondary opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($topGallery as $item)
                        <tr>
                        <td><p class="text-xs font-weight-medium mb-0">{{ $loop->iteration }}</p></td>
                        <td>
                            <p class="text-xs font-weight-medium mb-0">{{ $item->top_title }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bold">{{ $item->sub_title }}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="text-secondary text-xs font-weight-bold">{{ $item->link }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <span>
                            <img src="{{ asset('upload/top_section_image/'.$item->image) }}" alt="" height="40">
                            </span>
                        </td>
                        <td>
                            <a class="btn waves-effect waves-light btn-info btn-sm-custom ml-1" title="Edit User Details" href="{{ route('users.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            <a class="btn waves-effect waves-light btn-success btn-sm-custom ml-1" title="Edit User Details" href="{{ route('users.edit', $item->id) }}">
                                <i class="fa fa-edit"></i></i>
                            </a>
                            <button class="btn waves-effect waves-light btn-danger btn-sm-custom ml-1 text-white deleteItem" title="Delete User" data-id="{{$item->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            <form id="deleteForm{{$item->id}}" action="{{route('users.destroy', [$item->id])}}" method="post" style="display:none">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                        class="icofont icofont-check"></i> Confirm Delete</button>
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Cancel</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach  
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();

            $('#users_table').DataTable({
                aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        'bSortable': false,
                        'bSearchable': false,
                        "className": "text-center",
                        'aTargets': [-1]
                    }
                ]
            });
        });
    </script>
@endsection