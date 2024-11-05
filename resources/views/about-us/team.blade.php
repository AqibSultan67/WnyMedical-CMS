<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


    <title>WNY MEDICAL, PC | About Us</title>
    <meta property="og:title" content="WNY MEDICAL, PC  | About Us" />

    <link rel="icon" type="image/png"
        href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/about-us" />
    <link rel="canonical" href="https://wnymedical.com/about-us" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



    <meta property="description"
        content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
    <meta property="og:description"
        content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

    <meta property="keywords" content="WNY MEDICAL, PC" />


    <meta property="og:image"
        content="https://comwnymedical.s3.amazonaws.com/uploads/public/66f/55e/cd1/thumb__500_0_0_0_crop.png" />
    <meta property="og:type" content="png" />



    <link href="//fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:400,700|Crete+Round:400i"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" hreflang=”en”
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/medical.css') }}">
    <link rel="stylesheet" href="https://wnymedical.com/themes/WnyMedical/assets/css/dark.css">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/medical-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/WnyMedical/assets/css/responsive.css') }}">

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
    @php
        $AboutImage = $images->image ? asset('storage/about-images/' . $images->image) : '';
    @endphp
    <section id="page-title" class="page-title-parallax"
        style="background-image: url('{{ $AboutImage }}'); background-position: bottom center; background-size: cover; padding: 80px 0;">

        <div class="container clearfix">
            <center>
                <h2>Our Team</h2>
            </center>

        </div>

    </section>

    <section id="content" style="margin-bottom:0px;">

        <div class="content-wrap">

            <div class="container clearfix">
                <div class="heading-block center nobottomborder">
                    <h3>Meet our Team of Specialists</h3>
                    <span>We make sure that your Life is in Good Hands.</span>
                </div>
                <div class="row">
                    @foreach ($teams as $specialist )


                    <div class="col-md-3">

                        <div class="team">
                            <div class="team-image">
                                <img src="{{ asset('storage/specialists/' . $specialist->image) }}" alt="{{ $specialist->specialist_name }}">
                            </div>
                            <div class="team-desc">
                                <div class="team-title">
                                    <a href="{{ route('team.details', ['slug' => $specialist->slug]) }}"><b>{{$specialist->specialist_name}}</b></a><br>
                                    <p>{{strip_tags($specialist->speciality)}}</p></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach






























                </div>


            </div>
        </div>

        </div>
    </section <x-footer-component />


    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
    <script src="{{ asset('themes/WnyMedical/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('themes/WnyMedical/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('themes/WnyMedical/assets/js/functions.js') }}"></script>
    <script src="{{ asset('wnymodules/system/assets/js/framework.combined-min.js') }}"></script>
    <link rel="stylesheet" property="stylesheet"
        href="{{ asset('wnymodules/system/assets/css/framework.extras.css') }}">

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
