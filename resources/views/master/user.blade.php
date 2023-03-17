<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>JERSEYPEDIA</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/prism/prism.css">
    <link rel="stylesheet" href="{{asset("assets/modules/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/modules/fontawesome/css/all.min.css")}}">

    <!-- CSS Libraries -->

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/3442f81bd6.js" crossorigin="anonymous"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-user/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-user/components.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-user/custom.css")}}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA --></head>

<body>
@include('sweetalert::alert')
<div id="app">
    @include('sweetalert::alert')
    <div class="main-wrapper main-wrapper-1">
        <div class="main-sidebar sidebar-style-2">
            <!-- hamburger -->
            <a href="#"><i class="fa-solid fa-bars"></i></a>
            <aside>
                <div class="brand">
                    <img src="{{asset("assets/images/user/Logo C.png")}}" alt="">
                </div>
                <ul class="menu">
                    <li><a href="{{route("user.index")}}"><i class="fa-solid fa-home"></i>Beranda</a></li>
                    <li><a href="{{route("user.profile")}}"><i class="fa-solid fa-user"></i><span>Akun Saya</span> </a></li>
                    <li><a href="{{route("user.order")}}"><i class="fa-solid fa-cart-shopping"></i>Pesanan Saya</a></li>
                    <li><a href="{{route("wishlist.index")}}"><i class="fa-solid fa-star"></i>Wish List</a></li>
                </ul>
                <!-- logout -->
            </aside>
            <a href="{{route("logout")}}" class="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
        </div>

        <div class="main-content">
            <section class="section">
                <div class="top-bar">
                    <div class="saldo">
                        <span class="font-weight-bold">saldo jerseypay anda:</span>
                        <h3>Rp. xxx. xxx</h3>
                    </div>
                    <div class="icon">
{{--                        <i class="fa-solid fa-wallet"></i>--}}
{{--                        <i class="fa-solid fa-cart-shopping"></i>--}}
                        <a href="{{route("user.profile")}}">
                            <img class="rounded-circle" width="50px" src="{{auth()->user()->photo_profile}}" alt="photo profile">
                        </a>
                    </div>
                </div>
                <div class="section-body">
                    @yield('content')
                </div>
            </section>
        </div>


        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2023 <div class="bullet"></div> JerseyPedia WebApp by XII RPL2 </a>
            </div>
            <div class="footer-right">
            </div>
        </footer>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{asset("assets/modules/tooltip.js")}}"></script>
<script src="{{asset("assets/modules/jquery.min.js")}}"></script>
<script src="{{asset("assets/modules/popper.js")}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="{{asset("assets/modules/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/modules/nicescroll/jquery.nicescroll.min.js")}}"></script>
<script src="{{asset("assets/modules/moment.min.js")}}"></script>
<script src="{{asset("assets/js/stisla.js")}}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{asset("assets/js/scripts.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>

@stack("javascript")
</body>
</html>
