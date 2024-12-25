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
<div class="row">
    <div class="card">
        <div class="card-header pb-0">
            <div class="row">
                <div class="col-lg-6 col-7">
                    <h6>Subscribe</h6>
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
                <form action="{{ route('subscribe_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Title</label>
                                <input type="text" name="title" value="{{ old('title', $subscribe->title ?? '') }}" id="title" id="title" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Button Text</label>
                                <input type="text" name="button_text"  value="{{ old('button_text', $subscribe->button_text ?? '') }}" id="button_text" class="form-control">
                                @error('button_text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="padding-right: 2px;">
                            <div class="form-group">
                                <label for="" class="form-label">Button Text Hover Color</label>
                                <input type="color" name="button_text_hover_color" data-height="150" value="{{ old('button_text_hover_color', $subscribe->button_text_hover_color ?? '') }}" id="button_text_hover_color" class="form-control w-100" style="height: 60px;">
                                @error('button_text_hover_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label">Button Border Color</label>
                                <input type="color" name="button_border_color" id="button_border_color" value="{{ old('button_border_color', $subscribe->button_border_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                @error('button_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label">Background Color</label>
                                <input type="color" name="background_color" value="{{ old('background_color', $subscribe->background_color ?? '') }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                @error('background_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label">Button Hover Border</label>
                                <input type="color" name="button_hover_border_color" value="{{ old('button_hover_border_color', $subscribe->button_hover_border_color ?? '') }}" id="button_hover_border_color" class="form-control w-100" style="height: 60px;">
                                @error('button_hover_border_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label">Button Hover Color</label>
                                <input type="color" name="button_hover_color" value="{{ old('button_hover_color', $subscribe->button_hover_color ?? '') }}" id="button_hover_color" class="form-control w-100" style="height: 60px;">
                                @error('button_hover_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="" class="form-label">Button Text Color</label>
                                <input type="color" name="button_text_color" id="button_text_color" value="{{ old('button_text_color', $subscribe->button_text_color ?? '') }}" data-height="150" class="form-control w-100" style="height: 60px;">
                                @error('button_text_color')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                   </div> 
                   <div class="col-md-12">
                    <div class="form-group">
                        <label for="" class="form-label">Button Background Color</label>
                        <input type="color" name="button_background_color" value="{{ old('button_background_color', $subscribe->button_background_color ?? '') }}" id="button_background_color" class="form-control w-100" style="height: 60px;">
                        @error('button_background_color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
@endsection
    
@section('scripts')
    <script type="text/javascript">
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

            $('.verifyUser').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "User will be verified!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3fc3ee",
                    confirmButtonText: "Yes, verify it!"
                }).then((result) => {
                    if (result.value) {
                        $("#verifyForm"+id).submit();
                    }
                })
            });

            $('.unverifyUser').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "User will be unverified!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3fc3ee",
                    confirmButtonText: "Yes, unverify it!"
                }).then((result) => {
                    if (result.value) {
                        $("#unverifyForm"+id).submit();
                    }
                })
            });

            $('.deleteItem').on('click',function(){
                let id = $(this).data('id')
                swal.fire({ 
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        $("#deleteForm"+id).submit();
                    }
                })
            });
        });
    </script>
@endsection
