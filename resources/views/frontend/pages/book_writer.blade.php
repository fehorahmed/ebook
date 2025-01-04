@extends('frontend.master')

@section('title')
    Book Writer
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
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » লেখক</h5>
            <script>
                {{ $adShow->writer_page_ad_one ?? '' }}
            </script>
            <div class="row mt-5">
                @foreach ($writers as $writer)
                    <div class="col-lg-3">
                        <div class="card card_height shadow">
                            <a href="{{ route('writer_wise_book', encrypt($writer->id)) }}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $writer->name ?? '' }}</h5>
                                </div>
                            </a>
                        </div>
                    </div><!-- End .col-lg-3 -->
                @endforeach
            </div><!-- End .row -->
            <script>
                {{ $adShow->writer_page_ad_two ?? '' }}
            </script>
            <script>
                {{ $adShow->writer_page_ad_three ?? '' }}
            </script>
            <script>
                {{ $adShow->writer_page_ad_four ?? '' }}
            </script>
            <script>
                {{ $adShow->writer_page_ad_five ?? '' }}
            </script>
        </div><!-- End .container -->
    </div><!-- End .features-section -->

</main>
@endsection

{{-- @section('scripts')

@endsection --}}
