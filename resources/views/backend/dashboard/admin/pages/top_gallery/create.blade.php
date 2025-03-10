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
                        <h6>Portfolio Header</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('gallery_header') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Top Title</label>
                                    <input type="text" name="top_title" value="{{ old('top_title', $galleryHeader->top_title ?? '' ) }}" id="top_title" class="form-control">
                                    @error('top_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" value="{{ old('sub_title', $galleryHeader->sub_title ?? '' ) }}" id="sub_title" class="form-control">
                                    @error('sub_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Portfolio Section Background Color</label>
                                    <input type="color" name="background_color" value="{{ old('background_color', $galleryHeader->background_color ?? '' ) }}" id="background_color" class="form-control w-100" style="height: 60px;">
                                    @error('background_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Top Title Text Color</label>
                                    <input type="color" name="top_title_text_color" value="{{ old('background_color', $galleryHeader->top_title_text_color ?? '' ) }}" id="top_title_text_color" class="form-control w-100" style="height: 60px;">
                                    @error('top_title_text_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Sub Title Text Color</label>
                                    <input type="color" name="sub_title_text_color" value="{{ old('sub_title_text_color', $galleryHeader->sub_title_text_color ?? '' ) }}" id="sub_title_text_color" class="form-control w-100" style="height: 60px;">
                                    @error('sub_title_text_color')
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
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row py-2">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Add New Portfolio Info</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form action="{{ route('top-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Profile</label>
                                    <input type="file" name="image" id="image" data-height="100" class="form-control dropify">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="background_color">Youtube link</label>
                                    <input type="text" class="form-control" id="background_color" name="background_color" value="{{ old('background_color') }}" placeholder="Enter Link" />
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Video</label>
                                    <input type="file" name="video" id="video" data-height="100" class="form-control dropify">
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
                                <input type="submit" class="btn btn-info" value="Submit">
                                <a href="{{ route('top-gallery.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-1">
    <div class="row">
        @include('backend.layouts.partials.messages')
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Portfolio List</h6>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        {{-- <div class="float-lg-end">
                            <a href="{{ route('top-gallery.create') }}" class="btn btn-info float-right">Add new</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table table-bordered table-striped align-items-center mb-0" id="users_table">
                <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sl No</th>
                    <th width="20%" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th> --}}
                    <th class="text-secondary opacity-7">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($topGallery as $item)
                    <tr>
                    <td><p class="text-xs font-weight-medium mb-0">{{ $loop->iteration }}</p></td>
                    <td class="align-middle text-center">
                        <span>
                        <img src="{{ asset('upload/portfolio/'.$item->image) }}" alt="" height="40">
                        </span>
                    </td>
                    <td>
                        {{-- <a class="btn waves-effect waves-light btn-info btn-sm-custom ml-1" title="Edit User Details" href="{{ route('users.show', $item->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a> --}}
                        <a class="btn waves-effect waves-light btn-success btn-sm-custom ml-1" title="Edit User Details" href="{{ route('top-gallery.edit', $item->id) }}">
                            <i class="fa fa-edit"></i></i>
                        </a>
                        <button class="btn waves-effect waves-light btn-danger btn-sm-custom ml-1 text-white deleteItem" title="Delete User" data-id="{{$item->id}}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <form id="deleteForm{{$item->id}}" action="{{route('top-gallery.destroy', [$item->id])}}" method="post" style="display:none">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
                                    class="icofont icofont-check"></i> Confirm Delete</button>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-times"></i> Cancel</button>
                        </form>
                    </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</section>
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
