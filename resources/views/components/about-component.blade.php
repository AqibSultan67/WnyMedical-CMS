@php
$AboutImage = $images->image ? asset('storage/about-images/' . $images->image) : '';
@endphp

<section id="page-title" class="page-title-parallax" style="background-image: url('{{ $AboutImage }}'); background-position: bottom center; background-size: cover; padding: 80px 0;">

	{{-- <div class="container clearfix">
	   	       <center>	<h2>About Us</h2></center>

	</div> --}}

</section>
