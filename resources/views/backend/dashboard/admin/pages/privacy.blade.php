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
                        <h6>Privacy Policy</h6>
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
                    <form action="{{ route('privacy.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_type" value="1">
                        @method('POST')
                       <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="main_title">Main Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="main_title" name="main_title" value="{{ old('main_title', $privacy->main_title ?? '') }}">
                                @error('main_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                       </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea class="form-control" id="editor" name="description">{{ old('description', $privacy->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       <div class="row">
                       </div>
                       <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label for="" class="form-label"></label>
                                <input type="submit" class="btn btn-info" value="Update">
                                <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
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
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            CKEDITOR.replace('body');
            CKEDITOR.replace('description');
        });
    </script>
@endsection