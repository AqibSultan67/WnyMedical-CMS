
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


		    <title>WNY MEDICAL, PC  | Mammogram Schedule</title>
        <meta property="og:title" content="WNY MEDICAL, PC  | Mammogram Schedule" />

    <link rel="icon" type="image/png" href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="" />
    <link rel="canonical" href="" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



            <meta property="description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
        <meta property="og:description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

            <meta property="keywords" content="WNY MEDICAL, PC" />


            <meta property="og:image" content="https://comwnymedical.s3.amazonaws.com/uploads/public/66f/a98/f59/thumb__500_0_0_0_crop.png" />
        <meta property="og:type" content="png" />



    <link href="//fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:400,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" hreflang=”en” href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/swiper.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/medical.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/dark.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/font-icons.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/medical-icons.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/responsive.css')}}">

    <!-- Document Title
    ============================================= -->

    <style>
        .form-control.error { border: 2px solid red; }
    </style>

    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3660294717616673');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=3660294717616673&ev=PageView&noscript=1"
        />
   </noscript>
</head>
<body class="stretched" ><!-- Document Wrapper
	============================================= -->


    <!-- #header end --><!-- Page Title
============================================= -->
@php
$scheduleImage=$images->image ? asset('storage/about-images/' . $images->image) : '';
@endphp
<x-header-component/>
<section id="page-title" class="page-title-parallax" style="background-image: url({{$scheduleImage}}); background-position: bottom center; background-size: cover; padding: 80px 0;">

	<div class="container clearfix">
	   	       <center>	<h2>Mammogram Schedule</h2></center>

	</div>

</section><!-- #page-title end -->
<div class="container clearfix">
<p style="text-align: center;">
	<br>
</p>
@if ($schedules->isEmpty())
        <p style="text-align: center; font-weight:bold;">No schedule available.</p>
    @else
        @foreach ($schedules as $schedule)
            <p style="text-align: center;">
                <img src="{{ asset('storage/schedule-images/' . $schedule->image) }}" style="width: 772px;" class="fr-fic fr-dib" data-result="success">
            </p>
        @endforeach
    @endif
</div>
<x-footer-component/>
<!-- #wrapper end -->
<!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
    <script src="{{asset('themes/WnyMedical/assets/js/jquery.js')}}"></script>
    <script src="{{asset('themes/WnyMedical/assets/js/plugins.js')}}"></script>
    <script src="{{asset('themes/WnyMedical/assets/js/functions.js')}}"></script>
    <script src="{{asset('wnymodules/system/assets/js/framework.combined-min.js')}}"></script>
<link rel="stylesheet" property="stylesheet" href="{{asset('wnymodules/system/assets/css/framework.extras.css')}}">

    <script>
        if($( window ).width()>1000)
        {
            $("#logo").width('16%');
        }

    </script>
    <script>
    $(document).ready(function() {
            });
    </script>
    <script>
        $('.maps').click(function () {
        $('.maps iframe').css("pointer-events", "auto");
        });

        $( ".maps" ).mouseleave(function() {
          $('.maps iframe').css("pointer-events", "none");
        });
    </script>
</body>
</html>
