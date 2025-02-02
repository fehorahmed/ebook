@extends('backend.layouts.backend_master')
@section('title')
    {{-- @include('backend.admin.users.partials.title') --}}
@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .btn-sm-custom {
            padding: 5px 5px;
            line-height: 16px;
            font-size: 16px;
        }

        .btn-sm-custom i {
            margin-right: 0px !important;
        }

        .social-widget-card-custom {
            cursor: pointer;
        }

        #users_table_filter {
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
                            <h6>Add Book Information</h6>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="category_id">Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{old('category_id') == $category->id ?'selected':''}}>
                                                    {{ $category->name ?? '' }}</option>
                                            @endforeach
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Writer <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="writer_id" name="writer_id">
                                            <option value="">--Select Writer--</option>
                                            @foreach ($writers as $writer)
                                                <option value="{{ $writer->id }}" {{old('writer_id') == $writer->id ?'selected':''}}>
                                                    {{ $writer->name ?? '' }}</option>
                                            @endforeach
                                            @error('writer_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" id="name"
                                            class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">--Select Status--</option>
                                            <option value="1" {{old('status') == '1' ?'selected':''}}> Active
                                            </option>
                                            <option value="0" {{old('status') == '0' ?'selected':''}}>
                                                Inactive</option>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" data-height="100"
                                            class="form-control dropify">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Description</label>
                                        <textarea class="summernote" name="short_description">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Page Content Setup</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30%">Content Title Name</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="product-container">
                                        @if (old('content_name') != null && sizeof(old('content_name')) > 0)
                                            @foreach (old('content_name') as $item)
                                                <tr class="product-item">
                                                    <td>
                                                        <div
                                                            class="form-group {{ $errors->has('content_name.' . $loop->index) ? 'has-error' : '' }}">
                                                            <input type="text" name="content_name[]"
                                                                class="form-control content_name"
                                                                value="{{ old('content_name.' . $loop->index) }}"
                                                                placeholder="Enter Title Name">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div
                                                            class="form-group {{ $errors->has('description.' . $loop->index) ? 'has-error' : '' }}">
                                                            <textarea class="form-control description summernote" name="description[]" name="description[]">{{ old('description.' . $loop->index) }}</textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" name="content_name[]"
                                                            class="form-control content_name"
                                                            placeholder="Enter Title Name">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <textarea class="summernote" name="description[]"></textarea>
                                                    </div>
                                                </td>


                                                <td class="text-center">
                                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>
                                                <a role="button" class="btn btn-info btn-sm" id="btn-add-product">Add
                                                    More</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h5>Ad Setup</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 80%">Ad Link</th>
                                            <th>Ad Count</th>
                                            <th>Ad Coin</th>
                                        </tr>
                                    </thead>

                                    <tbody id="product-container-two">

                                        <tr class="product-item-two">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" name="ad_link" value="{{ old('ad_link') }}"
                                                        class="form-control" placeholder="Enter Link">
                                                    @error('ad_link')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" name="ad_count" value="{{ old('ad_count') }}"
                                                        class="form-control ad_count" placeholder=" Total Count">
                                                    @error('ad_count')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" name="ad_coin" value="{{ old('ad_coin') }}"
                                                        class="form-control ad_coin" placeholder=" Total Coin">
                                                    @error('ad_coin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                    {{-- <tfoot>
                                <tr>
                                    <td>
                                        <a role="button" class="btn btn-info btn-sm" id="btn-add-product-two">Add More</a>
                                    </td>
                                </tr>
                                </tfoot> --}}
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="" class="form-label"></label>
                                        <input type="submit" class="btn btn-info" value="Submit">
                                        <a href="{{ route('book.index') }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <template id="template-product">
            <tr class="product-item">
                <td>
                    <div class="form-group">
                        <input type="text" name="content_name[]" class="form-control content_name"
                            placeholder="Enter Title Name">
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <textarea class="summernote" name="description[]"></textarea>
                    </div>
                </td>

                <td class="text-center">
                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                </td>
            </tr>
        </template>


    </section>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();

            $('#users_table').DataTable({
                aLengthMenu: [
                    [10, 25, 50, 100, 1000, -1],
                    [10, 25, 50, 100, 1000, "All"]
                ],
                "columnDefs": [{
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

            $('#btn-add-product').click(function() {
                // alert('ok');
                var html = $('#template-product').html();
                // console.log(html);
                var item = $(html);
                $('#product-container').append(item);

                // initProduct();

                if ($('.product-item').length >= 1) {
                    $('.btn-remove').show();
                }

                $('.summernote').summernote();
            });

            $('body').on('click', '.btn-remove', function() {
                $(this).closest('.product-item').remove();
                calculate();

                if ($('.product-item').length <= 1) {
                    $('.btn-remove').hide();
                }
            });



            $(document).ready(function() {
                $('.summernote').summernote();
            });
        });
    </script>
@endsection
