@extends('backend.layouts.backend_master')

@section('title')
    Social
@endsection
@section('styles')
    <style>
        
    </style>
@endsection


@section('admin-content')
<section class="py-3">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Social Link</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('social_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">FaceBook</label>
                                    <input 
                                        type="text" 
                                        name="facebook" 
                                        id="facebook"
                                        class="form-control" value="{{ old('facebook', $social->facebook ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Instagram</label>
                                    <input 
                                        type="text" 
                                        name="instagram" 
                                        id="instagram"
                                        class="form-control" value="{{ old('instagram', $social->instagram ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Twitter</label>
                                    <input 
                                        type="text" 
                                        name="twitter" 
                                        id="twitter"
                                        class="form-control" data-height="100" value="{{ old('twitter', $social->twitter ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Youtube</label>
                                    <input 
                                        type="text" 
                                        name="youtube" 
                                        id="youtube"
                                        class="form-control" data-height="100" value="{{ old('youtube', $social->youtube ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Tiktok</label>
                                    <input 
                                        type="text" 
                                        name="tiktok" 
                                        id="tiktok"
                                        class="form-control" data-height="100" value="{{ old('tiktok', $social->tiktok ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Linkedin</label>
                                    <input 
                                        type="text" 
                                        name="linkedin" 
                                        id="linkedin"
                                        class="form-control" data-height="100" value="{{ old('linkedin', $social->linkedin ?? '') }}">
                                    <span class="text-danger" id="image-input-error"></span>
                                </div>
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
                url: "{{ route('logo_media_upload') }}",
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