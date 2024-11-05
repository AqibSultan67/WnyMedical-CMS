
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Sun Spin Meedia" />

    <!-- Stylesheets ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />


		    <title>WNY MEDICAL, PC  | Careers</title>
        <meta property="og:title" content="WNY MEDICAL, PC  | Careers" />

    <link rel="icon" type="image/png" href="https://comwnymedical.s3.amazonaws.com/uploads/public/61b/0f5/c87/61b0f5c87f58f473266173.jpg" />





    <meta property="og:url" content="https://wnymedical.com/careers" />
    <link rel="canonical" href="https://wnymedical.com/careers" />
    <meta property="og:site_name" content="WNY MEDICAL, PC" />



            <meta property="description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />
        <meta property="og:description" content="WNY Medical, PC is a primary care practice with offices conveniently located throughout Western New York. Our primary care clinics are currently located in Amherst, Buffalo, Derby, Depew, Hamburg, Cheektowaga, and South Buffalo." />

            <meta property="keywords" content="WNY MEDICAL, PC" />


            <meta property="og:image" content="https://comwnymedical.s3.amazonaws.com/uploads/public/66f/656/760/thumb__500_0_0_0_crop.png" />
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
    <link rel="stylesheet" href="{{asset('themes/WnyMedical/assets/css/responsive.css')}}s">

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
$CareerImage = $images->image ? asset('storage/about-images/' . $images->image) : '';
@endphp

<section id="page-title" class="page-title-parallax" style="background-image: url('{{ $CareerImage }}'); background-position: bottom center; background-size: cover; padding: 80px 0;">

	<div class="container clearfix">
	   	       <center>	<h2> Careers</h2></center>

	</div>

</section><!-- #page-title end -->
@if($careerContent)
<div class="container clearfix"><p style="text-align: justify"; "widht:80px;"><center><strong><br>{{strip_tags($careerContent->title)}}</strong></center>
	<br>{{strip_tags($careerContent->content)}}
    @else
    <p class="text-center mt-5">No Data Available for this Section</p>
    @endif
	<br>
	<br>
</p>
</div>
<div class="container clearfix">
    <div class="row mb-5">
	<div class="col-md-6">
		<div class="feature-box fbox-plain">
			<div class="fbox-icon" data-animate="bounceIn">
				<a href="#"><i class="icon-medical-i-cardiology"></i></a>
			</div>
            @if(isset($careerServices[0]))
            <h3>{{ strip_tags($careerServices[0]->title) }}</h3>
            <p style="text-align: justify;"><strong></strong>
                <br>
                {{ strip_tags($careerServices[0]->content) }}
            </p>
            </p>

            @else
                <h3>No Title Available</h3>
                <p style="text-align:justify;">No content available.</p>
            @endif


		</div>
	</div>

	<div class="col-md-6">
		<div class="feature-box fbox-plain">
			<div class="fbox-icon" data-animate="bounceIn" data-delay="200">
				<a href="#"><i class="icon-medical-i-social-services"></i></a>
			</div>
            @if(isset($careerServices[1]))
            <h3>{{ strip_tags($careerServices[1]->title) }}</h3><br>
			<p><p style="text-align: justify;">{{ strip_tags($careerServices[1]->content) }} </p>
</p>
@else
<h3>No Title Available</h3>
<p style="text-align:justify;">No content available.</p>
@endif
		</div>
	</div>
 </div>
</div>


