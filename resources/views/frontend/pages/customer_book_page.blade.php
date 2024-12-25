@extends('frontend.master')

@section('title')
    Book Writer
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        .card_height {
            height: 200px;
            border-radius: 10px;
            position: relative;
        }

        .card_height h5 {
            font-size: 40px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
        }

        @media only screen and (max-width: 1200px) {
            .container {
                min-width: 100%;
            }
        }

        @media only screen and (max-width: 1000px) {
            .container .col-lg-3 {
                min-width: 33% !important;
                max-width: 33% !important;
            }

            .card_height h5 {
                font-size: 30px;
            }

        }
        @media only screen and (max-width: 550px) {
            .container .col-lg-3 {
                min-width: 50% !important;
                max-width: 50% !important;
            }
        }
        @media only screen and (max-width: 400px) {
            .container .col-lg-3 {
                min-width: 100% !important;
                max-width: 100% !important;
            }
        }
        .card-body a {
            text-decoration: none!important;
        }
        select.form-control:not([size]):not([multiple]) {
            height: 4rem!important;
        }
    </style>
@endsection

@section('main-content')
<main class="main">
    <div class="features-section bg-gray">
        <div class="container">
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » লেখক</h5>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    @include('_message')
                    <div class="heading mb-1">
                        <h2 class="title">Book Information</h2>
                    </div>
                    <form action="{{ route('book_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">
                                        Category
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="" selected>--Select Category--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('category_id') == 'active') selected @endif>{{ $category->name ?? '' }}</option>
                                        @endforeach
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>

                                    <label for="login-password">
                                        Book Name
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="name" class="form-input form-wide" id="name" required />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                        <label for="name">
                                            Writer
                                            <span class="required">*</span>
                                        </label>
                                        <select class="form-control" id="writer_id" name="writer_id">
                                            <option value="" selected>--Select Writer--</option>
                                            @foreach ($writers as $writer)
                                                <option value="{{ $writer->id }}" @if(old('writer_id') == 'active') selected @endif>{{ $writer->name ?? '' }}</option>
                                            @endforeach
                                            @error('writer_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </select>

                                        <label for="login-password">
                                            Book Image
                                            <span class="required">*</span>
                                        </label>
                                        <input type="file" name="image" class="form-input form-wide" id="image" required />
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="login-password">
                                        Book Description
                                        <span class="required">*</span>
                                    </label>
                                    <textarea name="short_description" id="summernote" class="from-control"></textarea>
                                </div>
                            </div>
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
                                        @foreach(old('content_name') as $item)
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group {{ $errors->has('content_name.'.$loop->index) ? 'has-error' :'' }}">
                                                        <input type="text"  name="content_name[]" class="form-control content_name" value="{{ old('content_name.'.$loop->index) }}" placeholder="Enter Title Name">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group {{ $errors->has('description.'.$loop->index) ? 'has-error' :'' }}">
                                                        <textarea class="form-control description summernote" id="summernote" name="description[]" value="{{ old('description.'.$loop->index) }}" name="description[]"></textarea>
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
                                                    <input type="text" name="content_name[]" class="form-control content_name" placeholder="Enter Title Name">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <textarea class="summernote" id="summernote" name="description[]"></textarea>
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
                                            <a role="button" class="btn btn-success btn-sm text-white" id="btn-add-product">Add More</a>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100 mt-3">
                                Submit
                            </button>
                    </form>
                </div>
                <template id="template-product">
                    <tr class="product-item">
                        <td>
                            <div class="form-group">
                                <input type="text" name="content_name[]" class="form-control content_name" placeholder="Enter Title Name">
                            </div>
                        </td>

                        <td>
                            <div class="form-group">
                                <textarea class="summernote" id="summernote" rows="5" cols="70" name="description[]"></textarea>
                            </div>
                        </td>
                        <td class="text-center">
                            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                        </td>
                    </tr>
                </template>
            </div>
        </div><!-- End .container -->
    </div><!-- End .features-section -->



</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script>
    $('#summernote').summernote({
      placeholder: 'Enter Text',
      tabsize: 2,
      height: 100
    });

    $(document).ready(function(){

            $('#btn-add-product').click(function () {
                // alert('ok');
                var html = $('#template-product').html();
                // console.log(html);
                var item = $(html);
                $('#product-container').append(item);

                // initProduct();

                if ($('.product-item').length >= 1 ) {
                    $('.btn-remove').show();
                }

                $('.summernote').summernote();
            });

            $('body').on('click', '.btn-remove', function () {
                $(this).closest('.product-item').remove();
                if ($('.product-item').length <= 1 ) {
                    $('.btn-remove').hide();
                }
            });

            $(document).ready(function() {
                $('.summernote').summernote();
            });

    });
</script>
@endsection
