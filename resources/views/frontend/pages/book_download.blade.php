@extends('frontend.master')

@section('title')
    Book Category
@endsection

@section('styles')
    <style>
        .card_height {
            height: 65px;
        }
    </style>
@endsection

@section('main-content')
    <main class="main">
        <div class="features-section bg-gray">
            <div class="container">
                <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » বইয়ের ধরণ</h5>
                <div class="row mt-5">
                    <div class="col-lg-8 mx-auto">
                        <img src="{{ !empty($book->image) ? asset('upload/book_image/' . $book->image) : null }}"
                            class="rounded mx-auto d-block" alt="" height="400" width="400">
                        <div class="text-center mt-2">
                            <p >{!! $book->name !!}</p>
                            <button  class="btn btn-success btn-sm mb-2">Download</button>
                        </div>



                    </div><!-- End .col-lg-3 -->
                </div><!-- End .row -->

            </div><!-- End .container -->
        </div><!-- End .features-section -->
    </main>
@endsection

@section('scripts')

@endsection
