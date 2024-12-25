@extends('frontend.master')

@section('title')
    Book Category
@endsection

@section('styles')
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

    </style>
@endsection

@section('main-content')
<main class="main">
    <div class="features-section bg-gray">
        <div class="container">
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » বইয়ের ধরণ</h5>
            <div class="row mt-5">
                @foreach ($categories as $category)
                    <div class="col-lg-3">
                           <a href="{{ route('category_wise_book', encrypt($category->id)) }}">
                                <div class="card card_height shadow">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $category->name ?? '' }}</h5>
                                    </div>
                                </div>
                           </a>
                    </div><!-- End .col-lg-3 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .features-section -->

</main>
@endsection

{{-- @section('scripts')

@endsection --}}
