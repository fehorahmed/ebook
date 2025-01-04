<style>
    .navDiv {
        /* background: #222529; */
        height: 50px;
        margin-bottom: 20px;
    }

    .navbar-brand {
        font-size: 30px;
        font-weight: bold;
        font-style: italic;
    }

    .navbar-nav {
        justify-content: flex-end;
    }

    .navbar {
        padding: 10px !important;
    }

    .nav-link {
        font-size: 18px;
        margin: 0 5px;
    }

    .loginBtn {
        padding: 5px 15px !important;
        border-radius: 5px;
        background: #3d7542;
        color: #fff !important;
        font-size: 17px;
        font-weight: bold;
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

        .image_height {
            margin-top: 5px;
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

        .image_height {
            margin-top: 5px;
        }
    }



    @media only screen and (max-width: 400px) {
        .new-products-section .container .col-md-2 {
            width: 100% !important;
            display: block;
        }

        .image_height {
            margin-top: 5px;
        }
    }
</style>

<div class="navDiv">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container"> <!-- centers Navbar elements in a container -->

                <a class="navbar-brand" href="/">{{env('APP_NAME','e-Library')}}</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto"><!-- ml-auto shifts nav items to right -->
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('all_book') ? 'active' : '' }}"
                                href="{{ route('all_book') }}">
                                নতুন সব বই
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('book_writer') ? 'active' : '' }}"
                                href="{{ route('book_writer') }}">
                                লেখক
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                সিরিজ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('book_category') ? 'active' : '' }}"
                                href="{{ route('book_category') }}">
                                বইয়ের ধরণ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                পুরানো সব ক্যাটাগরি
                            </a>
                        </li>

                        @if (session('customerId'))
                            @php
                                $user = App\Models\User::where('id', '=', session('customerId'))->first();
                            @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $user->name ?? '' }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('book_page') }}">Book</a>
                                    <a class="dropdown-item"
                                        href="{{ route('own_book_list', encrypt(session('customerId'))) }}">নিজ বই</a>
                                    <a class="dropdown-item" href="{{ route('customer_profile') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('customer_logout') }}">Logout</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link loginBtn" href="{{ route('customer_login') }}">
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-bs-target="#searchModal"
                                    data-target="#exampleModalCenter">
                                    <img class="image_height" src="{{ asset('img/search.png') }}" width="30"
                                        alt="Search" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        aria-label="Search Product" data-bs-original-title="Search Product">
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><b>Search Book</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                .searchBox input {
                    width: 100%;
                    background: #fff;
                    padding: 10px 20px;
                    border-radius: 50px;
                    /* border: none; */
                }

                .searchData {
                    background: #fff;
                    color: #000;
                    padding: 10px;
                    width: calc(100% - 20px);
                    margin: 0 auto;
                    border-radius: 10px;
                    margin-top: 10px;
                    text-align: left;
                    display: none;
                    float: left;
                }
            </style>
            <div class="modal-body">
                <div class="searchBox">
                    <input type="text" placeholder="Search here..." id="searchBox">
                    <div class="searchData"></div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#searchBox').on('input', function() {
                        var inputValue = $(this).val();
                        if (inputValue.trim() !== '') {

                            $('.searchData').css('display', 'block');

                            var AjaxURL = '/searchbook';
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: "get",
                                url: AjaxURL,
                                data: {
                                    id: inputValue
                                },
                                success: function(result) {
                                    $('.searchData').html(result);
                                }
                            });

                        } else {

                            $('.searchData').css('display', 'none');
                            $('.searchData').html(' ');

                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
@if (session('error'))
<p class="text-center alert-danger">{{session('error')}}</p>
@endif
@if (session('success'))
<p class="text-center alert-success">{{session('success')}}</p>
@endif

