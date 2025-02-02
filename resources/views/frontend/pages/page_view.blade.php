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
                <div class="row">
                    <div class="col-md-12">
                        {!! $adShow->home_page_ad_one ?? '' !!}
                    </div>
                </div>

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
                    {{-- {{dd($book)}} --}}

                    <div class="col-md-12 text-center p-2">
                        @if ($nextPage)
                            <span id="countdown_timer" class="countdown-text">Next Page in 30s</span>
                            @php

                                $req_data['bookSlug'] = $book->slug;
                                $req_data['slug'] = $nextPage->slug;
                            @endphp
                            @if ($game_app_request)
                                <a style="display: none;" href="{{ route('page_view', $req_data) }}" id="gift_coin_id"
                                    class="btn btn-primary">Next
                                    Page</a>
                            @else
                                <a style="display: none;" id="gift_coin_id"
                                    href="{{ route('page_view', ['bookSlug' => $book->slug, 'slug' => $nextPage->slug]) }}"
                                    class="btn btn-primary">Next Page</a>
                            @endif
                        @else
                            @if ($game_app_request)
                                <span id="countdown_timer" class="countdown-text">Next Page in 30s</span>
                                <a style="display: none;"
                                    href="{{ route('book_gift_coin', [
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

            </div><!-- End .container -->
        </div><!-- End .features-section -->
    </main>
@endsection

@section('scripts')
    <script>
        let clickCount = 0;
        var total_count = '{{ $book->ad_count ?? 0 }}';



        $('#gift_coin_id').click(function() {
            clickCount++;
            if (clickCount <= total_count) {
                // Prevent the default action of the link
                event.preventDefault();
                // Open the fixed URL in a new tab
                const fixedUrl = '{{ $book->ad_link }}';
                window.open(fixedUrl, '_blank');
            }
        })
        $(document).ready(function() {
            // Total countdown time in seconds
            let countdown = 30;

            // Function to update the countdown text
            function updateCountdown() {
                if (countdown > 0) {
                    $('#countdown_timer').text(`Next Page in ${countdown}s`); // Update countdown text
                    countdown--;
                } else {
                    clearInterval(timer); // Stop the countdown timer
                    $('#countdown_timer').hide(); // Hide the countdown text
                    $('#gift_coin_id').fadeIn(); // Show the button
                }
            }

            // Start the countdown
            updateCountdown(); // Initialize countdown
            var timer = setInterval(updateCountdown, 1000); // Update countdown every second
        });
    </script>
@endsection
