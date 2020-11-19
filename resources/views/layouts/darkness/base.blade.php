<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{isRtl() ? 'rtl' : 'ltr'}}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('app.name') | @yield('title')</title>

    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">

	<link rel="stylesheet" type="text/css" href="{{mix('darkness/css/main.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('darkness/css/font-awesome.css')}}">

	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    @if(isRtl())
    <link rel="stylesheet" type="text/css" href="{{mix('css/global-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('darkness/css/rtl.css')}}">
    @endif

</head>

<body class="crumina-grid">
<!-- Header -->

<header class="header header--absolute header--transparent" id="site-header">
	<div class="container">
		<div class="header-content-wrapper">
			<a href="index.html" class="site-logo">
				<img class="puzzle-icon" src="{{asset('images/logo/logo-grayscale.svg')}}" alt="logo" width="120">
			</a>

			<nav id="primary-menu" class="primary-menu">

				<!-- menu-icon-wrapper -->

				<a href='javascript:void(0)' id="menu-icon-trigger" class="menu-icon-trigger showhide">
					<span class="mob-menu--title">Menu</span>
					<span id="menu-icon-wrapper" class="menu-icon-wrapper">
						<svg width="1000px" height="1000px">
							<path id="pathD" d="M 300 400 L 700 400 C 900 400 900 750 600 850 A 400 400 0 0 1 200 200 L 800 800"></path>
							<path id="pathE" d="M 300 500 L 700 500"></path>
							<path id="pathF" d="M 700 600 L 300 600 C 100 600 100 200 400 150 A 400 380 0 1 1 200 800 L 800 200"></path>
						</svg>
					</span>
				</a>

				<ul class="primary-menu-menu">
					<li>
						<a href="/">{{__('Home')}}</a>
					</li>

                    <li class="menu-item-has-mega-menu menu-item-has-children">
                        <a href="#">
                            <span class="show indicator"><i class="puzzle-icon far fa-angle-down"></i></span>
                            @lang('global.Products')
                        </a>
                        <div class="megamenu">
                            <div class="megamenu-row">

                                <div class="col3">
                                    <ul>
                                        <li class="megamenu-item-info">
                                            <h6 class="megamenu-item-info-title">Pages</h6>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Pricing plans</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Contacts</a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="#"><i class="puzzle-icon fas fa-caret-left"></i>Send message</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Coming Soon Page</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Error 404</a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="#"><i class="puzzle-icon fas fa-caret-left"></i>Sign Up</a>
                                        </li>
                                        <li>
                                            <a target="_blank" href="#"><i class="puzzle-icon fas fa-caret-left"></i>Login</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col3">
                                    <ul>
                                        <li class="megamenu-item-info">
                                            <h6 class="megamenu-item-info-title">Classic Styles</h6>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Accordions</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Button Styles</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Forms</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Icon with Text</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="puzzle-icon fas fa-caret-left"></i>Link Styles</a>
                                        </li>
                                        <li>
                                            <a href="37_classic_tab_styles.html"><i class="puzzle-icon fas fa-caret-left"></i>Tab Styles</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col3">
                                    <ul>
                                        <li class="megamenu-item-info">
                                            <h6 class="megamenu-item-info-title">Typography</h6>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Heading Styles</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Highlights</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Blockquotes</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Columns</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Lists</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="puzzle-icon fas fa-caret-left"></i>Icons</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </li>


					<li class="menu-item-has-children">
						<a href="#">
							<span class="show indicator"><i class="puzzle-icon far fa-angle-down"></i></span>
                            @lang('global.Developers')
						</a>
						<ul class="sub-menu">

							<li>
								<a href="{{url('plugins')}}">@lang('global.Plugins')</a>
							</li>

							<li>
								<a href="{{url('documentations')}}">@lang('global.MerchantAPIDoc')</a>
							</li>

							<li>
								<a href="https://github.com/asanpay">Github</a>
							</li>

						</ul>
					</li>


                    <li class=""><a href="#">@lang('global.Fees')</a></li>
                    <li class=""><a href="{{url('blog')}}">@lang('global.Blog')</a></li>
                    <li class=""><a href="#">@lang('global.ContactUs')</a></li>
				</ul>

			</nav>

			<nav class="login-menu">
				<ul>
					<li>
						<a href="#" data-toggle="modal" data-target="#signupModal">@lang('global.SignUp')</a>
					</li>
					<li>
						<button type="button" class="crumina-button button--primary button--s button--hover-primary"
                                data-toggle="modal" data-target="#loginModal">@lang('site.Login')</button>
					</li>
				</ul>
			</nav>

			<select class="puzzle--select language-switcher" data-minimum-results-for-search="Infinity" data-dropdown-css-class="language-switcher-dropdown">
				<option value="Fa" data-href="">Fa</option>
				<option value="En" data-href="">En</option>
			</select>

		</div>
	</div>
