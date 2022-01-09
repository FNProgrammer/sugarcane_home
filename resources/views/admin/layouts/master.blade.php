<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="پنل مدیریتی - داشبورد 1" />
    <meta property="og:title" content="پنل مدیریتی - داشبورد 1" />
    <meta property="og:description" content="پنل مدیریتی - داشبورد 1" />
    <meta property="og:image"  />
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="Some description for the page"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پنل مدیریتی </title>



    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('panel/images/favicon.png')}}">
    <link href="{{url('panel/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('panel/vendor/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{url('panel/vendor/JalaliDatePicker-main/jalalidatepicker.css')}}">


    <!-- Vectormap -->
    <link href="{{url('panel/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{url('panel/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{url('panel/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{url('panel/2.0/lineicons.css')}}" rel="stylesheet">
    <link href="{{url('panel/css/style.css')}}" rel="stylesheet">
    <link href="{{url('panel/sweetalert/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{url('panel/css/font.css')}}" rel="stylesheet">
    <link href="{{url('panel/css/custom.css')}}" rel="stylesheet">



     <!-- Favicon icon
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

       <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


     <link href=" https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"rel="stylesheet">
   <link href="{{url('panel/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{url('panel/vendor/select2/css/select2_bootstrap.min.css')}}" rel="stylesheet">

      -->
    @yield('style')

</head>
<body>

<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>


<div id="main-wrapper">

@include('admin.partials.header')

@include('admin.partials.sidebar')

    <div class="content-body">
        <!-- row -->

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>


    <div class="footer">
        <div class="copyright">
            <p>تمامی حقوق محفوظ است</p>
        </div>
    </div>

</div>



<!-- Required vendors
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


 -->


<!--<script src="{{url('panel/js/select2.min.js')}}"></script>
<script src="{{url('panel/js/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="{{url('panel/vendor/select2/js/select2.full.min.js')}}"></script>


-->





<script src="{{url('panel/vendor/jquery/jquery.min.js')}}"></script>



<script src="{{url('panel/vendor/global/global.min.js')}}"></script>

<script src="{{url('panel/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{url('panel/vendor/chart_js/chart.bundle.min.js')}}"></script>
<script src="{{url('panel/vendor/owl-carousel/owl.carousel.js')}}"></script>
<!-- Chart piety plugin files -->
<script src="{{url('panel/vendor/peity/jquery.peity.min.js')}}"></script>
<!-- Dashboard 1 -->
<script src="{{url('panel/js/dashboard/dashboard-1.js')}}"></script>
<script src="{{url('panel/js/index_custom.min.js')}}"></script>
<script src="{{url('panel/js/deznav-init.js')}}"></script>
<script src="{{url('panel/js/demo.js')}}"></script>
<script src="{{url('panel/js/styleswitcher.js')}}"></script>
<script src="{{url('panel/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{url('panel/public/js/cust.js')}}"></script>
<script src="{{url('panel/vendor/JalaliDatePicker-main/jalalidatepicker.js')}}"></script>










<script>


    function carouselReview(){
        /*  testimonial one function by = owl.carousel.js */
        function checkDirection() {
            var htmlClassName = document.getElementsByTagName('html')[0].getAttribute('class');
            if(htmlClassName == 'rtl') {
                return true;
            } else {
                return false;

            }
        }
        jQuery('.testimonial-one').owlCarousel({
            loop:true,
            autoplay:true,
            margin:15,
            nav:false,
            dots: false,
            left:true,
            rtl: checkDirection(),
            navText: ['', ''],
            responsive:{
                0:{
                    items:1
                },
                800:{
                    items:2
                },
                991:{
                    items:2
                },

                1200:{
                    items:2
                },
                1600:{
                    items:2
                }
            }
        })
        jQuery('.testimonial-two').owlCarousel({
            loop:true,
            autoplay:true,
            margin:15,
            nav:false,
            dots: true,
            left:true,
            rtl: checkDirection(),
            navText: ['', ''],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                991:{
                    items:3
                },

                1200:{
                    items:3
                },
                1600:{
                    items:4
                }
            }
        })
    }
    jQuery(window).on('load',function(){
        setTimeout(function(){
            carouselReview();
        }, 1000);
    });


        jalaliDatepicker.startWatch({
        separatorChar: "/",
        changeMonthRotateYear: true,
        showTodayBtn: true,
        showEmptyBtn: true
    });

</script>
@yield('scripts')
</body>
</html>
