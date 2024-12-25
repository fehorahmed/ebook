@extends('backend.layouts.master')
@section('title')
    Create Article
@endsection
@section('styles')
@endsection
@section('admin-content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                @include('backend.layouts.partials.messages')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <h3>Create Article</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('articles.index') }}" class="btn btn-info"> <i class="icofont icofont-list"></i> Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('question') }}" placeholder="Enter Title" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control custom-select" id="status" name="status" required>
                                            <option value="publish" {{ old('status') == "publish" ? 'selected' : null }}>Publish</option>
                                            <option value="save" {{ old('status') == "save" ? 'selected' : null }}>Saved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="keywords">Keywords</label>
                                        <input type="text" class="form-control"id="keywords" name="keywords" value="{{ old('keywords') }}" placeholder="keyword1, keyword2, keyword3 ..."/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="image">Image <span class="text-info">( Recommended Size: 1200px X 630px )</span></label>
                                        <input type="file" class="form-control dropify" data-height="150" id="image" name="image" data-allowed-file-extensions="png jpg jpeg webp svg" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="body">Body</label>
                                        <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"> <i class="icofont icofont-check"></i> Save</button>
                                    <a href="{{ route('articles.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{-- <script src="https://cdn.tiny.cloud/1/n2iv0diopcuozmksn987ie6x60nmiyypcobdf664yf0grwgj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script src="{{ asset('js/upload.js') }}"></script> --}}
<script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".dropify").dropify();
        CKEDITOR.replace('body');
        CKEDITOR.replace('description');
    });
</script>
@endsection
