
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


		    <title>WNY MEDICAL, PC  | Press Releases</title>
        <meta property="og:title" content="WNY MEDICAL, PC  | Press Releases" />

    <link rel="icon" type="image/png" href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/press-releases" />
    <link rel="canonical" href="https://wnymedical.com/press-releases" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



            <meta property="description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
        <meta property="og:description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

            <meta property="keywords" content="WNY MEDICAL, PC" />


            <meta property="og:image" content="https://comwnymedical.s3.amazonaws.com/uploads/public/671/dca/bf9/thumb__500_0_0_0_crop.png" />
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
<body class="stretched" >
    <x-header-component/>

<!-- Page Title ============================================= -->
<section class="page-title-parallax">
    <center>
        <img src="https://wnymedical.com/themes/WnyMedical/assets/images/banner-press-release.jpg" />
    </center>
</section>
<div class="container">
    <div class="section-block">
        <div id="particles-js-project_detail"></div>
        <div class="clear"></div>

        <!-- Blog Title -->
        <div class="text-center mb-4">
            <h2>{{ $blog->blog_title }}</h2>
            <p class="text-muted">Published on {{ $blog->created_at->format('F j, Y') }}</p>
        </div>

        <!-- Content Images -->
        @if(is_array($blog->content_images) || is_object($blog->content_images))
            @if(count($blog->content_images) > 0)
                <div class="row">
                    @foreach($blog->content_images as $image)
                        <div class="col-md-4 mb-4">
                            <div class="gallery-item">
                                <img src="{{ asset('storage/blogs/content/' . $image) }}" alt="{{ $blog->blog_title }}" class="img-fluid" style="border-radius: 5px; width: 100%;">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <!-- Blog Description -->
        <div class="team-desc">
            <div class="team-content">
                <p class="lead">{!! html_entity_decode($blog->blog_description) !!}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .gallery-item {
        overflow: hidden;
        position: relative;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05); /* Zoom effect on hover */
    }

    /* Additional styling for the blog */
    h2 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .lead {
        font-size: 1.125rem;
        line-height: 1.6;
        margin-top: 20px;
    }
</style>
<x-footer-component/>
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