</header>

<!-- ... end Header -->

<div class="main-content-wrapper" id="app">

@yield('content')

</div>

<!-- Footer -->

<footer id="site-footer" class="footer bg-dark-themes">

	<div class="footer-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4 mb-lg-0">
					<div class="widget w-info">
						<a href="index.html" class="site-logo">
							<img class="puzzle-icon" src="{{asset('images/logo/logo-grayscale.svg')}}" alt="logo" width="120">
						</a>
						<p>@lang('app.footer_note')</p>

						<div class="contact-item">
							<svg class="puzzle-icon" width="11" height="16">
								<path fill="" fill-rule="evenodd" d="M5.5 13.089c-.756 0-1.375.654-1.375 1.454 0 .801.619 1.455 1.375 1.455s1.375-.654 1.375-1.455c0-.8-.619-1.454-1.375-1.454zM1.375-.003C.619-.003 0 .653 0 1.452c0 .801.619 1.455 1.375 1.455S2.75 2.253 2.75 1.452c0-.799-.619-1.455-1.375-1.455zm0 4.364C.619 4.361 0 5.016 0 5.816 0 6.617.619 7.27 1.375 7.27S2.75 6.617 2.75 5.816c0-.8-.619-1.455-1.375-1.455zm0 4.364C.619 8.725 0 9.379 0 10.18c0 .8.619 1.455 1.375 1.455S2.75 10.98 2.75 10.18c0-.801-.619-1.455-1.375-1.455zm8.25-5.818c.756 0 1.375-.654 1.375-1.455 0-.799-.619-1.455-1.375-1.455S8.25.653 8.25 1.452c0 .801.619 1.455 1.375 1.455zM5.5 8.725c-.756 0-1.375.654-1.375 1.455 0 .8.619 1.455 1.375 1.455s1.375-.655 1.375-1.455c0-.801-.619-1.455-1.375-1.455zm4.125 0c-.756 0-1.375.654-1.375 1.455 0 .8.619 1.455 1.375 1.455S11 10.98 11 10.18c0-.801-.619-1.455-1.375-1.455zm0-4.364c-.756 0-1.375.655-1.375 1.455 0 .801.619 1.454 1.375 1.454S11 6.617 11 5.816c0-.8-.619-1.455-1.375-1.455zm-4.125 0c-.756 0-1.375.655-1.375 1.455 0 .801.619 1.454 1.375 1.454s1.375-.653 1.375-1.454c0-.8-.619-1.455-1.375-1.455zm0-4.364c-.756 0-1.375.656-1.375 1.455 0 .801.619 1.455 1.375 1.455s1.375-.654 1.375-1.455c0-.799-.619-1.455-1.375-1.455z" />
							</svg>
							<a class="ltr" href="#">+98 (21) 9912345</a>
						</div>

						<div class="contact-item">
							<i class="puzzle-icon far fa-at"></i>
							<a class="ltr" href="mailto:contact@asanpay.com">contact@asanpay.com</a>
						</div>

					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mb-4 mb-lg-0">
					<div class="widget widget_links">
						<h5 class="widget-title">
							@lang('site.UsefulLinks')
						</h5>

						<ul>
							<li>
								<a href="{{url('tracking')}}">@lang('global.TrackTransaction')</a>
							</li>

							<li>
								<a href="{{url('terms')}}">{{__('Terms and Conditions')}}</a>
							</li>

							<li>
								<a href="{{url('privacy')}}">{{__('Privacy')}}</a>
							</li>

							<li>
								<a href="{{url('help-center')}}">{{__('Help Center')}}</a>
							</li>

							<li>
								<a href="{{url('contact-us')}}">{{__('Contact Us')}}</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mb-4 mb-lg-0">
					<div class="widget widget_links">
						<h5 class="widget-title">
							@lang('site.Sponsors')
						</h5>

						<ul>
							<li>
								<a href="https://shaparak.ir">@lang('global.Shaparak')</a>
							</li>

							<li>
								<a href="https://asanpardakht.ir">@lang('global.AsanPardakht')</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-0 mb-lg-0">
					<div class="widget w-contacts">
						<h5 class="widget-title">
							Sign Up for Weekly Newsletter
						</h5>
						<p>Subscribe to our newsletter and always be aware of all the latest updates.</p>

						<div class="input--border-bottom">
							<input name="mail" placeholder="Email Address" type="email">
							<i class="puzzle-icon far fa-envelope"></i>
						</div>

						<ul class="socials ltr">
							<li>
								<a href="{{env('SOCIAL_FACEBOOK_URL', '#')}}">
									<i class="puzzle-icon fab fa-facebook-square"></i>
								</a>
							</li>
							<li>
								<a href="{{env('SOCIAL_TWITTER_URL', '#')}}">
									<i class="puzzle-icon fab fa-twitter"></i>
								</a>
							</li>
							<li>
								<a href="{{env('SOCIAL_LINKEDIN_URL', '#')}}">
									<i class="puzzle-icon fab fa-linkedin-in"></i>
								</a>
							</li>
							<li>
								<a href="{{env('SOCIAL_INSTAGRAM_URL', '#')}}">
									<i class="puzzle-icon fas fa-instagram"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="sub-footer">
		<div class="container">
			<div class="row align-items-center">

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center text-lg-right">
					<div class="copyright">
						@lang('app.copyright')
					</div>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center text-lg-left mb-4 mb-lg-0">
                    آسان پی ● ۱۳۹۹ - ۱۳۹۰
				</div>

			</div>
		</div>
	</div>

	<a class="back-to-top" href="#">
		<svg class="puzzle-icon" width="24" height="28">
			<path fill="" fill-rule="evenodd" d="M23.027 1.966H.973A.98.98 0 0 1 0 .983C0 .44.432 0 .973 0h22.054A.98.98 0 0 1 24 .983a.983.983 0 0 1-.973.983zM11.306 6.105a.975.975 0 0 1 1.382 0l6.083 6.111a.988.988 0 0 1 0 1.39.974.974 0 0 1-1.377 0l-4.415-4.437v17.853A.98.98 0 0 1 12 28a.975.975 0 0 1-.973-.978V9.169l-4.415 4.437a.976.976 0 0 1-1.383 0 .988.988 0 0 1 0-1.39l6.077-6.111z" />
		</svg>
		{{__('Go to top')}}
	</a>
