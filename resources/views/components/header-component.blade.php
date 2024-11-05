
<div id="wrapper" class="clearfix">

    <div class="alert alert-warning center" role="alert">
        @if($updates)
        <a href="">{!!html_entity_decode($updates->title)!!}</a>
        @else
        <div class="text-center">No Updates Available</div>
        @endif
    </div>



    <!-- Top Bar
    ============================================= -->
    <div id="top-bar">

        <div class="container clearfix">

            <div class="col_half d-none d-md-block nobottommargin">

                <!-- Top Links
                ============================================= -->
                <div class="top-links">
                    <ul>

                        <li><a href="#"><i class="icon-phone3"></i> 716-923-4380</a></li>
                        <li><a href="#" class="nott"><i class="icon-home"></i>
                                4979 Harlem Road, Amherst, NY</a></li>
                    </ul>
                </div>
                <!-- .top-links end -->

            </div>

            <div class="col_half col_last fright nobottommargin">

                <!-- Top Links
                ============================================= -->
                <div class="top-links">

                    <ul>

                        <a style="float:left;margin-right:10px;background-color:#255164;color:white" class="btn"
                            style="" href="">
                            Pay Bill
                        </a>
                        <a style="float:left;margin-right:10px;background-color:#255164;color:white" class="btn"
                            style="" href="">
                            Patient Portal
                        </a>
                        <a style="float:left;margin-right:10px;background-color:#255164;color:white" class="btn"
                            style="" href="" target="_blank">
                            Schedule Appointment
                        </a>

                    </li>

                        <li><a style="margin-top:16px;" target="_new" href=""><i
                                    class="fa fa-facebook-square"></i></a></li>

                        <li><a style="margin-top:16px;" target="_new" href=""><i
                                    class="fa fa-twitter-square"></i></a></li>

                        <li><a style="margin-top:16px;" target="_new" href=""><i
                                    class="fa fa-linkedin-square"></i></a></li>

                        <li><a style="margin-top:16px;" target="_new" href=""><i
                                    class="fa fa-instagram -square"></i></a></li>
                    </ul>
                </div>
                <!-- .top-links end -->

            </div>

        </div>

    </div>
    <!-- #top-bar end -->

    <!-- Header
    ============================================= -->
    <header id="header">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ==================================== -->
                <div id="logo" >
                    <a href="{{ route('home.index') }}" class="standard-logo mt-3 mt-sm-0">
                        <img class="img-responsive" src="https://comwnymedical.s3.amazonaws.com/uploads/public/65b/b94/5fa/65bb945fa2ace830529094.png" alt="WNY MEDICAL, PC" style="width: 200px; height: 60px !important;">
                    </a>
                    <a href="{{ route('home.index') }}" class="retina-logo mt-3 mt-sm-0"><img
                            style="width:200px;height:60px !important;" class='img-responsive'
                            src="https://comwnymedical.s3.amazonaws.com/uploads/public/65b/b94/5fa/65bb945fa2ace830529094.png"
                            alt="WNY MEDICAL, PC"></a>

                </div>
                <!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="style-3 bg-white">
                    <ul>
                        @foreach($menuItems as $menuItem)
                            <li>
                                <a href="{{ url($menuItem->slug) }}">{{ $menuItem->name }}</a>
                                @if($menuItem->submenus && $menuItem->submenus->isNotEmpty())
                                    <ul>
                                        @foreach($menuItem->submenus as $child)
                                            <li>
                                                <a href="{{ url($child->slug) }}">{{ $child->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>         <!-- #primary-menu end -->

            </div>

        </div>

    </header>
