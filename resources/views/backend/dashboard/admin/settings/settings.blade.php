@extends('backend.layouts.backend_master')

@section('title')

@endsection
@section('styles')
    <style>
        
    </style>
@endsection


@section('admin-content')
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Site Logo</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('logo_media_upload') }}" method="POST" id="image-upload" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="inputImage">Site Logo</label>
                                <input 
                                    type="file" 
                                    name="site_logo" 
                                    id="inputImage"
                                    class="form-control dropify dropify-event" data-height="100" data-default-file="{{ isset($settingData->site_logo) ? asset('upload/site_logo/'.$settingData->site_logo) : null }}">
                                <span class="text-danger" id="image-input-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="inputImage">Admin Logo</label>
                                <input 
                                    type="file" 
                                    name="admin_logo" 
                                    id="adminInputImage"
                                    class="form-control dropify dropify-event" data-height="100" data-default-file="{{ isset($settingData->admin_logo) ? asset('upload/site_logo/'.$settingData->admin_logo) : null }}">
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