</footer>

<!-- ... end Footer -->


<div class="modal fade window-popup" id="loginModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-login">
					<h2>My Account</h2>
					<div class="mb-4">For fast login use your social account.</div>
					<button type="button" class="crumina-button button--blue-dark button--l button--with-icon button--icon-left w-100 mb-2">
						<i class="puzzle-icon fab fa-facebook-square"></i>Login with the Facebook
					</button>
					<button type="button" class="crumina-button button--blue button--l button--with-icon button--icon-left w-100 mb-4">
						<i class="puzzle-icon fab fa-twitter"></i>Login with the Twitter
					</button>
					<label for="name">Username or Email Address *</label>
					<input id="name" name="name" placeholder="" type="text">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<label class="mb-0" for="password">Password *</label>
						<a href="#">Lost your password?</a>
					</div>
					<input id="password" name="password" placeholder="" type="password">
					<div class="checkbox checkbox--transparent mt-2 mb-4">
						<label>
							<input type="checkbox" name="optionsCheckboxes4">
							<span class="checkbox-material"><span class="check"></span></span>
							Remember Me
						</label>
					</div>
					<button type="button" class="crumina-button button--green button--l w-100">Log In</button>
				</form>
			</div>
		</div>
	</div>
</div>

@include('partials.darkness.signup-modal')
<!-- jQuery first, then Other JS. -->

<!-- FontAwesome 5.x.x JS -->

<script defer src="{{mix('js/app.js')}}"></script>
<script defer src="{{mix('darkness/js/main.min.js')}}"></script>
<script defer src="{{mix('darkness/fonts/fontawesome-all.js')}}"></script>

</body>

</html>
