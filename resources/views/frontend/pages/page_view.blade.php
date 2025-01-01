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
                    {{-- {{dd($req_data)}} --}}

                    <div class="col-md-12 text-center p-2">
                        @if ($nextPage)
                            @php

                                $req_data['bookSlug'] = $book->slug;
                                $req_data['slug'] = $nextPage->slug;
                            @endphp
                            @if ($game_app_request)
                                <a href="{{ route('page_view', $req_data) }}" class="btn btn-primary">Next Page</a>
                            @else
                                <a href="{{ route('page_view', ['bookSlug' => $book->slug, 'slug' => $nextPage->slug]) }}"
                                    class="btn btn-primary">Next Page</a>
                            @endif
                        @else
                            @if ($game_app_request)
                                <a href="{{ route('book_gift_coin', [
                                    'slug' => $book->slug,
                                    'other_user' => isset($req_data['other_user']) ? $req_data['other_user'] : null,
                                    'other_visiting_id' => isset($req_data['other_visiting_id']) ? $req_data['other_visiting_id'] : null,
                                    'other_url' => isset($req_data['other_url']) ? $req_data['other_url'] : null,
                                ]) }}"
                                    id="gift_coin_id" class="btn btn-success btn-sm">Get Coin</a>
                            @endif
                        @endif

                    </div>
                </div>
            </div><!-- End .container -->
        </div><!-- End .features-section -->
    </main>
@endsection

@section('scripts')
    <script></script>
@endsection
