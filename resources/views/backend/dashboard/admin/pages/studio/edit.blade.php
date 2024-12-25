@extends('backend.layouts.backend_master')

@section('title', 'User Create')

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
                        <h6>Edit Client Info</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="float-lg-end">
                            <a href="{{ route('studio.create') }}" class="btn btn-info float-right">back to list</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('studio.update', $editData->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="title" value="{{ old('title', $editData->title ?? '') }}" id="title" class="form-control">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Designation</label>
                                    <input type="text" name="genre" value="{{ old('genre', $editData->genre ?? '') }}" id="genre" class="form-control">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>  --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" data-height="100" class="form-control dropify" data-default-file="{{ isset($editData->image) ? asset('upload/studio/'.$editData->image) : null }}" alt="image">
                                    @error('image')
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
                                <a href="{{ route('studio.create') }}" class="btn btn-danger">Cancel</a>
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