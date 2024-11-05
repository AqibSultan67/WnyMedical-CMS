<div class="content-wrap">
    <div class="container clearfix">
    </div>
    <div class="heading-block nobottomborder center divcenter mb-0 clearfix" style="max-width: 870px">

        @if($homeContent)
<h3 class="nott ls0 mb-3">{{ strip_tags($homeContent->title) }}</h3>
<p style="font-family: arial;">
{!! $homeContent->content !!}
</p>
@else
<p>No content available for this section.</p>
@endif
    </div>
