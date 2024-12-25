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
                <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » বইয়ের পেজ</h5>
                <div class="row mt-5">
                    <div class="col-lg-8 mx-auto">
                        <div>
                            <h4>{{ $bookPage->content_name ?? '' }}</h4>
                        </div>
                        <div>
                            <p>{!! $bookPage->description ?? '' !!}</p>
                        </div>
                    </div><!-- End .col-lg-3 -->
                </div><!-- End .row -->
                <div class="row">

                </div>
            </div><!-- End .container -->
        </div><!-- End .features-section -->
    </main>
@endsection

@section('scripts')
    <script>


    </script>
@endsection
