
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


		    <title>WNY MEDICAL, PC  | Patient Portal</title>
        <meta property="og:title" content="WNY MEDICAL, PC  | Patient Portal" />

    <link rel="icon" type="image/png" href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/patient-portal" />
    <link rel="canonical" href="https://wnymedical.com/patient-portal" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



            <meta property="description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
        <meta property="og:description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

            <meta property="keywords" content="WNY MEDICAL, PC" />


            <meta property="og:image" content="https://comwnymedical.s3.amazonaws.com/uploads/public/66f/7e5/bc4/thumb__500_0_0_0_crop.png" />
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
	<x-header-component/>
    <!-- #header end --><!-- Page Title
============================================= -->
@php

$AboutImage = $images->image ? asset('storage/about-images/' . $images->image) : '';

@endphp

<section id="page-title" class="page-title-parallax" style="background-image: url({{$AboutImage}}); background-position: bottom center; background-size: cover; padding: 80px 0;">

	<div class="container clearfix">
	   	       <center>	<h2>Patient Portal</h2></center>

	</div>

</section><!-- #page-title end -->




<div class="container clearfix">
<br>
<div class="col_two_fifth">
    <div class="accordion accordion-lg clearfix">
        @if(isset($faqs[0]))
            <div class="acctitle">
                <i class="acc-closed icon-medical-i-kidney color"></i>
                <i class="acc-open icon-medical-i-kidney color"></i>
                {{ strip_tags($faqs[0]->question) }}
            </div>
            <div class="acc_content clearfix" style="display: none;">
                <p style="text-align: justify;">
                    {!! html_entity_decode($faqs[0]->answer) !!}
                </p>
            </div>
        @endif

        @if(isset($faqs[1]))
            <div class="acctitle">
                <i class="acc-closed icon-medical-i-respiratory color"></i>
                <i class="acc-open icon-medical-i-respiratory color"></i>
                {{ strip_tags($faqs[1]->question) }}
            </div>
            <div class="acc_content clearfix" style="display: none;">
                <p style="text-align: justify;">
                    {!! html_entity_decode($faqs[1]->answer) !!}
                </p>
            </div>
        @endif

        @if(isset($faqs[2]))
            <div class="acctitle">
                <i class="acc-closed icon-medical-i-ophthalmology color"></i>
                <i class="acc-open icon-medical-i-ophthalmology color"></i>
                {{ strip_tags($faqs[2]->question) }}
            </div>
            <div class="acc_content clearfix" style="display: none;">
                <p style="text-align: justify;">
                    {!! html_entity_decode($faqs[2]->answer) !!}
                </p>
            </div>
        @endif

        @if(isset($faqs[3]))
            <div class="acctitle">
                <i class="acc-closed icon-medical-i-ear-nose-throat color"></i>
                <i class="acc-open icon-medical-i-ear-nose-throat color"></i>
                {{ strip_tags($faqs[3]->question) }}
            </div>
            <div class="acc_content clearfix" style="display: none;">
                <p style="text-align: justify;">
                    {!! html_entity_decode($faqs[3]->answer)!!}
                </p>
            </div>
        @endif

        @if(isset($faqs[4]))
            <div class="acctitle">
                <i class="acc-closed icon-medical-i-cardiology color"></i>
                <i class="acc-open icon-medical-i-cardiology color"></i>
                {{ strip_tags($faqs[4]->question) }}
            </div>
            <div class="acc_content clearfix" style="display: none;">
                <p style="text-align: justify;">
                    {!! html_entity_decode($faqs[4]->answer) !!}
                </p>
            </div>
        @endif
    </div>
    <div style="background: #ac4147; padding: 15px; text-align: center;">
        <a style="font-weight: bold; color: white; font-size: 17px;" href="https://www.medentmobile.com/portal/index.php?practice_id=r5i2c744"> Patient Portal </a>
    </div>
</div>
<div class="col_two_fifth col_last">
    <div class="accordion accordion-lg clearfix">

  <p style="text-align: justify;"><a href="https://wnymedical.com/new-patient" rel="noopener noreferrer" target="_blank"><strong>New Patient?</strong></a></p>

  <p style="text-align: justify;"><strong>&nbsp;</strong></p>

  <p style="text-align: justify;"><a href="storage/app/media/uploaded-files/Combined-Patient-Packet-2018-FinalFINAL.pdf" rel="noopener noreferrer" target="_blank"><strong>Click Here to use our Fillable New Patient Packet!</strong></a></p>

  <p style="text-align: justify;">&nbsp;</p>

  <p style="text-align: justify;">After you fill out the forms email or print and bring them with you to meet with your new doctor at WNY Medical PC.&nbsp;</p>

  <p style="text-align: justify;">Please email your completed form to <em><strong>info@wnymedical.com&nbsp;</strong></em></p>

  <p style="text-align: justify;">The Subject line for this email should include “New Patient Package” and the location you would like to attend.</p>

  <p style="text-align: justify;">We are accepting new patients at all locations!</p>

  <p style="text-align: justify;">Contact a site nearest you on our <a href="https://wnymedical.com/contact" rel="noopener noreferrer" target="_blank">Location Page!</a></p>

    </div>
  </div>
</div></div>
<section id="content" style="margin-bottom:0px;">
	<div class="content-wrap">
        <div class="row topmargin-lg footer-stick align-items-stretch">
            @if(isset($services[0]))
        	<div class="col-lg-4 dark col-padding ohidden" style="background-color: #1abc9c;">
        		<div data-animate="fadeInLeft" class="fadeInLeft animated">
        			<a href="#"><h3 class="uppercase" style="font-weight: 600;">{!!html_entity_decode($services[0]->title)!!}</h3></a>
        			<p style="line-height: 1.8;">{!!html_entity_decode($services[0]->content)!!}</p>
        		</div>
        		<i class="icon-medical-i-cardiology bgicon"></i>
        	</div>
            @endif
             @if(isset($services[1]))
        	<div class="col-lg-4 dark col-padding ohidden" style="background-color: #34495e;">
        		<div data-animate="fadeInLeft" data-delay="200" class="fadeInLeft animated">
        			<a href="#"><h3 class="uppercase" style="font-weight: 600;">{!!html_entity_decode($services[1]->title)!!}</h3></a>
        			<p style="line-height: 1.8;">{!!html_entity_decode($services[1]->content)!!}</p>
        		</div>
        		<i class="icon-medical-i-administration bgicon"></i>
        	</div>
            @endif
             @if(isset($services[2]))
        	<div class="col-lg-4 dark col-padding ohidden" style="background-color: #DE6262;">
        		<div data-animate="fadeInLeft" data-delay="400" class="fadeInLeft animated">
        			<a href="#"><h3 class="uppercase" style="font-weight: 600;">{!!html_entity_decode($services[2]->title)!!}</h3></a>
        			<p style="line-height: 1.8;">{!!html_entity_decode($services[2]->content)!!}</p>
        		</div>
        		<i class="icon-medical-i-billing bgicon"></i>
        	</div>
              @endif
        	<div class="clear"></div>
        </div>
    </div>
</div></div>
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
