<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sambisari Coffe</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets-fe/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets-fe/css/convo.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets-fe/images/Icon.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2Hhh_14Uam62GXGaTMcXWhhVkYg0EbDY&callback=initMap" async defer></script>
</head>
<body>
<!-- HEADER SECTION -->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-5">
            <a class="sidebar-brand d-flex align-items-center justify-content-center text-white text-decoration-none" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{asset('assets-fe/images/Icon.png')}}" alt="Logo" style="width: 15rem; height: 40px;">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    @foreach($menu as $dm)
                        @if(sizeof($dm['itemMenu']) > 0)
                            <li class="nav-item dropdown">
                                <a href="{{$dm['url']}}" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                    {{$dm['menu']}}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @foreach($dm['itemMenu'] as $idm)
                                        <li>
                                            <a href="{{$idm['sub_menu_url']}}" class="dropdown-item" target="{{$idm['sub_menu_target']}}">
                                                {{$idm['sub_menu_nama']}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{$dm['url']}}" class="nav-link" target="{{$dm['target']}}">
                                    {{$dm['menu']}}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
    <ul class="navbar-nav mr-auto ms-auto">
        <li class="h3 nav-item" style="display: flex; align-items: center;">
            @if (auth()->check())
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('dashboard.index') }}" class="nav-link text-decoration-none text-white">Kembali</a>
                @elseif (auth()->user()->role == 'kasir' || auth()->user()->role == 'pelanggan')
                    <a href="{{ route('pesanan.index') }}" class="nav-link text-decoration-none text-white">Kembali</a>
                @endif
                <a href="{{ route('auth.logout') }}" class="nav-link text-decoration-none text-white ml-2">Logout</a>
            @else
                <a href="{{ route('auth.index') }}" class="nav-link text-decoration-none text-white">Login</a>
                <span class="text-white mx-1">|</span>
                <a href="{{ route('auth.logout') }}" class="nav-link text-decoration-none text-white">Logout</a>
            @endif
        </li>
    </ul>

    <div class="icons">
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn" onclick="redirectCart()"></div>
{{--            <div class="fas fa-bars" id="menu-btn"></div>--}}
        </div>

        <!-- SEARCH TEXT BOX -->
        <div class="search-form">
            <input type="search" id="search-box" class="form-control" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>

    <div class="cart">
        <h2 class="cart-title">Lihat Pesanan</h2>
        <div class="cart-content">
            <!-- Cart items will be dynamically inserted here -->
        </div>
{{--        <div class="total">--}}
{{--            <div class="total-title">Total: </div>--}}
{{--            <div class="total-price">Rp0</div>--}}
{{--        </div>--}}
        <!-- BUY BUTTON -->
        <a class="btn btn-buy" href="{{route('pesanan.index')}}">Masuk Kedahsboard</a>
    </div>


</header>

<!-- HERO SECTION -->
<section class="home" id="home">
    <div class="content">
        <h3>Selamat datang di Sambisari Coffee Shop!</h3>
        <p><strong>Selamat datang untuk menikmati kenyamanan kami.</strong></p>
        <a href="#menu" class="btn btn-dark text-decoration-none">Pesan Sekarang!</a>
    </div>
</section>


<!-- MENU SECTION -->
@yield('content')