<div class="container clearfix"><div class="container-fluid" id="jobDetails" style="display:none">
			<div class="row">
		<div class="col-md-12" style="background-color:lightgrey;padding:15px;border-radius: 5px;">
          <div>Application Details<a data-request="listjobs::onRun"  data-request-success=" $('#jobListTable').css('display','block'),$('#jobDetails').css('display','none')" class="float-right" style="cursor:pointer;">&#10006;</a></div>
           </div>
			<div class="col-md-6"  style="padding: 10px;" >
				<div class="panel panel-default">
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item active"><b>Title: </b>&nbsp;<span></span></li>
							<li class="list-group-item"><b>Expired Date: </b>&nbsp;<span>Sep 27, 2024 at 6:53am</span>
								<li class="list-group-item"><b>Location:</b>&nbsp;<span class="badge badge-warning"></span>
								</li>
								<li class="list-group-item"><b>Job Type:</b>&nbsp;<span class="badge badge-success"></span>
								</li>
								<li class="list-group-item"><b>Requirments:</b>
									<ul>
																			</ul>
								</li>
								<li class="list-group-item"><b>Expectations:</b>
									<ul>
																			</ul>
								</li>
								<li class="list-group-item"><b>Description: </b>&nbsp;<span></span></li>
								<li class="list-group-item"><b>Posted at: </b>&nbsp;<span>Sep 27, 2024 at 6:53am</span></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6 float-right"  style="padding:10px;">
					<div class="card bg-light">
                      <div class="card-header  text-white bg-primary mb-3">Apply Now</div>
                         <div class="card-body">
					<form data-request="onSubmit" data-request-files data-request-flash>
						<input type="hidden" name="_handler" value="onSave">
						<input name="_token" type="hidden" value="AIAwGFcrVwo8sNpagMrzDsVoxBtOfKDfcLAyrPar">
						<input name="_session_key" type="hidden" value="xmzp4qtJDLz4KCy9jrZ9mwEKyBcY8tFtSj7RfPcu">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Firstname">First Name<span style="color:red">*</span></label>
								<input type="text" class="form-control"  placeholder="First Name" name="first_name">
							</div>
							<div class="form-group col-md-6">
								<label for="Lastname">Last Name<span style="color:red">*</span></label>
								<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name">
							</div>
						</div>
						<div class="form-group">
							<label for="Email">Email<span style="color:red">*</span></label>
							<input type="email" class="form-control" placeholder="Email" name="email">
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="Age">Age<span style="color:red">*</span></label>
								<input type="text" name="age" class="form-control"  placeholder="Age">
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">City<span style="color:red">*</span></label>
								<input type="text" class="form-control"  name="city" placeholder="City">
							</div>
						   </div>
							<div class="form-group ">
								<label for="coverLetter">Joining Date<span style="color:red">*</span></label>
							<input type="text" class="form-control" id="datepicker" name="start_date">
								<input class="form-control" type="hidden"  name="vacancy_id" value="">
							</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="inputZip">Expected Salary<span style="color:red">*</span></label>
								<input type="text" class="form-control" name="expected_salary">
							</div>
							<div class="form-group col-md-6 d-none">
								<label for="inputZip">Current Salary (if any)</label>
								<input type="text" value=" " class="form-control" name="current_salary">
							</div>
						</div>
						<div class="form-group">
							<label for="coverLetter">Cover Letter<span style="color:red">*</span></label>
							<textarea class="form-control" rows="3" name="cover_letter"></textarea>
						</div>
						<div class="form-group">
							<label for="Description">Experience(Optional)</label>
							<textarea class="form-control"  rows="3" name="experience"></textarea>
						</div>
						<div class="form-group">
							<label for="UploadCV">Upload your resume</label>
							<input type="file" class="form-control-file" name="cvfile">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
$(function(){
   var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    formatStrict : 'Y-m-d',
    keyboardInput : false,
    toString(date, format) {
        // you should do formatting based on the passed format,
        // but we will just return 'D/M/YYYY' for simplicity
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        return `${year}-${month}-${day}`;
    },
    parse(dateString, format) {
        // dateString is the result of `toString` method
        const parts = dateString.split('/');
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        return new Date(year, month, day);
    }
});
});
</script></div>
<div id="jobListTable">
<table class="table table-striped" >
	<thead>
		<tr>
		<th>Job Title</th>
		<th>Job Type</th>
		<th>Date Posted</th>
		<th>Expire Date</th>
		<th>Status</th>
		<th>Operation</th>
	 </tr>
	</thead>
<tbody>
    @foreach($jobs as $job)
    <tr>
        <td>{{ $job->job_title }}</td>
        <td>{{ $job->job_type }}</td>
        <td>{{ $job->created_at->format('M d, Y \a\t g:ia') }}</td>
        <td>{{ \Carbon\Carbon::parse($job->expired_date)->format('M d, Y \a\t g:ia') }}</td>
        <td>
            @if(now()->greaterThan($job->expired_date))
                <span class="badge bg-danger" style="color:white;">Expired</span>
            @else
                <span class="badge bg-success" style="color:white;">Open</span>
            @endif
        </td>
        <td>
            <button class="btn btn-sm btn-primary edit" style="display: none;" data-id="{{ $job->id }}">Edit</button>
            <button class="btn btn-sm btn-danger delete" style="display:none;"data-id="{{ $job->id }}">Delete</button>
        </td>
    </tr>
    @endforeach

		</tbody>
</table>
</div></div>
<x-footer-component/>
</div><!-- #wrapper end -->

<!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>
    <script src="{{asset('themes/WnyMedical/assets/js/jquery.js')}}"></script>
    <script src="{{asset('themes/WnyMedical/assets/js/plugins.js')}}"></script>
    <script src="{{asset('themes/WnyMedical/assets/js/functions.js')}}"></script>
    <script src="{{asset('wnymodules/system/assets/js/framework.combined-min.js')}}"></script>
<link rel="stylesheet" property="stylesheet" href="{{asset('wnymodules/system/assets/css/framework.extras.css')}}">
    <script src="https://wnymedical.com/plugins/amjadkhan/jobs/assets/js/pikaday.js"></script>
<script src="https://wnymedical.com/plugins/amjadkhan/jobs/assets/js/moment.min.js"></script>

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
