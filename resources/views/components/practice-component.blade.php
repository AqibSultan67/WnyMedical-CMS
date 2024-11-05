
    @php
    $backgroundImage = $practice->image ? asset('storage/practices/' . $practice->image) : '';
    @endphp

    <div class="section parallax topmargin-lg nobottommargin notopborder clearfix" style="background-image: url('{{ $backgroundImage }}'); background-size: cover;" data-bottom-top="background-position:0px 300px;"
    data-top-bottom="background-position:0px -300px;">
    <div class="container clearfix">

        <div class="row clearfix">
            <div class="col-md-12 dark" style="padding-left: 60px;">
                <div class="heading-block bottommargin-sm noborder">
                    <center>
                        <h5 class="nott" style="font-size: 46px; font-weight: 700; letter-spacing: -2px; line-height: 58px">{{ strip_tags($practice->title) }}</h5>
                        <span>{{ strip_tags($practice->subtitle) }}</span>
                    </center>
                </div>
                <p style="width: 65%; margin: auto; text-align: center;">
                    {{ strip_tags($practice->description) }}
                </p>
            </div>

            <div class="topmargin d-block d-lg-none d-xl-block"></div>

        </div>

    </div>
    </div>

