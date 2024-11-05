<div class="container clearfix">
    <div class="col_one_third">
        <div class="feature-box fbox-plain">
            <div class="fbox-icon" data-animate="bounceIn">
                <a href="#"><i class="icon-medical-i-social-services"></i></a>
            </div>
            @if(isset($portals[0]))
                <h3>{{ strip_tags($portals[0]->title) }}</h3>
                <p style="text-align:justify;">{{ strip_tags($portals[0]->content) }}</p>
            @else
                <h3>No Title Available</h3>
                <p style="text-align:justify;">No content available.</p>
            @endif
        </div>
    </div>

    <div class="col_one_third col_last">
        <div class="feature-box fbox-plain">
            <div class="fbox-icon" data-animate="bounceIn" data-delay="400">
                <a href="#"><i class="icon-medical-i-cardiology"></i></a>
            </div>
            @if(isset($portals[1]))
                <h3>{{ strip_tags($portals[1]->title) }}</h3>
                <p style="text-align:justify;">{{ strip_tags($portals[1]->content) }}</p>
            @else
                <h3>No Title Available</h3>
                <p style="text-align:justify;">No content available.</p>
            @endif
        </div>
    </div>

    <div class="col_one_third">
        <div class="feature-box fbox-plain">
            <div class="fbox-icon" data-animate="bounceIn" data-delay="200">
                <a href="#"><i class="icon-medical-i-neurology"></i></a>
            </div>
            @if(isset($portals[2]))
                <h3>{{ strip_tags($portals[2]->title) }}</h3>
                <p style="text-align:justify;">{{ strip_tags($portals[2]->content) }}</p>
            @else
                <h3>No Title Available</h3>
                <p style="text-align:justify;">No content available.</p>
            @endif
        </div>
    </div>
</div>
