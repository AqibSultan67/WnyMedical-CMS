<div id="oc-team" class="owl-carousel team-carousel carousel-widget" data-margin="30" data-nav="true" data-pagi="true" data-items-xs="1" data-items-sm="2" data-items-lg="3" data-items-xl="4">

    @foreach($specialists as $specialist)
<div class="team">
<div class="team-image">
<img src="{{ asset('storage/specialists/' . $specialist->image) }}" alt="{{ $specialist->specialist_name }}">
</div>
<div class="team-desc">
<div class="team-title">
    <a href="{{ route('team.details', ['slug' => $specialist->slug]) }}">
        <b>{{ $specialist->specialist_name }}</b>
    </a><br>
<p>{{ strip_tags($specialist->speciality) }}</p>
</div>
</div>
</div>
@endforeach
        </div>
