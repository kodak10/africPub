<!DOCTYPE html>
<html lang="fr">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>AFRICPUB - Votre Plateforme de Publication Africaine</title>

    <link rel="shortcut icon" href="{{asset('home/assets/img/logo/favicon.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/aos.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/mobile.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/owlcarousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/slick-slider.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('home/assets/css/main.css')}}">

    <script src="{{asset('home/assets/js/plugins/jquery-3-6-0.min.js')}}"></script>
</head>
<body class="homepage4-body ">

    <div class="preloader preloader3">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"></div>
        </div>
    </div>

    <div class="paginacontainer">
     <div class="progress-wrap">
       <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
         <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
       </svg>
     </div>
   </div>

    @include('home.layouts.header')

    @include('home.layouts.header-mobile')

    @yield('content')

    @include('home.layouts.footer')


    <script src="{{asset('home/assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/fontawesome.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/aos.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/counter.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/gsap.min.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/ScrollTrigger.min.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/Splitetext.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/sidebar.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/mobilemenu.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/owlcarousel.min.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/gsap-animation.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/nice-select.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/slick-slider.js')}}"></script>
    <script src="{{asset('home/assets/js/plugins/circle-progress.js')}}"></script>
    <script src="{{asset('home/assets/js/main.js')}}"></script>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>

</body>
</html>