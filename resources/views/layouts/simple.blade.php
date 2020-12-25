<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{isRtl() ? 'rtl' : 'ltr'}}">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@lang('app.name') | @yield('title')</title>

		<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
		<link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/simple.css')}}">
        @stack('css')
        @if(isRtl())
            <link href="{{mix('css/global-rtl.css')}}" rel="stylesheet" type="text/css" />
        @endif
	</head>

	<body class="lang-{{app()->getLocale()}} simple-page">
        <div id="app">
			<div>
				<div class="bUGfWD">
					<div class="hPKwDv">
						<div class="hBJwoB">
							<div class="iSOsrm dqkfnO"></div>
							<div class="cEmDkZ">
								<div>
									<header class="sc-jAaTju jZPEGD">
										<div class="bqVmWV">
                                            <span class="aQXGv" role="presentation">
                                                <a href="{{url('/')}}" alt="@lang('app.name')">
                                                    <img style="width: 190px" src="{{asset('img/logo/logo.svg')}}" />
                                                </a>
                                           </span>
                                        </div>
									</header>

									<section class="lbaSgD" role="main">
										@yield('content')
									</section>
									<div class="hqyKhj">
                                        <a id="security-reset-password-continue" href="{{config('app.url')}}/login">
                                            <span>{{__('auth.back_to_site')}}</span>
                                        </a>
                                    </div>
								</div>

								<footer class="liGdGQ">
									<div class="bqVmWV">
                                        <span class="jOoCmA" role="presentation">
                                            <a href="{{url('/')}}" alt="@lang('app.name')">
                                                <img style="width: 190px" src="{{asset('img/logo/logo-grayscale.svg')}}" />
                                            </a>
                                        </span>
                                    </div>
                                    <span id="footer_copyright">
                                        {!! __('app.copyright') !!}
                                    </span>
                                </footer>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    	<script src="{{asset('js/app.js')}}"></script>
        @stack('js')
	</body>

</html>
