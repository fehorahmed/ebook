@extends('backend.layouts.backend_master')
@section('title')
    {{-- @include('backend.admin.users.partials.title') --}}
@endsection
@section('styles')
    <style>
        .btn-sm-custom{
            padding: 5px 5px;
            line-height: 16px;
            font-size: 16px;
        }
        .btn-sm-custom i {
            margin-right: 0px !important;
        }
        .social-widget-card-custom{
            cursor: pointer;
        }

        #users_table_filter{
            text-align: right;
        }
    </style>
@endsection
@section('admin-content')
<section>
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Footer top images</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('footer_tops_upload') }}" method="POST" id="image-upload" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="inputImage">Top image</label>
                                <input 
                                    type="file" 
                                    name="footer_top_image" 
                                    id="inputImage"
                                    class="form-control dropify dropify-event" data-height="100" data-default-file="{{ isset($footer->footer_top_image) ? asset('upload/footer_top_image/'.$footer->footer_top_image) : null }}">
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="inputImage">Middle image</label>
                                <input 
                                    type="file" 
                                    name="footer_middle_image" 
                                    id="adminInputImage"
                                    class="form-control dropify dropify-event" data-height="100" data-default-file="{{ isset($footer->footer_middle_image) ? asset('upload/footer_middle_image/'.$footer->footer_middle_image) : null }}">
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Update</button>
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
                        <h6>Footer</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        {{-- <div class="float-lg-end">
                            <a href="{{ route('top-gallery.index') }}" class="btn btn-info float-right">back to list</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('footer_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Privacy Policy</label>
                                    <input type="text" name="privacy_policy" value="{{ old('title', $footer->privacy_policy ?? '') }}" id="privacy_policy" id="privacy_policy" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Terms of Service</label>
                                    <input type="text" name="term" value="{{ old('title', $footer->term ?? '') }}" id="term" id="term" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Copy Right</label>
                                    <input type="text" name="copy_right" value="{{ old('title', $footer->copy_right ?? '') }}" id="copy_right" id="copy_right" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Footer Background Color</label>
                                    <input type="color" name="background_color" value="{{ old('background_color', $footer->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Footer Text Hover Color</label>
                                    <input type="color" name="text_hover_color" id="text_hover_color" value="{{ old('text_hover_color', $footer->text_hover_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Footer Text Color</label>
                                    <input type="color" name="text_color" id="text_color" value="{{ old('text_color', $footer->text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Location Text Color</label>
                                    <input type="color" name="location_text_color" value="{{ old('location_text_color', $footer->location_text_color ?? '') }}" id="location_text_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Contact Text Color</label>
                                    <input type="color" name="contact_text_color" value="{{ old('contact_text_color', $footer->contact_text_color ?? '') }}" id="contact_text_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Social Icon Color</label>
                                    <input type="color" name="social_icon_color" id="social_icon_color" value="{{ old('social_icon_color', $footer->social_icon_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('text_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Social Link Background Color</label>
                                    <input type="color" name="social_background_color" id="social_background_color" value="{{ old('social_background_color', $footer->social_background_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('social_background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">About Us Text Color</label>
                                    <input type="color" name="about_us_text_color" value="{{ old('about_us_text_color', $footer->about_us_text_color ?? '') }}" id="about_us_text_color" class="form-control w-100" style="height: 60px;">
                                    @error('about_us_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Copy Right Text Color</label>
                                    <input type="color" name="copy_right_text_color" id="copy_right_text_color" value="{{ old('copy_right_text_color', $footer->copy_right_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('copy_right_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Footer link Color</label>
                                    <input type="color" name="footer_links_color" id="footer_links_color" value="{{ old('footer_links_color', $footer->footer_links_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('footer_links_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Footer link hover Color</label>
                                    <input type="color" name="footer_links_hover_color" id="footer_links_hover_color" value="{{ old('footer_links_hover_color', $footer->footer_links_hover_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                    @error('footer_links_hover_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Location</label>
                                    <input type="text" name="location" value="{{ old('location', $footer->location ?? '') }}"  class="form-control">
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $footer->phone ?? '') }}" class="form-control">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Email One</label>
                                    <input type="email" name="email_one" value="{{ old('email_one', $footer->email_one ?? '') }}" class="form-control">
                                    @error('email_one')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Email Two</label>
                                    <input type="email" name="email_two" value="{{ old('email_two', $footer->email_two ?? '') }}" class="form-control">
                                    @error('email_two')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">About Us</label>
                                <textarea name="about_us" rows="5" class="form-control">{{ old('about_us', $footer->about_us ?? '') }}</textarea>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                                {{-- <a href="{{ route('top-gallery.index') }}" class="btn btn-danger">Cancel</a> --}}
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#inputImage').change(function(){
            let reader = new FileReader();

            reader.onload = (e) => {
                $('#preview-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

        $('#adminInputImage').change(function(){    
            let reader = new FileReader();
       
            reader.onload = (e) => { 
                $('#admin-preview-image').attr('src', e.target.result); 
            }   
      
            reader.readAsDataURL(this.files[0]); 
         
        });

        $('#image-upload').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');

            $.ajax({
                type:'POST',
                url: "{{ route('footer_tops_upload') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        toastr.success(response.message);
                    }
                },
                error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
                }
           });
        });

        $(document).ready(function(){
            $('.dropify').dropify();

            var drEvent = $('.dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                // return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                // alert('File deleted');
            });
        })
    </script>
@endsection
