<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{isRtl() ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title-->
    <title>@lang('app.name') | @yield('title')</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{mix('bluebox/css/main.min.css')}}">

    @if(isRtl())
        <link rel="stylesheet" type="text/css" href="{{mix('css/global-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bluebox/css/rtl.css')}}">
    @endif
  </head>
  <body id="app">
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-light" role="status"><span class="sr-only">@lang('global.Loading')</span></div>
    </div>
    <!-- Header Area-->
    <header class="header-area header2">
      <div class="container">
        <div class="classy-nav-container breakpoint-off">
          <nav class="classy-navbar justify-content-between" id="saasboxNav">
            <!-- Logo--><a class="nav-brand mr-0 ml-5" href="#"><img src="{{asset('images/logo/logo.png')}}" alt=""></a>
            <!-- Navbar Toggler-->
            <div class="classy-navbar-toggler"><span class="navbarToggler"><span></span><span></span><span></span><span></span></span></div>
            <!-- Menu-->
            <div class="classy-menu">
              <!-- close btn-->
              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>
              <!-- Nav Start-->
              <div class="classynav">
                <ul id="corenav" class="ml-50">
                  <li><a href="{{url('/')}}">@lang('site.Home')</a></li>
                  <li><a href="{{url('faq')}}">@lang('site.FAQ')</a></li>
                  <li><a href="#">@lang('global.Products')</a>
                    <div class="megamenu">
                      <div class="single-mega cn-col-3">
                        <div class="megamenu-thumb"><img class="w-100" src="{{asset('images/bg-img/2.jpg')}}" alt=""></div>
                      </div>
                      <ul class="single-mega cn-col-3">
                        <li><h5 class="mr-30 my-3">@lang('site.ExtraServices')</h5></li>
                        <li><a href="">@lang('global.PayForm')</a></li>
                        <li><a href="">@lang('global.PayInvoice')</a></li>
                        <li><a href="">@lang('global.PayForm')</a></li>
                        <li><a href="">@lang('global.DedicatedGateway')</a></li>
                        <li><a href="">@lang('global.QRPay')</a></li>
                        <li><a href="">@lang('global.USSDPay')</a></li>
                      </ul>
                      <ul class="single-mega cn-col-3">
                        <li><h5 class="mr-30 my-3">@lang('site.MainServices')</h5></li>
                        <li><a href="#">@lang('global.IPG')</a></li>
                        <li><a href="#">@lang('global.MultiplexIPG')</a></li>
                        <li><a href="#">@lang('global.MPG')</a></li>
                        <li><a href="#">@lang('global.AsanLink')</a></li>
                        <li><a href="#">@lang('global.InAppPay')</a></li>
                        <li><a href="#">@lang('global.PayWithWallet')</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a href="#">@lang('global.Developers')</a>
                    <ul class="dropdown">
                        <li><a href="{{url('plugins')}}">@lang('global.Plugins')</a></li>
                        <li><a href="{{url('documentations')}}">@lang('global.MerchantAPIDoc')</a></li>
                        <li><a target="_blank" href="https://github.com/asanpay">Github</a></li>
                    </ul>
                  </li>

                  <li><a href="{{url('fees')}}">@lang('global.Fees')</a></li>
                  <li><a href="{{url('blog')}}">@lang('global.Blog')</a></li>
                  <li><a href="{{url('contact-us')}}">@lang('global.ContactUs')</a></li>
                </ul>

                <!-- Login Button-->
                <div class="login-btn-area ml-4 mt-4 mt-lg-0"><a class="btn saasbox-btn btn-sm" href="{{url('/dashboard')}}">@lang('global.UserPanel')</a></div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    @yield('content')
    <!-- Footer Area-->
    <footer class="footer-area footer2 section-padding-120">
      <div class="container">
        <div class="row justify-content-between">
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-10 col-lg-3">
            <div class="footer-widget-area mb-70"><a class="d-block mb-4" href="#"><img src="{{asset('images/logo/logo-white.png')}}" alt=""></a>
              <p>@lang('site.NewsIntro')</p>
              <div class="newsletter-form">
                <form action="#">
                  <input class="form-control" type="email" placeholder="@lang('global.YourEmail')">
                  <button class="btn d-none" type="submit">Go</button>
                </form>
              </div>
              <div class="footer-social-icon d-flex align-items-center">
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Facbook"><i class="fa fa-facebook"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
              </div>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-widget-area mb-70">
              <h5 class="widget-title">@lang('site.UsefulLinks')</h5>
              <ul>
                <li><a href="{{url('tracking')}}">@lang('global.TrackTransaction')</a></li>
                <li><a href="{{url('terms')}}">{{__('Terms and Conditions')}}</a></li>
                <li><a href="{{url('privacy')}}">{{__('Privacy')}}</a></li>
                <li><a href="{{url('help-center')}}">{{__('Help Center')}}</a></li>
                <li><a href="{{url('contact-us')}}">{{__('Contact Us')}}</a></li>
                <li><a href="{{url('contact-us')}}">{{__('Contact Us')}}</a></li>
              </ul>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-widget-area mb-70">
              <h5 class="widget-title">Our Products</h5>
              <ul>
                <li><a href="#" target="_blank">Apland Landing</a></li>
                <li><a href="#" target="_blank">Ecaps Admin</a></li>
                <li><a href="#" target="_blank">Bigshop Ecommerce</a></li>
                <li><a href="#" target="_blank">Classy Multipurpose</a></li>
                <li><a href="#" target="_blank">Educamp Education</a></li>
                <li><a href="#" target="_blank">Champ Portfolio</a></li>
              </ul>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-widget-area mb-70">
              <h5 class="widget-title">My Account</h5>
              <ul>
                <li><a href="#" target="_blank">Community &amp; Forum</a></li>
                <li><a href="#" target="_blank">About Licences</a></li>
                <li><a href="#" target="_blank">Careers</a></li>
                <li><a href="#" target="_blank">Terms &amp; Conditions</a></li>
                <li><a href="#" target="_blank">Privacy Policy</a></li>
                <li><a href="#" target="_blank">Help &amp; Support</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-6 col-lg-5">
            <!-- Copyright Text-->
            <div class="footer--content-text">
              <p class="mb-0">@lang('app.copyright')</p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-5">
            <!-- Footer Nav-->
            <div class="footer-nav">
              <ul class="d-flex">
                <li><a href="{{url('privacy')}}" target="_blank">@lang('Privacy')</a></li>
                <li><a href="{{url('terms')}}" target="_blank">@lang('global.TermsAndConditions')</a></li>
                <li><a href="#" target="_blank">@lang('global.Support')</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-lg-2">
            <!-- Default dropup button-->
            <div class="language-dropdown text-center text-lg-right mt-4 mt-lg-0">
              <div class="btn-group dropup">
                <button class="btn saasbox-btn-2 dropdown-toggle text-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('global.Language')
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-ir"></span>فارسی</a>
                    <a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-sa"></span>عربی</a>
                    <a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-us"></span>English</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- All JavaScript Files-->
    <script defer src="{{mix('js/app.js')}}"></script>
    <script defer src="{{mix('bluebox/js/main.min.js')}}"></script>
    <script defer src="{{mix('fonts/fontawesome-all.js')}}"></script>
  </body>

</html>
