<div>
    <footer id="footer" class="noborder" style="background: url('https://wnymedical.com/themes/WnyMedical/assets/images/wny1.jpg') center bottom no-repeat; background-size: cover;">
        <div class="container clearfix">
            <div class="footer-widgets-wrap clearfix">
                <div class="row widget clearfix">
                    <div class="tleft col-sm-2"></div>
                    <div class="tleft col-sm-6">
                        @if($info)
                            <h4 style="font-size: 22px;">{{ strip_tags($info->title) }}</h4>
                            <p class="nobottommargin">{{ strip_tags($info->description) }}</p>
                        @else
                            <div>No data available for this section.</div>
                        @endif
                    </div>
                    <div class="tleft col-sm-4">
                        @if($info)
                            <h4 style="font-size: 22px;">{{ strip_tags($info->location_title) }}</h4>
                            <address>{{ strip_tags($info->address) }}<br></address>
                            <abbr title="Phone Number"><strong>Phone:</strong></abbr>{{ strip_tags($info->phone) }}<br>
                            <abbr title="Email Address"><strong>Email:</strong></abbr>{{ strip_tags($info->email) }}<br>
                        @else
                            <div>No data available for this section.</div>
                        @endif
                        <div class="clear"></div>
                        <a href="" target="_new" class="social-icon si-colored si-small si-rounded si-facebook nobottommargin" style="margin: 10px 10px 0 0;">
                            <i class="icon-facebook"></i>
                        </a>
                        <a href="" target="_new" class="social-icon si-colored si-small si-rounded si-twitter nobottommargin" style="margin: 10px 10px 0 0;">
                            <i class="icon-twitter"></i>
                        </a>
                        <a href="" target="_new" class="social-icon si-colored si-small si-rounded si-linkedin nobottommargin" style="margin: 10px 10px 0 0;">
                            <i class="icon-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="copyrights" class="center" style="background-color: #FFF;">
            <div class="container clearfix">
                <div class="clearfix">
                    @if($footer)
                        {{ strip_tags($footer->copyright) }} <br> Powered by
                        <a href="{{ strip_tags($footer->powered_by) }}" target="_new">{{ strip_tags($footer->powered_by) }}</a>
                    @else
                        <div>No data available.</div>
                    @endif
                </div>
            </div>
        </div>
    </footer>
</div>
