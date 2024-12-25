@extends('frontend.master')

@section('title')
    Book Writer
@endsection

@section('styles')
    <style>
        .card_height{
            height: 65px;
        }
    </style>
@endsection

@section('main-content')
<main class="main">
    <div class="features-section bg-gray">
        <div class="container">
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » লেখক</h5>
             <h4 class="text-center">Customer Profile</h4>
             <h2 class="text-center">Books: {{ $books }}</h2>
             <h2 class="text-center">Completed: {{ 0 }}</h2>
             <h2 class="text-center">Certificates: {{ 0 }}</h2>
             <h2 class="text-center">Points: {{ 0 }}</h2>
        </div><!-- End .container -->
    </div><!-- End .features-section -->

</main>
@endsection

{{-- @section('scripts')

@endsection --}}
