@extends('backend.layouts.backend_master')

@section('title')
    Pricing
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
                        <h6>Pricing</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('pricing_setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Basic Video Per Minute Price</label>
                                    <input 
                                        type="number"
                                        step="0.01" 
                                        name="basic_video_per_minute_price" 
                                        id="basic_video_per_minute_price"
                                        class="form-control" value="{{ old('basic_video_per_minute_price', $pricing->basic_video_per_minute_price ?? '') }}">
                                        @error('basic_video_per_minute_price')
                                            <span class="text-danger" id="image-input-error">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Pro Animation Video Per Minute Price</label>
                                    <input 
                                        type="number" 
                                        step="0.01"
                                        name="pro_animation_video_per_minute_price" 
                                        id="pro_animation_video_per_minute_price"
                                        class="form-control" value="{{ old('pro_animation_video_per_minute_price', $pricing->pro_animation_video_per_minute_price ?? '') }}">
                                        @error('pro_animation_video_per_minute_price')
                                            <span class="text-danger" id="image-input-error">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Youtube Video Per Minute Price</label>
                                    <input 
                                        type="number" 
                                        step="0.01"
                                        name="youtube_video_per_minute_price" 
                                        id="youtube_video_per_minute_price"
                                        class="form-control" data-height="100" value="{{ old('youtube_video_per_minute_price', $pricing->youtube_video_per_minute_price ?? '') }}">
                                        @error('youtube_video_per_minute_price')
                                            <span class="text-danger" id="image-input-error">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Corporate Video Per Minute Price</label>
                                    <input 
                                        type="number" 
                                        step="0.01"
                                        name="corporate_video_per_minute_price" 
                                        id="corporate_video_per_minute_price"
                                        class="form-control" data-height="100" value="{{ old('corporate_video_per_minute_price', $pricing->corporate_video_per_minute_price ?? '') }}">
                                        @error('corporate_video_per_minute_price')
                                            <span class="text-danger" id="image-input-error">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="inputImage">Fast Delivery Price</label>
                                    <input 
                                        type="number" 
                                        step="0.01"
                                        name="fast_delivery_price" 
                                        id="fast_delivery_price"
                                        class="form-control" data-height="100" value="{{ old('fast_delivery_price', $pricing->fast_delivery_price ?? '') }}">
                                        @error('fast_delivery_price')
                                            <span class="text-danger" id="image-input-error">{{ $message }}</span>
                                        @enderror
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