<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('front-end.layouts.head')

    <style>
        .hero-slider {
            /* background: #AABBCC; */
            background-image: url("{{ asset('img/WhatsApp Image 2023-03-22 at 06.06.58.jpeg') }}");
            * Full height */ height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }

        .product-area {
            /* background: #AABBCC; */
            background-image: url("{{ asset('img/WhatsApp Image 2023-03-22 at 06.06.58.jpeg') }}");
            * Full height */ height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .single-product {
            background: white;
        }

        .section-title h2 {
            background: rgba(128, 0, 0, 1.0);
            color: rgb(255, 255, 255)
        }
        
        .footer-top {
            background:#7fffd4;
        }
        
        .hero-slider::after {
            content: "";
            display: block;
            height: 5px;
            background-color: orange;
            margin-top: 20px;
        }
    </style>
</head>


<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->


    <!-- Header -->
    @include('front-end.layouts.header')

    <!--/ End Header -->

    <!-- Slider Area -->
    <section class="hero-slider">
        <!-- Single Slider -->
        <style>
    .animated-button:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }
</style>

<div class="single-slider">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-9 offset-lg-2 col-12">
                <div class="text-inner">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="hero-text">
                                <h1 style="color:white; text-align: left;"></h1>
                                <div class="button">
                                    <a href="{{ url('') }}#myTabContent" class="btn animated-button" style="font-size: 24px; background-color: orange; padding: 15px 30px; text-align: left;">Belanja Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!--/ End Single Slider -->
    </section>
    <!--/ End Slider Area -->

    <!-- Start Product Area -->
    @yield('content-shop')




    <!-- Modal end -->

    <!-- Start Footer Area -->
    @include('front-end.layouts.footer')

    <!-- /End Footer Area -->

    <!-- Jquery -->
    @include('front-end.layouts.foot')

    <script>
        function okelah() {
            var x = document.getElementById("cari_1");
            var y = document.getElementById("cari_2");
            x.style.display = "none";
            y.style.display = "block";
        }
        
    </script>

</body>

</html>
