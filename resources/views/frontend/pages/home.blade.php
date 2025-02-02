@extends('frontend.master')

@section('title')
    Home
@endsection

@section('styles')
    <style>
        .card-body {
            min-height: 0px;

        }

        .card_height {
            height: 365px;
        }

        .card_size {
            height: 65px;
        }


        @media only screen and (max-width: 1200px) {
            .new-products-section .container {
                min-width: 100%;
            }

            .new-products-section .container .col-md-2 {
                min-width: 25%;
                display: block;
            }

            .card_height {
                height: auto;
            }

            .new-products-section .container .col-md-2 .card {
                width: 100% !important;
            }

            .new-products-section .container .col-md-2 .card p {
                text-align: center;
            }
        }




        @media only screen and (max-width: 768px) {
            .new-products-section .container .col-md-2 {
                width: 33% !important;
                display: block;
            }
        }


        @media only screen and (max-width: 550px) {
            .new-products-section .container .col-md-2 {
                width: 50% !important;
                display: block;
            }
        }



        @media only screen and (max-width: 400px) {
            .new-products-section .container .col-md-2 {
                width: 100% !important;
                display: block;
            }
        }
    </style>
@endsection

@section('main-content')
    <main class="main">
        <section class="new-products-section">
            <div class="container">
                <h4>সাম্প্রতিক বই</h4>

                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-2">
                            <a href="{{ route('book_details', $book->slug) }}">
                                <div class="card shadow card_height" style="width: 18rem;">
                                    <img src="{{ !empty($book->image) ? asset('upload/book_image/' . $book->image) : null }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $adShow->home_page_ad_one ?? '' !!}
                </div>
            </div>
            <div class="container">
                <h4>জনপ্রিয় বই</h4>
                <div class="row">
                    @foreach ($popularBooks as $book)
                        <div class="col-md-2">
                            <a href="{{ route('book_details', $book->slug) }}">
                                <div class="card shadow card_height" style="width: 18rem;">
                                    <img src="{{ !empty($book->image) ? asset('upload/book_image/' . $book->image) : null }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                {!! $adShow->home_page_ad_three ?? '' !!}
            </div>
            <div class="container">
                <h4>সেবা প্রকাশনী</h4>
                <div class="row">
                    @foreach ($categoryBooks as $book)
                        <div class="col-md-2">
                            <a href="{{ route('book_details', $book->slug) }}">
                                <div class="card shadow card_height" style="width: 18rem;">
                                    <img src="{{ !empty($book->image) ? asset('upload/book_image/' . $book->image) : null }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-md-hide">
                    {!! $adShow->home_page_ad_three ?? '' !!}
                </div>

            </div>
            <div class="container">
                <h4>ইসলামিক বই</h4>
                <div class="row">
                    @foreach ($islamicBooks as $book)
                        <div class="col-md-2">
                            <a href="{{ route('book_details', $book->slug) }}">
                                <div class="card shadow card_height" style="width: 18rem;">
                                    <img src="{{ !empty($book->image) ? asset('upload/book_image/' . $book->image) : null }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">

                {!! $adShow->home_page_ad_three ?? '' !!}
            </div>
            <div class="container">
                <h4>বইয়ের ধরণ</h4>
                <div class="row mt-5">
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="card card_size shadow">
                                <a href="{{ route('category_wise_book', encrypt($category->id)) }}">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $category->name ?? '' }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div><!-- End .col-lg-3 -->
                    @endforeach
                </div><!-- End .row -->
            </div><!-- End .container -->
            <div class="row">
                <div class="col-md-4">
                    {!! $adShow->home_page_ad_two ?? '' !!}
                </div>
                <div class="col-md-2">
                    {!! $adShow->home_page_ad_four ?? '' !!}
                </div>
                <div class="col-md-4">
                    {!! $adShow->home_page_ad_two ?? '' !!}
                </div>
                <div class="col-md-2">
                    {!! $adShow->home_page_ad_four ?? '' !!}
                </div>
            </div>

            {{-- {!! $adShow->home_page_ad_five ?? '' !!} --}}

        </section>
    </main>
@endsection

@section('scripts')
@endsection
