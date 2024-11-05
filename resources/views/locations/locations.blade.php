
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


		    <title>WNY MEDICAL, PC  | Locations</title>
        <meta property="og:title" content="WNY MEDICAL, PC  | Locations" />

    <link rel="icon" type="image/png" href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/locations" />
    <link rel="canonical" href="https://wnymedical.com/locations" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



            <meta property="description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
        <meta property="og:description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

            <meta property="keywords" content="WNY MEDICAL, PC" />


            <meta property="og:image" content="https://comwnymedical.s3.amazonaws.com/uploads/public/670/d10/554/thumb__500_0_0_0_crop.png" />
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
<x-header-component/>
<section id="page-title" class="page-title-parallax" style="background-image: url(https://comwnymedical.s3.amazonaws.com/uploads/public/5fe/de8/5a6/5fede85a693ad544547511.png); background-position: bottom center; background-size: cover; padding: 80px 0;">

	<div class="container clearfix">
	   	       <center>	<h2>Locations</h2></center>

	</div>

</section><!-- #page-title end -->
<style>
.maps iframe{
    pointer-events: none;
}
</style>
    <div class="row ">
        <div class="col-lg-12">
<div>
 <div class="maps" >
<iframe src='https://www.google.com/maps/d/embed?mid=1vJDTTfKypIGA0dXQa0nkH7-YF4I' width='100%' height='480'></iframe></div></div>
        </div>
    </div>



<section id="content" style="margin-bottom:0px;">
    <div class="mt-4 mb-5">
    	<div class="container clearfix">
            <br>
            <!-- first row start -->
            <div class="row">
                @foreach($locations as $location)
                    <div class="col-lg-4" style="padding-bottom:5px;">
                        <div class="card" style="width: 20rem;">
                            <div class="card-body">
                                <div style="float:right">
                                    <a href="{{ url('location-details/' . $location->slug) }}">
                                        <div class="btn btn-success mb-2">Open</div>
                                    </a>
                                </div>
                                <h5 class="card-title"><i class="fa fa-building"></i> {{ $location->location }}</h5>
                                <p class="card-text">
                                    <i class="fa fa-phone"></i> {{ $location->phone }}<br>
                                    <i class="fa fa-home"></i> {{ $location->address }}
                                </p>

                                <a style="width:100%" class="btn btn-primary" data-toggle="collapse" href="#collapse-{{ $location->id }}" role="button" aria-expanded="false" aria-controls="collapse-{{ $location->id }}">
                                    <i class="fa fa-clock-o"></i> Location Hours
                                </a>
                                <div class="collapse" id="collapse-{{ $location->id }}">
                                    <div class="card card-body">
                                        <div class="time-table-wrap clearfix">
                                            @foreach($location->days as $index => $day)
                                                <div class="row time-table">
                                                    <b class="col-lg-6"><i class="fa fa-"></i> {{ $day }}</b>
                                                    <span class="col-lg-6">
                                                        <p>{{ $location->times[$index] }}</p>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach




             </div>
            <!-- first row end -->

        </div>
    </div>
</div><div>
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