<!-- FOOTER SECTION -->
<section class="footer" id="contact">
    <div class="footer-container">
        <div class="logo">
            <img src="{{asset('assets-fe/images/LogoSambisari.png')}}"><br/>
        </div>
        <div class="support">
            <h2>WhatsApp</h2>
            <br />
            <a href="https://wa.me/087742262378" target="_blank">
                <p>+62 087742262378</p>
            </a>
            <h2>Instagram</h2>
            <a href="https://www.instagram.com/sambisaricoffee?igsh=bnJ3emQzbjl2b3p5" target="_blank">sambisaricoffe</a>
        </div>
        <div class="company">
            <h2>Maps</h2>
            <br />
            <a href="https://maps.app.goo.gl/8hcERPTYstBUoUhz9" target="_blank">https://maps.app.goo.gl/8hcERPTYstBUoUhz9</a>
            <h2>TikTok</h2>
            <a href="https://www.tiktok.com/@sambisari.coffee?is_from_webapp=1&sender_device=pc" target="_blank">sambisari.coffee</a>
        </div>
        <div class="company">
            <h2>Gofood</h2>
            <br />
            <a href="https://gofood.link/a/L97xVxJ?fbclid=PAZXh0bgNhZW0CMTEAAaZJkNLNs_tA7JNcLPj5ffrDwdbYimEcDHrkUba_E4R_9UTmmmoUFiQ5qsU_aem_Afp-Litm351cTs3LOF7fNBq6InodEx_7FD-XGvzr6z7UHNgYj2icz1iames_3nvkWHULX5ZmEjqNIoCuBEMTkphb"
               target="_blank">Sambisari Coffe And Space</a>
        </div>

        {{--        <div class="newsletters">--}}
{{--            <h2>Newsletters</h2>--}}
{{--            <br />--}}
{{--            <p>Subscribe to our newsletter for news and updates!</p>--}}
{{--            <div class="input-wrapper">--}}
{{--                <input type="email" class="newsletter" placeholder="Your email address">--}}
{{--                <i id="paper-plane-icon" class="fas fa-paper-plane"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="credit">--}}
{{--            <hr /><br/>--}}
{{--            <h2>KapeTann Brewed Coffee © 2023 | All Rights Reserved.</h2>--}}
{{--            <h2>Designed by <span>Algo Filipino</span> | Teravision</h2>--}}
{{--        </div>--}}
    </div>
</section>

<!-- CHAT BAR BLOCK -->
<div class="chat-bar-collapsible">
    <button id="chat-button" type="button" class="collapsible">Chat with us! &nbsp;
        <i id="chat-icon" style="color: #fff;" class="fas fa-comments"></i>
    </button>
    <div class="content">
        <div class="full-chat-block">
            <!-- Message Container -->
            <div class="outer-container">
                <div class="chat-container">
                    <!-- Messages -->
                    <div id="chatbox">
                        <h5 id="chat-timestamp"></h5>
                        <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                    </div>
                    <!-- User input box -->
                    <div class="chat-bar-input-block">
                        <div id="userInput">
                            <input id="textInput" class="input-box" type="text" name="msg"
                                   placeholder="Tap 'Enter' to send a message">
                            <p></p>
                        </div>
{{--                        <div class="chat-bar-icons">--}}
{{--                            <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-paper-plane"--}}
{{--                               onclick="sendButton()"></i>--}}
{{--                        </div>--}}
                    </div>
                    <div id="chat-bar-bottom">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- JS File Link -->
<script src="{{asset('assets-fe/js/googleSignIn.js')}}"></script>
<script src="{{asset('assets-fe/js/script.js')}}"></script>
<script src="{{asset('assets-fe/js/responses.js')}}"></script>
<script src="{{asset('assets-fe/js/convo.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    // CODE FOR THE FORMSPREE
    window.onbeforeunload = () => {
        for(const form of document.getElementsByTagName('form')) {
            form.reset();
        }
    }

    // CODE FOR THE GOOGLE MAPS API
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 14.99367271992383, lng: 120.17629231186626},
            zoom: 9
        });

        var marker = new google.maps.Marker({
            position: {lat: 14.99367271992383, lng: 120.17629231186626},
            map: map,
            title: 'Your Location'
        });
    }

    // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN MENU
    $(document).ready(function() {
        $(".row-to-hide").hide();
        $("#showHideBtn").text("SHOW MORE");
        $("#showHideBtn").click(function() {
            $(".row-to-hide").toggle();
            if ($(".row-to-hide").is(":visible")) {
                $(this).text("SHOW LESS");
            } else {
                $(this).text("SHOW MORE");
            }
        });
    });

    // CODE FOR THE SHOW MORE & SHOW LESS BUTTON IN GALLERY
    $(document).ready(function() {
        $(".pic-to-hide").hide();
        $("#showBtn").text("SHOW MORE");
        $("#showBtn").click(function() {
            $(".pic-to-hide").toggle();
            if ($(".pic-to-hide").is(":visible")) {
                $(this).text("SHOW LESS");
            } else {
                $(this).text("SHOW MORE");
            }
        });
    });

</script>
</body>
</html>
