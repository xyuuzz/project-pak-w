<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/98fc33a95e.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("assets/modules/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/modules/fontawesome/css/all.min.css")}}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-admin/style.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-admin/components.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/dashboard-admin/custom.css")}}">
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
<div id="app">
    @include('sweetalert::alert')
    <div class="main-wrapper main-wrapper-1">
        <div class="main-sidebar sidebar-style-2 shadow-lg" style="background-image:linear-gradient(#FFFF00,#fee32f,#ffc367);">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand mt-3" style="margin-bottom: 100px;">
                    <img src="{{asset("assets/images/admin/97f63726-7c07-49bd-aa43-288972459e57-removebg-preview.png")}}" alt="" height="150px">
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html"></a>
                </div>
                <ul class="sidebar-menu mt-5" style="font-family: sans-serif;">
                    <li class="nav-item" style="font-size: 15px;">
                        <a class="nav-link text-dark mb-0" href="{{route("product.index")}}">
                            <i class="fas fa-solid fa-shirt" style="font-size: 20px;"></i>
                            <span class="">Produk Jersey</span></a>
                        <hr class="" style="width: 200px;">
                    </li>

{{--                    <li class="nav-item" style="font-size: 15px;">--}}
{{--                        <a class="nav-link text-dark" href="charts.html">--}}
{{--                            <i class="fas fa-duotone fa-dollar-sign" style="font-size: 20px;"></i>--}}
{{--                            <span class="">Pendapatan</span></a>--}}
{{--                    </li>--}}
{{--                    <hr class="" style="width: 200px;">--}}
                    <li class="nav-item" style="font-size: 15px;">
                        <a class="nav-link text-dark" href="{{route("promo.index")}}">
                            <i class="fas fa-solid fa-percent" style="font-size: 20px;"></i>
                            <span class="">Promo</span></a>
                    </li>
                    <hr class="" style="width: 200px;">
                    <li class="nav-item" style="font-size: 15px;">
                        <a class="nav-link text-dark" href="charts.html">
                            <i class="fas fa-solid fa-chart-line" style="font-size: 20px;"></i>
                            <span class="">Planning</span></a>
                    </li>
                    <hr class="" style="width: 200px;">

                    <li class="nav-item" style="font-size: 25px;margin-top: 100px;">
                        <a class="nav-link text-dark" href="{{route("logout")}}">
                            <i class="fas fa-solid fa-right-from-bracket" style="font-size: 30px;"></i>
                            <span class="" style="font-weight: bold;">Logout</span></a>
                    </li>
                </ul>
            </aside>
        </div>


        <!-- Main Content -->
        <div class="main-content" style="background-color: #FFFB9F;height: 100vh;">
            <div class="section-body" style="margin-top: -50px;">
                <div class="card" style="background-color: transparent;font-weight: bold;color: black;font-size: 20px;">
                    <div class="card-body">
                        @yield("content")
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</div>
</div>


<!-- General JS Scripts -->
<script src="{{asset("assets/modules/jquery.min.js")}}"></script>
<script src="{{asset("assets/modules/popper.js")}}"></script>
<script src="{{asset("assets/modules/tooltip.js")}}"></script>
<script src="{{asset("assets/modules/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/modules/nicescroll/jquery.nicescroll.min.js")}}"></script>
<script src="{{asset("assets/modules/moment.min.js")}}"></script>
<script src="{{asset("assets/js/stisla.js")}}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{asset("assets/js/scripts.js")}}"></script>
<script src="{{asset("assets/js/custom.js")}}"></script>

<script src="https://kit.fontawesome.com/98fc33a95e.js" crossorigin="anonymous"></script>

@stack("scripts")

</body>
</html>
