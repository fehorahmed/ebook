@extends('backend.layouts.master')
@section('title')
    Edit resource
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
                                <h3>Edit resource</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('resources.index') }}" class="btn btn-info"> <i class="icofont icofont-list"></i> Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="{{ route('resources.update', $resource->id) }}" enctype="multipart/form-data" method="POST" data-parsley-validate data-parsley-focus="first">
                            @csrf
                            @method('put')
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="title">title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $resource->title }}" placeholder="Enter Title" required=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="answer">Location <span class="text-danger">*</span></label>
                                        <select class="form-control" name="location" required>
                                            <option value="" selected disabled>Please Select...</option>
                                            @foreach (["footer", "articles"] as $i)
                                                <option value="{{ $i }}" @if ((old('location') ?? $resource->location) == $i) selected  @endif>{{ $i }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="file">File</label>
                                        <input type="file" class="form-control dropify" data-height="150" id="file" name="file"
                                        data-default-file="{{ asset('uploaded_files/files/'.$resource->name) ?? null }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"> <i class="icofont icofont-check"></i> Update</button>
                                    <a href="{{ route('resources.index') }}" class="btn btn-danger">Cancel</a>
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
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".dropify").dropify();
    });
</script>
@endsection
