@extends('backend.layouts.backend_master')

@section('title', 'Portfolio Create')

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
                        <h6>Edit Portfolio</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            <a href="{{ route('top-gallery.create') }}" class="btn btn-info float-right">back to list</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('top-gallery.update', $editData->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" data-height="100" class="form-control dropify" data-default-file="{{ isset($editData->image) ? asset('upload/portfolio/'.$editData->image) : null }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="background_color">Youtube link</label>
                                    <input type="text" class="form-control" id="background_color" name="background_color" value="{{ old('background_color') ?? $editData->background_color }}" placeholder="Enter Link" />
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Video</label>
                                    <input type="file" name="video" id="video" data-height="100" class="form-control dropify" data-default-file="{{ isset($editData->video) ? asset('upload/portfolio/'.$editData->video) : null }}">
                                    @error('video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                                <a href="{{ route('top-gallery.create') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
        });
    </script>
@endsection
