@extends('frontend.master')

@section('title')
    Home
@endsection

@section('styles')
<style>
    .card-body{
        min-height:0px;

    }
    .card_height{
        height: 365px;
    }
    .card_size{
        height: 65px;
    }
    section{
        padding-top: 0 !important;
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


    select.form-control:not([size]):not([multiple]) {
        height: 4rem!important;
    }


</style>
@endsection

@section('main-content')
<main class="main">
    <section class="new-products-section">
        <div class="container">
            <h5 class="subtitle"><a href="{{ route('home') }}">লাইব্রেরি</a> » Own Book</h5>
           <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-2">
                        <a href="{{ route('book_details', encrypt($book->id)) }}">
                            <div class="card shadow card_height" style="width: 18rem;">
                                <img src="{{ (!empty($book->image)) ? asset('upload/book_image/'. $book->image) : null }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <p class="card-text">{{ $book->name ?? '' }}-{{ $book->writer->name ?? '' }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
           </div>
        </div>
    </section>
</main>
@endsection

{{-- @section('scripts')

@endsection --}}
