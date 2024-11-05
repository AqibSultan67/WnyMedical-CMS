<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Materialize - Material Design HTML Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/remixicon/remixicon.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-statistics.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-analytics.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('vendor/datatables.net-bs4/dataTables.bootstrap4.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('vendor/js/select.dataTables.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
    <!-- Helpers -->

    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
<style>

</style>
</head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
          <!-- Menu -->

          <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <span style="color: var(--bs-primary)">
                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                        fill="url(#paint0_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="url(#paint1_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                        fill="currentColor" />
                      <defs>
                        <linearGradient
                          id="paint0_linear_2989_100980"
                          x1="5.36642"
                          y1="0.849138"
                          x2="10.532"
                          y2="24.104"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_2989_100980"
                          x1="5.19475"
                          y1="0.849139"
                          x2="10.3357"
                          y2="24.1155"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </span>
                </span>
                <span class="app-brand-text demo menu-text fw-semibold ms-2">Materialize</span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                    fill-opacity="0.9" />
                  <path
                    d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                    fill-opacity="0.4" />
                </svg>
              </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
              <!-- Dashboards -->
              <li class="menu-item active open">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ri-home-smile-line"></i>
                  <div data-i18n="Dashboards">Dashboards</div>
                  {{-- <div class="badge bg-danger rounded-pill ms-auto">5</div> --}}
                </a>
                <ul class="menu-sub">





                </ul>
              </li>

              <!-- Layouts -->
              {{-- <li class="menu-item">
                {{-- <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ri-layout-2-line"></i>
                  <div data-i18n="Layouts">Layouts</div>
                </a> --}}

                {{--   <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('home-content.index')}}" class="menu-link">
                      <div data-i18n="Collapsed menu">Collapsed menu</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="layouts-content-navbar.html" class="menu-link">
                      <div data-i18n="Content navbar">Content navbar</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="{{route('menu.index')}}" class="menu-link">
                      <div data-i18n="Menu">Menu</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="../horizontal-menu-template" class="menu-link" target="_blank">
                      <div data-i18n="Horizontal">Horizontal</div>
                    </a>
                  </li> --}}

                  {{-- <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                      <div data-i18n="Without navbar">Without navbar</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="layouts-fluid.html" class="menu-link">
                      <div data-i18n="Fluid">Fluid</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                      <div data-i18n="Container">Container</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="layouts-blank.html" class="menu-link">
                      <div data-i18n="Blank">Blank</div>
                    </a>
                  </li>
                </ul>
              </li>  --}}

              <!-- Front Pages -->
              <li class="menu-item">
                {{-- <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ri-file-copy-line"></i>
                  <div data-i18n="Front Pages">Front Pages</div>
                </a> --}}
                <ul class="menu-sub">
                  {{-- <li class="menu-item">
                    <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                      <div data-i18n="Landing">Landing</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                      <div data-i18n="Pricing">Pricing</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                      <div data-i18n="Payment">Payment</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                      <div data-i18n="Checkout">Checkout</div>
                    </a>
                  </li> --}}
                  {{-- <li class="menu-item">
                    <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                      <div data-i18n="Help Center">Help Center</div>
                    </a>
                  </li> --}}
                </ul>
              </li>

              <!-- Apps & Pages -->
              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="Home Page">Home Page</span>
              </li>
              <li class="menu-item {{ request()->routeIs('menu.index') ? 'active' : '' }}">
                <a href="{{route('menu.index')}}" class="menu-link">
                    <i class="menu-icon tf-icons ri-menu-line"></i>
                  <div data-i18n="Menu">Menu</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('updates.index') ? 'active' : '' }}">
                <a href="{{route('updates.index')}}" class="menu-link">
                    <i class="menu-icon tf-icons ri-menu-line"></i>
                  <div data-i18n="Updates">Updates</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('admin.sliders.index') ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-image-line"></i>
                  <div data-i18n="Slider Images">Slider Images</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('home-content.index') ? 'active' : '' }}">
                <a href="{{ route('home-content.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-settings-2-line"></i>
                  <div data-i18n="What We Do Section">What We Do Section</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('portal-content.index') ? 'active' : '' }}">
                <a href="{{ route('portal-content.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-file-list-line"></i>
                  <div data-i18n="What We Do Types">What We Do Types</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('specialists.index') ? 'active' : '' }}">
                <a href="{{ route('specialists.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-user-star-line"></i>
                  <div data-i18n="Our Specialists">Our Specialists</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('info.index') ? 'active' : '' }}">
                <a href="{{ route('info.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-group-line"></i>
                  <div data-i18n="Who We Are">Who We Are</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('footer.index') ? 'active' : '' }}">
                <a href="{{ route('footer.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-layout-line"></i>
                  <div data-i18n="Footer Section">Footer  Section</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('practices.index') ? 'active' : '' }}">
                <a href="{{ route('practices.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-hospital-line"></i>
                  <div data-i18n="WNY Medical, PC">WNY Medical, PC</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('team-title-image.index') ? 'active' : '' }}">
                <a href="{{ route('team-title-image.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-image-line"></i>
                  <div data-i18n="Team Background Image">Team Background Image</div>
                </a>
              </li>

              <!-- Components -->
              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="About Us">About Us</span>
              </li>



              <li class="menu-item {{ request()->routeIs('mission.index') ? 'active' : '' }}">
                <a href="{{ route('mission.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-flag-line"></i>
                  <div data-i18n="Our Mission">Our Mission</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('about-images.index') ? 'active' : '' }}">
                <a href="{{ route('about-images.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-gallery-line"></i>
                  <div data-i18n="About Images">About Images</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('career-content.index') ? 'active' : '' }}">
                <a href="{{ route('career-content.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-file-text-line"></i>
                  <div data-i18n="Career Main Content">Career Main Content</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('career-services.index') ? 'active' : '' }}">
                <a href="{{ route('career-services.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-service-line"></i>
                  <div data-i18n="Career Services">Career Services</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('career-jobs.index') ? 'active' : '' }}">
                <a href="{{ route('career-jobs.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-briefcase-line"></i>
                  <div data-i18n="Job Posting">Job Posting</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('pcm-content.index') ? 'active' : '' }}">
                <a href="{{ route('pcm-content.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ri-home-line"></i>
                    <div data-i18n="PCM Home">PCM Home</div>
                </a>
            </li>



              <li class="menu-item {{ request()->routeIs('pcm-video-link.index') ? 'active' : '' }}">
                <a href="{{ route('pcm-video-link.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-video-line"></i>
                  <div data-i18n="PCM Video Link">PCM Video Link</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('pcm-overview.index') ? 'active' : '' }}">
                <a href="{{ route('pcm-overview.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-clipboard-line"></i>
                  <div data-i18n="PCM Overview">PCM Overview</div>
                </a>
              </li>






              <!-- Forms & Tables -->
              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="Patients">Patients</span>
              </li>

              <li class="menu-item {{ request()->routeIs('patient-files.index') ? 'active' : '' }}">
                <a href="{{ route('patient-files.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-file-text-line"></i>
                  <div data-i18n="Patient Documents">Patient Documents</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('faq.index') ? 'active' : '' }}">
                <a href="{{ route('faq.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-question-line"></i>
                  <div data-i18n="FAQ">FAQ</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('patient-portal-services.index') ? 'active' : '' }}">
                <a href="{{ route('patient-portal-services.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-service-line"></i>
                  <div data-i18n="Patient Portal Services">Patient Portal Services</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('telemedicine.index') ? 'active' : '' }}">
                <a href="{{ route('telemedicine.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-remote-control-line"></i>
                  <div data-i18n="Telemedicine">Telemedicine</div>
                </a>
              </li>

              <li class="menu-item {{ request()->routeIs('covid-19.index') ? 'active' : '' }}">
                <a href="  {{ route('covid-19.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-virus-line"></i>
                  <div data-i18n="Covid-19">Covid-19</div>
                </a>
              </li>

              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="Location">Location</span>
              </li>

              <li class="menu-item {{ request()->routeIs('location.index') ? 'active' : '' }}">
                <a href="{{ route('location.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-map-pin-line"></i>
                  <div data-i18n="Location">Location</div>
                </a>
              </li>








              {{-- <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ri-grid-line"></i>
                  <div data-i18n="Datatables">Datatables</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="tables-datatables-basic.html" class="menu-link">
                      <div data-i18n="Basic">Basic</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="tables-datatables-advanced.html" class="menu-link">
                      <div data-i18n="Advanced">Advanced</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="tables-datatables-extensions.html" class="menu-link">
                      <div data-i18n="Extensions">Extensions</div>
                    </a>
                  </li>
                </ul>
              </li> --}}

              <!-- Charts & Maps -->

              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="Media">Media</span>
              </li>
              {{-- <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons ri-bar-chart-2-line"></i>
                  <div data-i18n="Charts">Charts</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="charts-apex.html" class="menu-link">
                      <div data-i18n="Apex Charts">Apex Charts</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="charts-chartjs.html" class="menu-link">
                      <div data-i18n="ChartJS">ChartJS</div>
                    </a>
                  </li>
                </ul>
              </li> --}}
              <li class="menu-item {{ request()->routeIs('media-link.index') ? 'active' : '' }}">
                <a href="{{route('media-link.index')}}" class="menu-link">
                  <i class="menu-icon tf-icons ri-file-list-line"></i>
                  <div data-i18n="Media Links">Media Links</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                <a href="{{route('blog.index')}}" class="menu-link">
                  <i class="menu-icon tf-icons ri-file-list-line"></i>
                  <div data-i18n="Press Release">Press Release</div>
                </a>
              </li>

              <!-- Misc -->
              <li class="menu-header mt-5">
                <span class="menu-header-text" data-i18n="Services">Services</span>
              </li>
              <li class="menu-item {{ request()->routeIs('services-schedule.index') ? 'active' : '' }}">
                <a href="{{route('services-schedule.index')}}" class="menu-link">
                  <i class="menu-icon tf-icons ri-calendar-line"></i>
                  <div data-i18n="Mammogram Schedule">Mammogram Schedule</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('service.index') ? 'active' : '' }}">
                <a
                  href="{{route('service.index')}}"

                  class="menu-link">
                  <i class="menu-icon tf-icons ri-service-line"></i>
                  <div data-i18n="Services">Services</div>
                </a>
              </li>
              <li class="menu-item {{ request()->routeIs('services-title-image.index') ? 'active' : '' }}">
                <a href="{{route('services-title-image.index')}}"  class="menu-link">
                  <i class="menu-icon tf-icons ri-image-line"></i>
                  <div data-i18n="Services Background Image">Services Background Image</div>
                </a>
              </li>
            </ul>
          </aside>
          <!-- / Menu -->

          <!-- Layout container -->
          <div class="layout-page">
            <!-- Navbar -->

            <nav
              class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
              id="layout-navbar">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                  <i class="ri-menu-fill ri-22px"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <!-- Search -->
                <div class="navbar-nav align-items-center">
                  <div class="nav-item navbar-search-wrapper mb-0">
                    <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
                      <i class="ri-search-line ri-22px scaleX-n1-rtl me-3"></i>
                      <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                    </a>
                  </div>
                </div>
                <!-- /Search -->

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <!-- Language -->
                  <li class="nav-item dropdown-language dropdown">
                    <a
                      class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                      href="javascript:void(0);"
                      data-bs-toggle="dropdown">
                      <i class="ri-translate-2 ri-22px"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                          <span class="align-middle">English</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                          <span class="align-middle">French</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                          <span class="align-middle">Arabic</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                          <span class="align-middle">German</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <!--/ Language -->

                  <!-- Quick links  -->
                  <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-1 me-xl-0">
                    <a
                      class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                      href="javascript:void(0);"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false">
                      <i class="ri-star-smile-line ri-22px"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                      <div class="dropdown-menu-header border-bottom py-50">
                        <div class="dropdown-header d-flex align-items-center py-2">
                          <h6 class="mb-0 me-auto">Shortcuts</h6>
                          <a
                            href="javascript:void(0)"
                            class="btn btn-text-secondary rounded-pill btn-icon dropdown-shortcuts-add text-heading"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Add shortcuts"
                            ><i class="ri-add-line ri-24px"></i
                          ></a>
                        </div>
                      </div>
                      <div class="dropdown-shortcuts-list scrollable-container">
                        <div class="row row-bordered overflow-visible g-0">
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-calendar-line ri-26px text-heading"></i>
                            </span>
                            <a href="app-calendar.html" class="stretched-link">Calendar</a>
                            <small class="mb-0">Appointments</small>
                          </div>
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-file-text-line ri-26px text-heading"></i>
                            </span>
                            <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                            <small class="mb-0">Manage Accounts</small>
                          </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-user-line ri-26px text-heading"></i>
                            </span>
                            <a href="app-user-list.html" class="stretched-link">User App</a>
                            <small class="mb-0">Manage Users</small>
                          </div>
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-computer-line ri-26px text-heading"></i>
                            </span>
                            <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                            <small class="mb-0">Permission</small>
                          </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-pie-chart-2-line ri-26px text-heading"></i>
                            </span>
                            <a href="index.html" class="stretched-link">Dashboard</a>
                            <small class="mb-0">Analytics</small>
                          </div>
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-settings-4-line ri-26px text-heading"></i>
                            </span>
                            <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                            <small class="mb-0">Account Settings</small>
                          </div>
                        </div>
                        <div class="row row-bordered overflow-visible g-0">
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-question-line ri-26px text-heading"></i>
                            </span>
                            <a href="pages-faq.html" class="stretched-link">FAQs</a>
                            <small class="mb-0">FAQs & Articles</small>
                          </div>
                          <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                              <i class="ri-tv-2-line ri-26px text-heading"></i>
                            </span>
                            <a href="modal-examples.html" class="stretched-link">Modals</a>
                            <small class="mb-0">Useful Popups</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- Quick links -->

                  <!-- Notification -->
                  <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
                    <a
                      class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                      href="javascript:void(0);"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false">
                      <i class="ri-notification-2-line ri-22px"></i>
                      <span
                        class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end py-0">
                      <li class="dropdown-menu-header border-bottom py-50">
                        <div class="dropdown-header d-flex align-items-center py-2">
                          <h6 class="mb-0 me-auto">Notification</h6>
                          <div class="d-flex align-items-center">
                            <span class="badge rounded-pill bg-label-primary fs-xsmall me-2">8 New</span>
                            <a
                              href="javascript:void(0)"
                              class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="Mark all as read"
                              ><i class="ri-mail-open-line text-heading ri-20px"></i
                            ></a>
                          </div>
                        </div>
                      </li>
                      <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                                <small class="text-muted">1h ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">Charles Franklin</h6>
                                <small class="mb-1 d-block text-body">Accepted your connection</small>
                                <small class="text-muted">12hr ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../../assets/img/avatars/2.png" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">New Message ✉️</h6>
                                <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                                <small class="text-muted">1h ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-success"
                                    ><i class="ri-shopping-cart-2-line"></i
                                  ></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                                <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                                <small class="text-muted">1 day ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../../assets/img/avatars/9.png" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">Application has been approved 🚀</h6>
                                <small class="mb-1 d-block text-body"
                                  >Your ABC project application has been approved.</small
                                >
                                <small class="text-muted">2 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-success"
                                    ><i class="ri-pie-chart-2-line"></i
                                  ></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">Monthly report is generated</h6>
                                <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                                <small class="text-muted">3 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../../assets/img/avatars/5.png" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">Send connection request</h6>
                                <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                                <small class="text-muted">4 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <img src="../../assets/img/avatars/6.png" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">New message from Jane</h6>
                                <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                                <small class="text-muted">5 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                  <span class="avatar-initial rounded-circle bg-label-warning"
                                    ><i class="ri-error-warning-line"></i
                                  ></span>
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <h6 class="mb-1 small">CPU is running high</h6>
                                <small class="mb-1 d-block text-body"
                                  >CPU Utilization Percent is currently at 88.63%,</small
                                >
                                <small class="text-muted">5 days ago</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ><span class="badge badge-dot"></span
                                ></a>
                                <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="ri-close-line ri-20px"></span
                                ></a>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </li>
                      <li class="border-top">
                        <div class="d-grid p-4">
                          <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                            <small class="align-middle">View all notifications</small>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <!--/ Notification -->

                  <!-- User -->
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-2">
                              <div class="avatar avatar-online">
                                <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-medium d-block small">John Doe</span>
                              <small class="text-muted">Admin</small>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages-profile-user.html">
                          <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages-account-settings-account.html">
                          <i class="ri-settings-4-line ri-22px me-3"></i><span class="align-middle">Settings</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages-account-settings-billing.html">
                          <span class="d-flex align-items-center align-middle">
                            <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                            <span class="flex-grow-1 align-middle">Billing</span>
                            <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                          </span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages-pricing.html">
                          <i class="ri-money-dollar-circle-line ri-22px me-3"></i
                          ><span class="align-middle">Pricing</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="pages-faq.html">
                          <i class="ri-question-line ri-22px me-3"></i><span class="align-middle">FAQ</span>
                        </a>
                      </li>
                      <li>
                        <div class="d-grid px-4 pt-2 pb-1">
                          <a class="btn btn-sm btn-danger d-flex" href="auth-login-cover.html" target="_blank">
                            <small class="align-middle">Logout</small>
                            <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <!--/ User -->
                </ul>
              </div>

              <!-- Search Small Screens -->
              <div class="navbar-search-wrapper search-input-wrapper d-none">
                <input
                  type="text"
                  class="form-control search-input container-xxl border-0"
                  placeholder="Search..."
                  aria-label="Search..." />
                <i class="ri-close-fill search-toggler cursor-pointer"></i>
              </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
              <!-- Content -->
             @yield('sliders')
              @yield('content')
              @yield('info')
              <!-- / Content -->
            </div>
              <!-- Footer -->
              <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                  <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body mb-2 mb-md-0">
                      ©
                      <script>
                        document.write(new Date().getFullYear());
                      </script>
                      , made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by
                      <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                      <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                        >License</a
                      >
                      <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                        >More Themes</a
                      >

                      <a
                        href="https://demos.pixinvent.com/materialize-html-admin-template/documentation/"
                        target="_blank"
                        class="footer-link me-4"
                        >Documentation</a
                      >

                      <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                        >Support</a
                      >
                    </div>
                  </div>
                </div>
              </footer>


              <div class="content-backdrop fade"></div>
            </div>

          </div>

        </div>


        <div class="layout-overlay layout-menu-toggle"></div>


        <div class="drag-target"></div>
      </div>




    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

  </body>
</html>
