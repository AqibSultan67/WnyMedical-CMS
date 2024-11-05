<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <title>WNY MEDICAL, PC | Videos</title>
    <meta property="og:title" content="WNY MEDICAL, PC  | Videos" />

    <link rel="icon" type="image/png"
        href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/videos" />
    <link rel="canonical" href="https://wnymedical.com/videos" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



    <meta property="description"
        content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
    <meta property="og:description"
        content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

    <meta property="keywords" content="WNY MEDICAL, PC" />


    <meta property="og:image"
        content="https://comwnymedical.s3.amazonaws.com/uploads/public/66f/958/1cd/thumb__500_0_0_0_crop.png" />
    <meta property="og:type" content="png" />



    <link href="//fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:400,700|Crete+Round:400i"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" hreflang=”en”
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
        .form-control.error {
            border: 2px solid red;
        }
    </style>

    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3660294717616673');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=3660294717616673&ev=PageView&noscript=1" />
    </noscript>
</head>

<body class="stretched"><!-- Document Wrapper
 ============================================= -->

    <x-header-component />
    <!-- #header end --><!-- Page Title
============================================= -->
    @php
        $MainImage = $images->image ? asset('storage/about-images/' . $images->image) : '';
    @endphp
    <section id="page-title" class="page-title-parallax"
        style="background-image: url('{{ $MainImage }}'); background-position: bottom center; background-size: cover; padding: 80px 0;">

        <div class="container clearfix">
            <center>
                <h2>Videos</h2>
            </center>

        </div>

    </section><!-- #page-title end -->
    <br>
    <div class="container">



        <div class="row">
            @foreach ($mediaLinks as $mediaLink)
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='{{strip_tags($mediaLink->link)}}'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $mediaLink->title }}</h5>
                        <p class="card-text" style="text-align:justify"> {{strip_tags($mediaLink->description)}}</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>

                </div>

            </div>
            @endforeach
            {{-- <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/UqoJi3GF90s?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">iScale</h5>
                        <p class="card-text" style="text-align:justify">Now you can manage your weight at home using
                            iScale. It is the easiest and simplest way to measure and manage your weight at home without
                            visiting hea....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/yhYVnEhfbso?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">iBloodPressure Meter</h5>
                        <p class="card-text" style="text-align:justify">iBloodPressure Device is easy to use and a
                            simplest way to take your blood pressure reading. As heart health is the most important part
                            of our body an....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/oVycWnLfZZo?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">iPulseOx</h5>
                        <p class="card-text" style="text-align:justify">iPulseOx Monitor is a cellular connected pulse
                            Oximeter to help make managing respiratory disease in a simpler way. The iPulseOx measures
                            SpO2, or oxy....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/-tUnQ0id5ZY?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">iGlucose Meter</h5>
                        <p class="card-text" style="text-align:justify">iGlucose: Blood Glucose monitoring system it
                            measure blood glucose and helps in managing diabetes. This video is all about setting up
                            iGlucose Reader....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/UkZwZeXy5yg?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">iBloodPressure Plus</h5>
                        <p class="card-text" style="text-align:justify">iBloodPressure Device is an easiest and
                            simplest way to take an accurate measurement of blood pressure. Results of the readings
                            taken would be automat....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/6a8aXHIaGbE?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Dr Sadiq's Message Coronavirus</h5>
                        <p class="card-text" style="text-align:justify">Dr Sadiq's Message Coronavirus.</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://player.vimeo.com/video/70810955'
                            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Alzheimer’s and Dementia - Tips for the Aging - Clarence, NY</h5>
                        <p class="card-text" style="text-align:justify">President of WNY Medical, Dr. Riffat Sadiq,
                            gives a speech on Alzheimer's and Dementia, offering tips for the aging. This segment
                            highlights how loss....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://player.vimeo.com/video/62784377'
                            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Alzheimer’s and Dementia at the Buffalo General Hospital</h5>
                        <p class="card-text" style="text-align:justify">Filmed at Buffalo General Hospital, Dr. Riffat
                            Sadiq gives a speech about the causes, symptoms, and prevention of Alzheimer's and Dementia.
                            In this se....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://player.vimeo.com/video/77151953'
                            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Food is Medicine - Cheektowaga Senior Center</h5>
                        <p class="card-text" style="text-align:justify">President of WNY Medical, Dr. Riffat Sadiq
                            gives a speech on Food is medicine at the Cheektowaga Senior Center in Cheektowaga, NY
                            --
                            WNY Medical, PC....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://www.youtube.com/embed/gGL7rGqPq6s?rel=0'
                            frameborder='0' allowfullscreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Food is Medicine Full Version</h5>
                        <p class="card-text" style="text-align:justify">President of WNY Medical, Dr. Riffat Sadiq
                            gives a speech on Food is medicine at the Cheektowaga Senior Center in Cheektowaga, NY
                            --
                            WNY Medical, PC....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://player.vimeo.com/video/77152639'
                            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Aging Healthy - Gooddard Memorial Hall</h5>
                        <p class="card-text" style="text-align:justify">President of WNY Medical, Dr. Riffat Sadiq
                            gives a speech on aging gracefully at the Goddard memorial Hall, Springville, NY
                            --
                            WNY Medical, PC is a....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div>
            <div class=" col-sm-6 ">
                <div class="card"
                    style="width:100%;margin-bottom: 20px;margin-left: 5px;margin-right: 5px; height: 428px;">
                    <style>
                        .embed-container {
                            position: relative;
                            padding-bottom: 56.25%;
                            height: 0;
                            overflow: hidden;
                            max-width: 100%;
                        }

                        .embed-container iframe,
                        .embed-container object,
                        .embed-container embed {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                    <div class='embed-container'><iframe src='https://player.vimeo.com/video/62254302'
                            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
                    <div class="card-body">
                        <h5 class="card-title">Aging Gracefully</h5>
                        <p class="card-text" style="text-align:justify">Filmed at Union Square Apartments, Dr. Riffat
                            Sadiq gives tips to community members on improving their health by taking simple steps.
                            Find out more a....</p>
                        <!--<a href="https://wnymedical.com/videos" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>

            </div> --}}
        </div>
    </div>

    </div>
    <x-footer-component />
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
        if ($(window).width() > 1000) {
            $("#logo").width('16%');
        }
    </script>
    <script>
        $(document).ready(function() {});
    </script>
    <script>
        $('.maps').click(function() {
            $('.maps iframe').css("pointer-events", "auto");
        });

        $(".maps").mouseleave(function() {
            $('.maps iframe').css("pointer-events", "none");
        });
    </script>
</body>

</html>
