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
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-light" role="status"><span class="sr-only">Loading...</span></div>
    </div>
    <!-- Header Area-->
    <header class="header-area">
      <div class="container">
        <div class="classy-nav-container breakpoint-off">
          <nav class="classy-navbar justify-content-between" id="saasboxNav">
            <!-- Logo--><a class="nav-brand mr-5" href="index-2.html"><img src="img/core-img/logo-white.png" alt=""></a>
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
                <ul id="corenav">
                  <li><a href="#home">Home</a>
                    <ul class="dropdown">
                      <li><a href="creative-agency.html"><i class="lni-diamond"></i><span>Creative Agency <span>for creative agency.</span></span></a></li>
                      <li><a href="corporate-business.html"><i class="lni-bolt"></i><span>Corporate &amp; Business <span>for corporate business.</span></span></a></li>
                      <li><a href="seo-business.html"><i class="lni-bulb"></i><span>SEO &amp; Business <span>for seo &amp; business.</span></span></a></li>
                      <li><a href="sass-landing.html"><i class="lni-cog"></i><span>Saas Landing <span>for software as a service.</span></span></a></li>
                    </ul>
                  </li>
                  <li><a href="#">Pages</a>
                    <div class="megamenu">
                      <div class="single-mega cn-col-3">
                        <div class="megamenu-thumb"><img class="w-100" src="img/bg-img/2.jpg" alt=""></div>
                      </div>
                      <ul class="single-mega cn-col-3">
                        <li><a href="about-standard.html">About Standard</a></li>
                        <li><a href="about-creative.html">About Creative</a></li>
                        <li><a href="features.html">Features</a></li>
                        <li><a href="service-standard.html">Service Standard</a></li>
                        <li><a href="service-creative.html">Service Creative</a></li>
                        <li><a href="pricing-plan.html">Pricing Plan</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="team.html">Team</a></li>
                      </ul>
                      <ul class="single-mega cn-col-3">
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="reviews.html">Reviews</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="coming-soon.html">Coming Soon</a></li>
                        <li><a href="forget-password.html">Forget Password</a></li>
                        <li><a href="newsletter.html">Newsletter</a></li>
                        <li><a href="404.html">404 - Error</a></li>
                      </ul>
                    </div>
                  </li>
                  <li><a href="#blog">Works</a>
                    <ul class="dropdown">
                      <li><a href="portfolio-standard.html">Portfolio Standard</a></li>
                      <li><a href="portfolio-creative.html">Portfolio Creative</a></li>
                      <li><a href="portfolio-full-width.html">Portfolio Full Width</a></li>
                      <li><a href="portfolio-details-one.html">Portfolio Details One</a></li>
                      <li><a href="portfolio-details-two.html">Portfolio Details Two</a></li>
                      <li><a href="portfolio-details-three.html">Portfolio Details Three</a></li>
                      <li><a href="portfolio-details-four.html">Portfolio Details Four</a></li>
                    </ul>
                  </li>
                  <li><a href="#blog">Shop</a>
                    <ul class="dropdown">
                      <li><a href="shop-fullwidth.html">Shop Fullwidth</a></li>
                      <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                      <li><a href="single-product.html">Product Details</a></li>
                      <li><a href="cart.html">Cart</a></li>
                      <li><a href="checkout.html">Checkout</a></li>
                    </ul>
                  </li>
                  <li><a href="#blog">Blog</a>
                    <ul class="dropdown">
                      <li><a href="blog-card.html">Blog Card</a></li>
                      <li><a href="blog-card-sidebar.html">Blog Card Sidebar</a></li>
                      <li><a href="blog-full.html">Blog Full</a></li>
                      <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                      <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                      <li><a href="blog-details-full.html">Blog Details One</a></li>
                      <li><a href="blog-details-left-sidebar.html">Blog Details Two</a></li>
                      <li><a href="blog-details-right-sidebar.html">Blog Details Three</a></li>
                    </ul>
                  </li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
                  <!-- Login Button-->
                <div class="login-btn-area ml-4 mt-4 mt-lg-0"><a class="btn saasbox-btn btn-sm" href="#">Buy Now</a></div>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- Welcome Area-->
    <section class="welcome-area" id="home">
      <!-- Background Shape-->
      <div class="background-shape">
        <div class="circle1 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle2 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle3 wow fadeInRightBig" data-wow-duration="4000ms"></div>
        <div class="circle4 wow fadeInRightBig" data-wow-duration="4000ms"></div>
      </div>
      <!-- Background Animation-->
      <div class="background-animation">
        <div class="star-ani"></div>
        <div class="cloud-ani"></div>
        <div class="triangle-ani"></div>
        <div class="circle-ani"></div>
        <div class="box-ani"></div>
      </div>
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-between">
          <!-- Welcome Content-->
          <div class="col-12 col-md-6 col-lg-5">
            <div class="welcome-content">
              <h2 class="wow fadeInUp" data-wow-duration="1000ms">Big Creative Agency.</h2>
              <p class="mb-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="200ms">It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p><a class="btn saasbox-btn white-btn mt-3 wow fadeInUp" href="#" data-wow-duration="1000ms" data-wow-delay="400ms">More About Us</a>
            </div>
          </div>
          <!-- Welcome Thumb-->
          <div class="col-10 col-md-6">
            <div class="welcome-thumb hero1 wow fadeInUp" data-wow-delay="300ms"><img src="img/bg-img/hero-3.png" alt=""></div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Area-->
    <section class="about-area section-padding-120">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <!-- About Content Area-->
          <div class="col-12 col-lg-7 col-xl-6">
            <div class="about-content mb-100 mb-lg-0">
              <div class="row justify-content-between">
                <!-- Single About Area-->
                <div class="col-12 col-sm-6">
                  <div class="single-about-area wow fadeInUp" data-wow-duration="800ms" data-wow-delay="100ms">
                    <div class="icon"><i class="lni-sun"></i></div>
                    <h4>Web Design</h4>
                    <p>It's crafted with the latest trend of design & coded with all modern approaches.</p>
                  </div>
                </div>
                <!-- Single About Area-->
                <div class="col-12 col-sm-6">
                  <div class="single-about-area wow fadeInUp" data-wow-duration="800ms" data-wow-delay="300ms">
                    <div class="icon"><i class="lni-heart"></i></div>
                    <h4>Branding</h4>
                    <p>It's crafted with the latest trend of design & coded with all modern approaches.</p>
                  </div>
                </div>
                <!-- Single About Area-->
                <div class="col-12 col-sm-6">
                  <div class="single-about-area wow fadeInUp" data-wow-duration="800ms" data-wow-delay="500ms">
                    <div class="icon"><i class="lni-infinite"></i></div>
                    <h4>Marketing</h4>
                    <p>It's crafted with the latest trend of design & coded with all modern approaches.</p>
                  </div>
                </div>
                <!-- Single About Area-->
                <div class="col-12 col-sm-6">
                  <div class="single-about-area wow fadeInUp" data-wow-duration="800ms" data-wow-delay="700ms">
                    <div class="icon"><i class="lni-cart"></i></div>
                    <h4>Ecommerce Solution</h4>
                    <p>It's crafted with the latest trend of design & coded with all modern approaches.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- About Text Area-->
          <div class="col-12 col-lg-5">
            <div class="section-heading mb-0">
              <h6 class="wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">Our key features</h6>
              <h2 class="wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">We focus on growth of your business.</h2>
              <p class="mb-3 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p>
              <p class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p><a class="btn saasbox-btn mt-5 wow fadeInUp" href="#" data-wow-delay="400ms" data-wow-duration="1000ms">Discover More</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="border-top"></div>
    </div>
    <!-- Cool Facts Area-->
    <section class="saasbox-cool-facts-area section-padding-120-70">
      <!-- Circle Animation-->
      <div class="circle-animation">
        <div class="circle1"></div>
        <div class="circle2"></div>
        <div class="circle3"></div>
        <div class="circle4"></div>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8">
            <div class="section-heading text-center">
              <h2>We already completed  <span> 470  </span> projects successfully and more counting.</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <!-- Single Cool Facts Area-->
          <div class="col-12 col-sm-4">
            <div class="single-cool-fact mb-50 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="100ms">
              <h2><span class="rs-counter">470 </span>+</h2>
              <p>Total Projects</p>
            </div>
          </div>
          <!-- Single Cool Facts Area-->
          <div class="col-12 col-sm-4">
            <div class="single-cool-fact mb-50 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
              <h2><span class="rs-counter">21</span></h2>
              <p>Team Members</p>
            </div>
          </div>
          <!-- Single Cool Facts Area-->
          <div class="col-12 col-sm-4">
            <div class="single-cool-fact mb-50 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
              <h2><span class="rs-counter">3618</span></h2>
              <p>Coffee Served</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="border-top"></div>
    </div>
    <!-- Service Area-->
    <section class="service-area section-padding-120" id="service">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-7 col-xxl-6">
            <div class="section-heading text-center"><i class="lni-flower"></i>
              <h2>We do all <span>creative  </span> services</h2>
              <p>It's crafted with the latest trend of design &amp; coded with all modern approaches. It's a robust &amp; multi-dimensional usable template.</p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center g-5">
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-android"></i></div>
                <h4>Mobile Apps Developement</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card active wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-layout"></i></div>
                <h4>Modern Website Developement</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-pie-chart"></i></div>
                <h4>Digital Content &amp; SEO Marketing</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-wordpress"></i></div>
                <h4>WordPress 5.0 Ultimate Solution</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-sun"></i></div>
                <h4>Business Idea &amp; Creative Leads</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
          <!-- Single Service Area-->
          <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card service-card wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
              <div class="card-body">
                <div class="icon"><i class="lni-play"></i></div>
                <h4>Tutorial: Learning for future</h4>
                <p>It's crafted with the latest trend of design.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Features Area-->
    <section class="saasbox-features-area section-padding-120">
      <!-- Background Shape-->
      <div class="background-shape wow fadeInLeftBig" data-wow-duration="4000ms"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-7 col-xxl-6">
            <div class="section-heading text-center white"><i class="lni-brush"></i>
              <h2><span>Our best </span> solutions</h2>
              <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-12 col-lg-8 col-xxl-9">
            <div class="row g-4">
              <!-- Single Feature Area-->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-wordpress"></i>
                    <div class="fea-text">
                      <h6>WordPress Solution</h6><span>Ultimate Solution for WP</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Feature Area-->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-brush"></i>
                    <div class="fea-text">
                      <h6>Frontend Solution</h6><span>Solution for Webs</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Feature Area           -->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-bar-chart"></i>
                    <div class="fea-text">
                      <h6>Digital Branding</h6><span>Boot your sales</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Feature Area           -->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-wechat"></i>
                    <div class="fea-text">
                      <h6>Live Chat Help</h6><span>Support 24h a day</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Feature Area        -->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-cog"></i>
                    <div class="fea-text">
                      <h6>Easy Setup</h6><span>Solution for setup</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Single Feature Area-->
              <div class="col-12 col-md-6">
                <div class="card feature-card wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
                  <div class="card-body d-flex align-items-center"><i class="lni-bug"></i>
                    <div class="fea-text">
                      <h6>Fixed Bugs</h6><span>Unlimited bug fix</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-10 col-md-7 col-lg-4 col-xxl-3">
            <!-- Video Card Area-->
            <div class="card video-card border-0 mt-5 mt-lg-0">
              <div class="card-body p-0"><img src="img/bg-img/3.jpg" alt=""><a class="video-play-btn" href="https://www.youtube.com/watch?v=lFGvqvPh5jI"><i class="lni-play"></i><span class="video-sonar"></span></a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- saasbox Features Area-->
    <div class="saasbox-tab-area section-padding-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-6">
            <div class="section-heading text-center"><i class="lni-crown"></i>
              <h2>Awesome stunning feature for your website</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="tab--area">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="tab--1" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Design & Development</a></li>
                <li class="nav-item"><a class="nav-link" id="tab--2" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Digital Marketing</a></li>
                <li class="nav-item"><a class="nav-link" id="tab--3" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Business Solution</a></li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <!-- Tab Pane-->
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab--1">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-xxl-5">
                      <div class="tab--text mt-5">
                        <h6>Design & Development.</h6>
                        <h2>We provide best design & development solution.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, tempore placeat corrupti enim, cumque ex? Mollitia nihil sint cumque omnis iure nisi.</p><span class="d-block mt-4 mb-1">Clients Satisfaction Rate: 90%</span>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="tab-thumb mt-5"><img src="img/bg-img/4.png" alt=""></div>
                    </div>
                  </div>
                </div>
                <!-- Tab Pane-->
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab--2">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-xxl-5">
                      <div class="tab-thumb mt-5"><img src="img/bg-img/bg-1.png" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="tab--text mt-5">
                        <h6>Digital Marketing.</h6>
                        <h2>We provide digital marketing solution.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, tempore placeat corrupti enim, cumque ex? Mollitia nihil sint cumque omnis iure nisi.</p><span class="d-block mt-4 mb-1">Clients Return Rate: 70%</span>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Tab Pane-->
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab--3">
                  <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-6 col-xxl-5">
                      <div class="tab--text mt-5">
                        <h6>Business Solution.</h6>
                        <h2>We provide creative business solution.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, tempore placeat corrupti enim, cumque ex? Mollitia nihil sint cumque omnis iure nisi.</p><span class="d-block mt-4 mb-1">Business Solution Rate: 85%</span>
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="tab-thumb mt-5"><img src="img/bg-img/bg-2.png" alt=""></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pricing Plan Area-->
    <section class="saasbox-pricing-plan-area section-padding-120 bg-gray">
      <!-- Pricing Shape-->
      <div class="price-shape">
        <!--img(src="img/core-img/price-shape.png" alt="")-->
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-7 col-xxl-6">
            <div class="section-heading text-center">
              <h6>Pricing Plan</h6>
              <h2>Simple, Transparent Price</h2>
              <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="pricing-table-switch mb-100">
              <ul class="nav nav-tabs border-bottom-0 justify-content-center" id="priceTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="month--tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="true">monthly</a></li>
                <li class="nav-item"><a class="nav-link" id="yearly--tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yearly</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12">
            <div class="tab-content" id="priceTabContent">
              <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="month--tab">
                <div class="row g-0 justify-content-center">
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-pizza"></i></div>
                        <div class="price">
                          <h5>Basic</h5>
                          <h2>$19</h2><span>per month</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li class="times">1 Website License</li>
                          <li class="times">Free Support</li>
                          <li class="times">Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card active mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-offer"></i></div>
                        <div class="price">
                          <h5>Standard</h5>
                          <h2>$29</h2><span>per month</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li>1 Website License</li>
                          <li class="times">Free Support</li>
                          <li class="times">Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-burger"></i></div>
                        <div class="price">
                          <h5>Business</h5>
                          <h2>$49</h2><span>per month</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li>1 Website License</li>
                          <li>Free Support</li>
                          <li>Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="yearly--tab">
                <div class="row g-0 justify-content-center">
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-pizza"></i></div>
                        <div class="price">
                          <h5>Basic</h5>
                          <h2>$33</h2><span>per year</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li class="times">1 Website License</li>
                          <li class="times">Free Support</li>
                          <li class="times">Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card active mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-offer"></i></div>
                        <div class="price">
                          <h5>Standard</h5>
                          <h2>$69</h2><span>per year</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li>1 Website License</li>
                          <li class="times">Free Support</li>
                          <li class="times">Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                  <!-- Single Pricing Plan-->
                  <div class="col-12 col-sm-8 col-md-7 col-lg-4">
                    <div class="card pricing-card mb-30">
                      <div class="pricing-heading d-flex align-items-center">
                        <div class="price-icon"><i class="lni-burger"></i></div>
                        <div class="price">
                          <h5>Business</h5>
                          <h2>$99</h2><span>per year</span>
                        </div>
                      </div>
                      <div class="pricing-desc">
                        <ul class="pl-0">
                          <li>1 Month Usage</li>
                          <li>Lifetime Updates</li>
                          <li>1 Website License</li>
                          <li>Free Support</li>
                          <li>Download New Release</li>
                        </ul>
                      </div>
                      <div class="pricing-btn"><a class="btn saasbox-btn" href="#">Choose Plan</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Portfolio Area-->
    <section class="saasbox-portfolio-area section-padding-120-40">
      <div class="container">
        <div class="row align-items-end justify-content-between">
          <div class="col-12 col-md-8 col-lg-7 col-xxl-6">
            <div class="section-heading mb-0">
              <h2>Check our latest awesome creative works</h2>
              <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p>
            </div>
          </div>
          <div class="col-12 col-md-4 col-lg-5">
            <div class="portfolio-btn pb-3 text-md-right mt-5 mt-md-0"><a class="btn saasbox-btn" href="portfolio-creative.html">View All Works</a></div>
          </div>
        </div>
      </div>
      <div class="container-fluid px-0">
        <div class="portfolio-slides owl-carousel">
          <!-- Single Portfolio Area-->
          <div class="single-portfolio-area mx-3 mt-70 mb-80"><img src="img/bg-img/p1.jpg" alt="">
              <!-- Ovarlay Content-->
            <div class="overlay-content">
              <div class="portfolio-title"><a href="portfolio-details-one.html">Portfolio Title</a></div>
              <div class="portfolio-links"><a class="image-popup" href="img/bg-img/p1.jpg" data-effect="mfp-zoom-in" title="Portfolio Title"><i class="lni-play"></i></a><a href="#"><i class="lni-heart"></i></a><a href="portfolio-details-one.html"><i class="lni-link"></i></a></div>
            </div>
          </div>
          <!-- Single Portfolio Area-->
          <div class="single-portfolio-area mx-3 mt-70 mb-80"><img src="img/bg-img/p2.jpg" alt="">
              <!-- Ovarlay Content-->
            <div class="overlay-content">
              <div class="portfolio-title"><a href="portfolio-details-one.html">Portfolio Title</a></div>
              <div class="portfolio-links"><a class="image-popup" href="img/bg-img/p2.jpg" data-effect="mfp-zoom-in" title="Portfolio Title"><i class="lni-play"></i></a><a href="#"><i class="lni-heart"></i></a><a href="portfolio-details-one.html"><i class="lni-link"></i></a></div>
            </div>
          </div>
          <!-- Single Portfolio Area-->
          <div class="single-portfolio-area mx-3 mt-70 mb-80"><img src="img/bg-img/p3.jpg" alt="">
              <!-- Ovarlay Content-->
            <div class="overlay-content">
              <div class="portfolio-title"><a href="portfolio-details-one.html">Portfolio Title</a></div>
              <div class="portfolio-links"><a class="image-popup" href="img/bg-img/p3.jpg" data-effect="mfp-zoom-in" title="Portfolio Title"><i class="lni-play"></i></a><a href="#"><i class="lni-heart"></i></a><a href="portfolio-details-one.html"><i class="lni-link"></i></a></div>
            </div>
          </div>
          <!-- Single Portfolio Area-->
          <div class="single-portfolio-area mx-3 mt-70 mb-80"><img src="img/bg-img/p4.jpg" alt="">
              <!-- Ovarlay Content-->
            <div class="overlay-content">
              <div class="portfolio-title"><a href="portfolio-details-one.html">Portfolio Title</a></div>
              <div class="portfolio-links"><a class="image-popup" href="img/bg-img/p4.jpg" data-effect="mfp-zoom-in" title="Portfolio Title"><i class="lni-play"></i></a><a href="#"><i class="lni-heart"></i></a><a href="portfolio-details-one.html"><i class="lni-link"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Team Area-->
    <section class="saasbox-team-area section-padding-120">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-12 col-md-9 col-lg-5">
            <div class="section-heading white mb-5 mb-lg-0 mr-5">
              <h6>Our Sailors</h6>
              <h2>Creative Heads</h2>
              <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p><a class="btn saasbox-btn white-btn-2 mt-5" href="team.html">All Team Members</a>
            </div>
          </div>
          <div class="col-12 col-lg-7">
            <div class="team-members-area mt-5 mt-lg-0">
              <div class="row justify-content-center g-5">
                <div class="col-12 col-sm-6 col-md-5 col-lg-6">
                  <div class="single-team wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms"><img src="img/bg-img/t1.jpg" alt="">
                    <div class="hover-overlay">
                      <p>Jannatun,<span class="ml-1">Designer</span></p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5 col-lg-6">
                  <div class="single-team wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms"><img src="img/bg-img/t4.jpg" alt="">
                    <div class="hover-overlay">
                      <p>Naznin,<span class="ml-1">Manager</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Client Feedback Area-->
    <section class="client-feedback-area d-md-flex align-items-center justify-content-between section-padding-120">
      <!-- Client Shape-->
      <div class="client-shape"><img src="img/core-img/testimonial.png" alt=""></div>
      <!-- Client Feedback Heading-->
      <div class="client-feedback-heading">
        <div class="section-heading mb-0 text-right">
          <h6>Testimonials</h6>
          <h2 class="mb-0">Our Customers Reviews</h2>
        </div>
      </div>
      <!-- Client Feedback Content-->
      <div class="client-feedback-content">
        <div class="client-feedback-slides owl-carousel">
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>You've saved our business! Thanks guys, keep up the good work! The best on the net!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t1.png" alt=""></div>
                <div class="client-name">
                  <h6>Lim Jannat</h6>
                  <p>UX/UI Designer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>I STRONGLY recommend agency to EVERYONE interested in running a successful business!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t2.png" alt=""></div>
                <div class="client-name">
                  <h6>Pryce R.</h6>
                  <p>CEO</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>Absolutely wonderful! I wish I would have thought of it first. I would be lost without agency.</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t3.png" alt=""></div>
                <div class="client-name">
                  <h6>Cy N.</h6>
                  <p>Developer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>I STRONGLY recommend agency to EVERYONE interested in running a successful business!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t4.png" alt=""></div>
                <div class="client-name">
                  <h6>Juergen T.</h6>
                  <p>Business Owner</p>
                </div>
                  <!-- Single Feedback Slide-->
              </div>
            </div>
          </div>
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>You've saved our business! Thanks guys, keep up the good work! The best on the net!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t1.png" alt=""></div>
                <div class="client-name">
                  <h6>Lim Jannat</h6>
                  <p>UX/UI Designer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>I STRONGLY recommend agency to EVERYONE interested in running a successful business!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t2.png" alt=""></div>
                <div class="client-name">
                  <h6>Pryce R.</h6>
                  <p>CEO</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>Absolutely wonderful! I wish I would have thought of it first. I would be lost without agency.</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t3.png" alt=""></div>
                <div class="client-name">
                  <h6>Cy N.</h6>
                  <p>Developer</p>
                </div>
              </div>
            </div>
          </div>
          <!-- Single Feedback Slide-->
          <div class="card feedback-card">
            <div class="card-body"><i class="lni-quotation"></i>
              <p>I STRONGLY recommend agency to EVERYONE interested in running a successful business!</p>
              <div class="client-info d-flex align-items-center">
                <div class="client-thumb"><img src="img/bg-img/t4.png" alt=""></div>
                <div class="client-name">
                  <h6>Juergen T.</h6>
                  <p>Business Owner</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Partner Area-->
    <div class="our-partner-area section-padding-0-120">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="our-partner-slides owl-carousel">
              <div class="single-partner"><img src="img/partner-img/1.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/2.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/3.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/4.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/5.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/6.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/1.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/2.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/3.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/4.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/5.png" alt=""></div>
              <div class="single-partner"><img src="img/partner-img/6.png" alt=""></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="border-top"></div>
    </div>
    <!-- News Area-->
    <section class="saasbox-news-area section-padding-120">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-lg-7 col-xxl-6">
            <div class="section-heading text-center">
              <h6>Latest info</h6>
              <h2>Our Latest News</h2>
              <p>It's crafted with the latest trend of design & coded with all modern approaches. It's a robust & multi-dimensional usable template.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-center g-5">
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card blog-card wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms"><a href="#"><img class="card-img-top" src="img/bg-img/blog1.jpg" alt=""></a>
              <div class="post-content p-4"><a class="d-block text-muted mb-2" href="#">Sep 15, 2020</a><a class="post-title d-block mb-2" href="blog-card.html">
                  <h4>Seven ways agency can improve your business</h4></a>
                <p>It's crafted with the latest trend of design with all modern approaches.</p>
                <div class="post-meta d-flex align-items-center justify-content-between"><a class="post-author" href="#"><img src="img/bg-img/t1.png" alt=""></a><span class="text-muted">2 min read</span></div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card blog-card wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
              <div class="image-wrap"><img class="card-img-top" src="img/bg-img/blog2.jpg" alt="">
                  <!-- Video--><span class="video-content"><a class="video-play-btn" href="https://www.youtube.com/watch?v=lFGvqvPh5jI"><i class="lni-play"></i></a></span>
              </div>
              <div class="post-content p-4"><a class="d-block text-muted mb-2" href="#">Sep 21, 2020</a><a class="post-title d-block mb-2" href="blog-card.html">
                  <h4>The reason why everyone love business</h4></a>
                <p>It's crafted with the latest trend of design with all modern approaches.</p>
                <div class="post-meta d-flex align-items-center justify-content-between"><a class="post-author" href="#"><img src="img/bg-img/t2.png" alt=""></a><span class="text-muted">7 min read</span></div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card blog-card wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms"><a href="#"><img class="card-img-top" src="img/bg-img/blog3.jpg" alt=""></a>
              <div class="post-content p-4"><a class="d-block text-muted mb-2" href="#">Sep 29, 2020</a><a class="post-title d-block mb-2" href="blog-card.html">
                  <h4>Seven ways agency can improve your business</h4></a>
                <p>It's crafted with the latest trend of design with all modern approaches.</p>
                <div class="post-meta d-flex align-items-center justify-content-between"><a class="post-author" href="#"><img src="img/bg-img/t3.png" alt=""></a><span class="text-muted">4 min read</span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center mt-5"><a class="btn saasbox-btn" href="#">View All News</a></div>
        </div>
      </div>
    </section>
    <!-- Cool Facts Area-->
    <section class="cta-area bg-img bg-overlay section-padding-120 jarallax" style="background-image: url('img/bg-img/1.jpg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-8">
            <div class="cta-text text-center">
              <h2>Let's start with the simplest way to create a stunning website.</h2><a class="btn saasbox-btn white-btn" href="#">Purchase Today</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Cookie Alert Area-->
    <div class="cookiealert mb-0" role="alert">
      <p>This site uses cookies. We use cookies to ensure you get the best experience on our website. For details, please check our <a href="#" target="_blank"> Privacy Policy.</a></p>
      <button class="btn btn-primary acceptcookies" type="button" aria-label="Close">I agree</button>
    </div>
    <!-- Footer Area-->
    <footer class="footer-area section-padding-120">
      <div class="container">
        <div class="row justify-content-between">
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-10 col-lg-3">
            <div class="footer-widget-area mb-70"><a class="d-block mb-4" href="index-2.html"><img src="img/core-img/logo.png" alt=""></a>
              <p>It's crafted with the latest trend of design & coded with all modern approaches.</p>
                <!-- Newsletter Form-->
              <div class="newsletter-form">
                <form action="#">
                  <input class="form-control" type="email" placeholder="Enter email &amp; press enter">
                  <button class="btn d-none" type="submit">Go</button>
                </form>
              </div>
                <!-- Footer Social Icon-->
              <div class="footer-social-icon d-flex align-items-center"><a href="#" data-toggle="tooltip" data-placement="top" title="Facbook"><i class="fa fa-facebook"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a></div>
            </div>
          </div>
          <!-- Footer Widget Area-->
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-widget-area mb-70">
              <h5 class="widget-title">Important Links</h5>
              <ul>
                <li><a href="#" target="_blank">Terms &amp; Conditions</a></li>
                <li><a href="#" target="_blank">About Licences</a></li>
                <li><a href="#" target="_blank">Help &amp; Support</a></li>
                <li><a href="#" target="_blank">Careers</a></li>
                <li><a href="#" target="_blank">Privacy Policy</a></li>
                <li><a href="#" target="_blank">Community &amp; Forum</a></li>
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
            <!-- Copywrite Text-->
            <div class="footer--content-text">
              <p class="mb-0">All rights reserved by <a href="#" target="_blank">Designing World</a></p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-5">
            <!-- Footer Nav-->
            <div class="footer-nav">
              <ul class="d-flex">
                <li><a href="#" target="_blank">Privacy Policy</a></li>
                <li><a href="#" target="_blank">Terms &amp; Conditions</a></li>
                <li><a href="#" target="_blank">Get Support</a></li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-lg-2">
            <!-- Default dropup button-->
            <div class="language-dropdown text-center text-lg-right mt-4 mt-lg-0">
              <div class="btn-group dropup">
                <button class="btn saasbox-btn-2 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language</button>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-sa"></span>Arabic</a><a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-bd"></span>Bengali</a><a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-us"></span>English</a><a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-my"></span>Malay</a><a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-es"></span>Spanish</a></div>
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
