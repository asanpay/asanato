@extends('layouts.darkness.base')
@section('content')

    @include('partials.darkness.homepage-slider')


    <section class="medium-padding120 bg-light-grey">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4 mb-lg-0">
					<header class="crumina-module crumina-heading heading--h2 heading--with-decoration heading--inline decoration--yellow-theme mb-0">
						<h2 class="heading-title">@lang('site.OnlinePaySol')</h2>
						<div class="heading-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
					</header>
				</div>
			</div>
		</div>
	</section>


    <section class="medium-padding120 bg-light-grey">
		<div class="container">
			<div class="row mb60">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<header class="crumina-module crumina-heading heading--h2 heading--with-decoration decoration--yellow-theme heading--inline mb-0">
						<h2 class="heading-title">@lang('site.OnlinePaySol')</h2>
						<div class="heading-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
					</header>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
					<div class="crumina-module crumina-info-box info-box--border-top h-100">

						<div class="info-box-thumb">
							<a href="#" class="h4 info-box-title" data-toggle="modal" data-target="#signupModal">@lang('global.IPG')</a>
							<svg class="puzzle-icon" width="100" height="100">
								<path fill="" fill-rule="evenodd" d="M98.946 18.219L63.32 32.785v65.549c0 .92-.746 1.666-1.666 1.666h-6.666c-.92 0-1.666-.746-1.666-1.666V61.668H41.658a8.195 8.195 0 0 1-4.999-1.667v38.333c0 .92-.746 1.666-1.666 1.666H11.664c-.92 0-1.666-.746-1.666-1.666V65.001H1.666c-.92 0-1.666-.746-1.666-1.667V40.002c0-6.443 5.222-11.667 11.664-11.667h2.883c-.443-.388-.86-.805-1.248-1.248-4.85-5.54-4.291-13.964 1.248-18.814 5.539-4.851 13.961-4.292 18.81 1.248 4.85 5.54 4.292 13.964-1.247 18.814h2.882c6.442 0 11.665 5.224 11.665 11.667v8.333h6.665V1.669c0-.92.746-1.666 1.666-1.666h6.665a1.64 1.64 0 0 1 .634.117l36.659 14.999a1.667 1.667 0 0 1 0 3.1zm-65.62.116c0-5.522-4.476-9.999-9.998-9.999-5.521 0-9.998 4.477-9.998 9.999 0 5.523 4.477 10 9.998 10 5.522 0 9.998-4.477 9.998-10zM20.729 31.669l2.599 6.916 2.6-6.916h-5.199zm32.593 19.999h-8.331a1.667 1.667 0 0 1-1.667-1.667v-9.999a8.332 8.332 0 0 0-8.331-8.333h-5.516l-4.582 12.249a1.667 1.667 0 0 1-3.133 0L17.18 31.669h-5.516a8.332 8.332 0 0 0-8.331 8.333v21.666h6.665V40.002h3.332v56.665h8.332V61.668h3.333v34.999h8.331V40.002h3.333v13.333a4.999 4.999 0 0 0 4.999 4.999h11.664v-6.666zm6.665-48.332h-3.332v93.331h3.332V3.336zm3.333.85v24.999l30.594-12.516L63.32 4.186zM21.662 48.335h3.333v3.333h-3.333v-3.333z"/>
							</svg>
							<p class="info-box-text">@lang('site.IPGDesc')</p>
						</div>

						<div class="info-box-content">
							<a href="#" class="link--bold link--with-icon link--icon-right">@lang('global.KnowMore')<i class="puzzle-icon far fa-angle-right"></i></a>
						</div>

					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4 mb-md-0">
					<div class="crumina-module crumina-info-box info-box--border-top h-100">

						<div class="info-box-thumb">
							<a href="#" class="h4 info-box-title">@lang('global.AsanLink')</a>
							<svg class="puzzle-icon" width="100" height="100">
								<path fill="" fill-rule="evenodd" d="M100 58.929v5.357h-3.571V59.35l-1.599-3.193a1.79 1.79 0 0 1 0-1.598l1.599-3.195V37.5a1.79 1.79 0 0 0-1.786-1.786h-1.786v58.929c0 .473-.187.928-.523 1.263l-3.572 3.571a1.78 1.78 0 0 1-2.524 0l-3.572-3.571a1.783 1.783 0 0 1-.523-1.263V30.357c0-.986.8-1.785 1.786-1.785h7.142c.986 0 1.786.799 1.786 1.785v1.786h1.786A5.364 5.364 0 0 1 100 37.5v14.286c0 .277-.064.55-.189.798l-1.386 2.773 1.387 2.773c.124.247.188.522.188.799zM89.286 32.143h-3.572v28.571h3.572V32.143zm0 32.143h-3.572v29.618l1.786 1.785 1.786-1.785V64.286zM67.693 92.693c-.766 4.15-4.397 7.307-8.764 7.307h-50C4.005 100 0 95.994 0 91.072V16.071c0-4.368 3.157-7.998 7.307-8.764C8.073 3.157 11.703 0 16.071 0h50C70.995 0 75 4.005 75 8.929v75c0 4.367-3.157 7.998-7.307 8.764zM8.929 10.714a5.364 5.364 0 0 0-5.358 5.357v75.001a5.364 5.364 0 0 0 5.358 5.357h50a5.364 5.364 0 0 0 5.357-5.357V16.071a5.364 5.364 0 0 0-5.357-5.357h-50zm62.5-1.785a5.365 5.365 0 0 0-5.358-5.358h-50c-2.325 0-4.289 1.499-5.028 3.572h47.886c4.923 0 8.928 4.005 8.928 8.928v72.886c2.073-.739 3.572-2.703 3.572-5.028v-75zM42.857 82.143h14.286v3.571H42.857v-3.571zm-25-10.715h39.286V75H17.857v-3.572zm0-7.142h39.286v3.571H17.857v-3.571zm0-7.143h39.286v3.571H17.857v-3.571zm0-7.143h39.286v3.571H17.857V50zm-7.143-7.143h46.429v3.571H10.714v-3.571zm0-7.143h46.429v3.571H10.714v-3.571zm23.215-3.571c-4.924 0-8.929-4.005-8.929-8.929 0-4.923 4.005-8.928 8.929-8.928 4.923 0 8.928 4.005 8.928 8.928 0 4.924-4.005 8.929-8.928 8.929zm0-14.286a5.364 5.364 0 0 0-5.358 5.357 5.365 5.365 0 0 0 5.358 5.358 5.364 5.364 0 0 0 5.357-5.358 5.364 5.364 0 0 0-5.357-5.357zM14.286 53.571h-3.572V50h3.572v3.571zm0 7.143h-3.572v-3.571h3.572v3.571zm0 7.143h-3.572v-3.571h3.572v3.571zm0 7.143h-3.572v-3.572h3.572V75zM25 85.714H10.714v-3.571H25v3.571z"/>
							</svg>
							<p class="info-box-text">@lang('site.AsanLinkDesc')</p>
						</div>

						<div class="info-box-content">
							<a href="#" class="link--bold link--with-icon link--icon-right">@lang('global.KnowMore')<i class="puzzle-icon far fa-angle-right"></i></a>
						</div>

					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-0">
					<div class="crumina-module crumina-info-box info-box--border-top h-100">

						<div class="info-box-thumb">
							<a href="#" class="h4 info-box-title">@lang('global.Multiplex')</a>
							<svg class="puzzle-icon" width="100" height="100">
								<path fill="" fill-rule="evenodd" d="M74.389 61.761l23.308-23.313L100 40.752l-24.075 24.08a6.476 6.476 0 0 1-1.788 5.837L56.616 88.193a6.463 6.463 0 0 1-4.606 1.909 6.464 6.464 0 0 1-4.608-1.909l-.124-.124a5.06 5.06 0 0 1-1.982.404c-2.742 0-4.97-2.186-5.066-4.905a5.07 5.07 0 0 1-4.886-4.887 5.072 5.072 0 0 1-4.887-4.888c-2.718-.096-4.904-2.323-4.904-5.066a5.03 5.03 0 0 1 1.007-3.009l-7.045-7.046a1.626 1.626 0 0 1-.477-1.152v-4.171L.02 35.915l2.202-2.403 11.597 10.633 20.832-20.836-15.136-15.14 2.303-2.303 22.803 22.807 2.781 2.781h5.841c.431 0 .847.171 1.151.478l2.106 2.106 29.794-29.8 2.303 2.304L57.65 37.495l-.003.005L45.81 49.246c2.986 1.875 6.998 1.517 9.589-1.074l4.836-4.837 2.303 2.304-2.106 2.107 13.705 13.707c.094.096.164.208.252.308zM45.296 85.215a1.82 1.82 0 0 0 1.291-.534l7.75-7.752a1.829 1.829 0 0 0-2.583-2.584l-7.75 7.752a1.829 1.829 0 0 0 1.292 3.118zm-4.887-4.887c.489 0 .947-.191 1.292-.535l7.75-7.751a1.828 1.828 0 0 0-2.584-2.584l-7.749 7.751a1.83 1.83 0 0 0 1.291 3.119zm-4.886-4.888c.489 0 .946-.19 1.292-.534l7.749-7.751a1.829 1.829 0 0 0-2.583-2.584l-7.75 7.751a1.828 1.828 0 0 0 1.292 3.118zm-4.886-4.887a1.82 1.82 0 0 0 1.291-.534l7.75-7.752a1.829 1.829 0 0 0-2.583-2.584l-7.75 7.752a1.829 1.829 0 0 0 1.292 3.118zm6.318-44.941L16.223 46.349l4.395 4.029 20.549-20.553-4.212-4.213zm34.879 38.144L58.129 50.049l-.427.425c-4.249 4.254-11.195 4.28-15.477.061a1.636 1.636 0 0 1-.005-2.317l11.972-11.881-1.624-1.624h-5.841c-.431 0-.847-.172-1.151-.478l-2.106-2.106-21.175 21.178v3.539l6.516 6.516 5.981-5.982a5.047 5.047 0 0 1 3.594-1.489c2.742 0 4.97 2.186 5.066 4.905a5.07 5.07 0 0 1 4.886 4.888 5.07 5.07 0 0 1 4.887 4.887c2.718.096 4.904 2.323 4.904 5.066a5.058 5.058 0 0 1-1.487 3.596l-6.781 6.782c1.248 1.091 3.268 1.059 4.452-.125l17.521-17.525a3.236 3.236 0 0 0 .954-2.303c0-.872-.339-1.69-.954-2.306zM70.028 7.312l1.487-3.032a49.466 49.466 0 0 1 3.079 1.655l-1.702 2.917a44.459 44.459 0 0 0-2.864-1.54zm-6.009-2.345l.946-3.241c1.118.328 2.238.709 3.333 1.138l-1.23 3.143a36.758 36.758 0 0 0-3.049-1.04zm-6.333-1.269l.392-3.352c1.181.138 2.348.32 3.466.543l-.658 3.312a40.654 40.654 0 0 0-3.2-.503zm-5.858-.323l-.656.006-.049-3.376.705-.005c.947 0 1.869.022 2.772.064l-.159 3.372a55.614 55.614 0 0 0-2.613-.061zM44.165.597c1.142-.181 2.31-.32 3.469-.42l.286 3.364a44.32 44.32 0 0 0-3.229.392L44.165.597zM37.36 2.175a48.734 48.734 0 0 1 3.374-.911l.762 3.288c-1.054.245-2.111.53-3.139.849l-.997-3.226zm-6.508 2.536a48.426 48.426 0 0 1 3.207-1.386l1.228 3.145a46.733 46.733 0 0 0-2.989 1.291l-1.446-3.05zM12.523 36.342a4.894 4.894 0 0 1-4.887-4.888 4.893 4.893 0 0 1 4.887-4.887 4.893 4.893 0 0 1 4.886 4.887 4.893 4.893 0 0 1-4.886 4.888zm0-6.517c-.898 0-1.629.732-1.629 1.629 0 .898.731 1.629 1.629 1.629a1.63 1.63 0 0 0 1.628-1.629c0-.897-.731-1.629-1.628-1.629zM3.56 46.682A46.704 46.704 0 0 0 3.442 50l-3.447.005V50c0-1.192.041-2.39.126-3.563l3.439.245zm.351 9.954l-3.413.486a49.785 49.785 0 0 1-.377-3.548l3.439-.245c.077 1.1.196 2.212.351 3.307zm1.407 6.49l-3.308.968a50.005 50.005 0 0 1-.881-3.458l3.368-.733c.236 1.081.512 2.165.821 3.223zm2.318 6.217l-3.135 1.432a50.173 50.173 0 0 1-1.366-3.293l3.231-1.207a47.171 47.171 0 0 0 1.27 3.068zm3.188 5.822l-2.9 1.866A50.638 50.638 0 0 1 6.1 73.963l3.026-1.655a45.676 45.676 0 0 0 1.698 2.857zm3.978 5.312l-2.604 2.26a50.775 50.775 0 0 1-2.24-2.777l2.758-2.069a49.788 49.788 0 0 0 2.086 2.586zm4.699 4.7l-2.26 2.605a49.984 49.984 0 0 1-2.611-2.434l2.439-2.436a47.316 47.316 0 0 0 2.432 2.265zm5.316 3.988l-1.865 2.9a50.106 50.106 0 0 1-2.932-2.039l2.07-2.759c.881.662 1.8 1.3 2.727 1.898zm5.834 3.193l-1.436 3.134a50.327 50.327 0 0 1-3.193-1.601l1.655-3.024a48.536 48.536 0 0 0 2.974 1.491zm6.221 2.321l-.969 3.308a48.736 48.736 0 0 1-3.389-1.127l1.209-3.229c1.027.384 2.085.736 3.149 1.048zm6.49 1.407l-.486 3.412a49.225 49.225 0 0 1-3.513-.63l.729-3.368c1.074.23 2.174.429 3.27.586zm6.623.465l.002 3.448c-1.188 0-2.388-.041-3.563-.124l.243-3.439a47.46 47.46 0 0 0 3.318.115zm7.118 2.945a50.375 50.375 0 0 1-3.548.378l-.245-3.44a46.88 46.88 0 0 0 3.306-.352l.487 3.414zm6.971-1.51a50.73 50.73 0 0 1-3.458.881l-.733-3.369a47.774 47.774 0 0 0 3.222-.821l.969 3.309zm6.679-2.494a49.075 49.075 0 0 1-3.292 1.366l-1.205-3.231a46.237 46.237 0 0 0 3.065-1.271l1.432 3.136zm6.254-3.42a49.752 49.752 0 0 1-3.065 1.822l-1.654-3.026c.97-.531 1.93-1.101 2.854-1.696l1.865 2.9zm5.706-4.276a50.502 50.502 0 0 1-2.777 2.24l-2.069-2.759a47.197 47.197 0 0 0 2.588-2.088l2.258 2.607zm5.046-5.046a50.013 50.013 0 0 1-2.434 2.611l-2.436-2.439a45.679 45.679 0 0 0 2.265-2.433l2.605 2.261zm1.384-7.576l2.899 1.867a49.27 49.27 0 0 1-2.041 2.933l-2.758-2.071c.66-.881 1.3-1.798 1.9-2.729zm3.191-5.833l3.133 1.436a50.327 50.327 0 0 1-1.601 3.193l-3.025-1.655a47.445 47.445 0 0 0 1.493-2.974zm2.322-6.224l3.308.969a49.097 49.097 0 0 1-1.128 3.389l-3.228-1.207c.384-1.03.736-2.091 1.048-3.151zm1.404-6.49l3.412.486a49.249 49.249 0 0 1-.629 3.514l-3.37-.729c.232-1.074.431-2.174.587-3.271zM96.528 50h3.447c0 1.188-.041 2.387-.124 3.565l-3.439-.243c.078-1.095.116-2.214.116-3.322z"/>
							</svg>
							<p class="info-box-text">@lang('site.MultiplexDesc')</p>
						</div>

						<div class="info-box-content">
							<a href="#" class="link--bold link--with-icon link--icon-right">@lang('global.KnowMore')<i class="puzzle-icon far fa-angle-right"></i></a>
						</div>

					</div>
				</div>
			</div>

		</div>
	</section>


    <section>
        <div class="tabs tabs--primary negative-margin-top-63">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">

                            <li role="presentation" class="nav-item active">
                                <a class="nav-link active h6 tabs-scroll" id="find-tab"
                                   data-toggle="tab" href="#find" role="tab" aria-controls="home"
                                   aria-selected="true">Find a Job</a>
                            </li>

                            <li role="presentation" class="nav-item">
                                <a class="nav-link h6 tabs-scroll" id="candidate-tab"
                                   data-toggle="tab" href="#candidate" role="tab"
                                   aria-controls="profile" aria-selected="false">Find a Candidate</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-pane active" id="find" role="tabpanel"
                                 aria-labelledby="find-tab">
                                <form class="form--search">

                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <input name="name" placeholder="Keywords" type="text">
                                            <div class="c-grey fs-14">* Search keywords e.g. web design</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select1" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Specialisms">All Specialisms</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                            <div class="c-grey fs-14">* Filter by specialisms e.g. developer</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select2" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Locations">All Locations</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <button type="button" class="crumina-button button--dark
                                                button--xl">Search</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="tab-pane" id="candidate" role="tabpanel"
                                 aria-labelledby="candidate-tab">
                                <form class="form--search">

                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <input name="name" placeholder="Keywords" type="text">
                                            <div class="c-grey fs-14">* Search keywords e.g. web design</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select3" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Specialisms">All Specialisms</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                            <div class="c-grey fs-14">* Filter by specialisms e.g. developer</div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <select id="select4" class="puzzle--select"
                                                    data-minimum-results-for-search="Infinity">
                                                <option data-display="All Locations">All Locations</option>
                                                <option value="1">Freelance</option>
                                                <option value="2">Full Time</option>
                                                <option value="3">Intership</option>
                                                <option value="4">Part Time</option>
                                                <option value="5">Temporary</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-6 col-xs-12 mb-3 mb-md-0">
                                            <button type="button" class="crumina-button button--dark
                                                button--xl">Search</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="medium-padding120">
        <div class="container">
            <div class="row mb60">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <header class="crumina-module crumina-heading heading--h2
                        heading--with-decoration heading--inline mb-0">
                        <h2 class="heading-title">Brows Jobs by Specialism</h2>
                        <div class="heading-text">Lorem ipsum dolor sit amet, consectetur
                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore.</div>
                    </header>
                </div>
            </div>

            <div class="row sorting-container mb20" data-layout="fitRows"
                 id="category-grid">
                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                    <div class="crumina-module crumina-info-box info-box--squared">

                        <div class="info-box-thumb">
                            <svg class="puzzle-icon" width="60" height="60">
                                <path fill="" fill-rule="evenodd" d="M58.064
                                    60H0v-1.935h1.936v-38.71h15.483V0h25.162v19.355h15.483v38.71H60V60h-1.936zM17.419
                                    21.29H3.871v36.775h13.548V21.29zm13.549
                                    36.775h4.839V43.548h-4.839v14.517zm-6.775
                                    0h4.839V43.548h-4.839v14.517zm16.452-38.71V1.935h-21.29v56.13h2.903V43.548h-.968v-1.935H38.71v1.935h-.968v14.517h2.903v-38.71zm15.484
                                    1.935H42.581v36.775h13.548V21.29zm-2.903
                                    7.742h-7.742v-5.806h7.742v5.806zm-1.936-3.871h-3.87v1.936h3.87v-1.936zm1.936
                                    11.614h-7.742v-5.807h7.742v5.807zm-1.936-3.872h-3.87v1.936h3.87v-1.936zm1.936
                                    11.613h-7.742V38.71h7.742v5.806zm-1.936-3.871h-3.87v1.935h3.87v-1.935zm1.936
                                    11.613h-7.742v-5.806h7.742v5.806zm-1.936-3.871h-3.87v1.936h3.87v-1.936zM30.968
                                    30.968h7.742v5.807h-7.742v-5.807zm1.935
                                    3.871h3.871v-1.936h-3.871v1.936zm-1.935-11.613h7.742v5.806h-7.742v-5.806zm1.935
                                    3.871h3.871v-1.936h-3.871v1.936zm0-5.807h-5.806v-5.806H21.29V9.677h5.807V3.871h5.806v5.806h5.807v5.807h-5.807v5.806zm3.871-7.742v-1.935h-5.806V5.807h-1.936v5.806h-5.806v1.935h5.806v5.807h1.936v-5.807h5.806zm-7.742
                                    15.484H21.29v-5.806h7.742v5.806zm-1.935-3.871h-3.871v1.936h3.871v-1.936zm1.935
                                    11.614H21.29v-5.807h7.742v5.807zm-1.935-3.872h-3.871v1.936h3.871v-1.936zm-12.581-3.871H6.774v-5.806h7.742v5.806zm-1.935-3.871H8.71v1.936h3.871v-1.936zm1.935
                                    11.614H6.774v-5.807h7.742v5.807zm-1.935-3.872H8.71v1.936h3.871v-1.936zm1.935
                                    11.613H6.774V38.71h7.742v5.806zm-1.935-3.871H8.71v1.935h3.871v-1.935zm1.935
                                    11.613H6.774v-5.806h7.742v5.806zm-1.935-3.871H8.71v1.936h3.871v-1.936z"
                                />
                                </svg>
                                <a href="03_job_lists_row_map.html" class="h5 info-box-title">Healthcare</a>
                            </div>

                            <div class="info-box-content">
                                <a href="#" class="info-box-link">369 open positions</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                        <div class="crumina-module crumina-info-box info-box--squared">

                            <div class="info-box-thumb">
                                <svg class="puzzle-icon" width="60" height="60">
                                    <path fill="" fill-rule="evenodd" d="M32.903
                                        46.452V60H0V15.484h21.29V0h30.401L60
                                        8.309v38.143H32.903zm0-15.484h7.742v-1.936h-7.742v1.936zm0-3.871h7.742v-1.936h-7.742v1.936zm0-7.742h1.936v1.935h-1.936v1.936h7.742V21.29h-3.871v-1.935h3.871v-1.936h-7.742v1.936zM1.936
                                        17.419v40.646h29.032V17.419H1.936zM52.258
                                        3.304v4.438h4.438l-4.438-4.438zm5.806
                                        6.373h-7.741V1.935H23.226v13.549h17.419v-3.871h15.484v25.162H40.645v-3.872h-7.742v11.613h25.161V9.677zM42.581
                                        32.903v1.936h11.612v-1.936h-1.935v-1.935h1.935v-1.936H42.581v1.936h7.742v1.935h-7.742zm11.612-5.806v-1.936H42.581v1.936h11.612zm0-3.871V21.29H42.581v1.936h11.612zm0-3.871v-1.936H42.581v1.936h11.612zm0-3.871v-1.936H42.581v1.936h11.612zM3.871
                                        30.968h25.161v25.161H3.871V30.968zm13.548
                                        23.226h9.678v-9.678h-9.678v9.678zm0-11.614h9.678v-9.677h-9.678v9.677zM5.807
                                        54.194h9.677v-9.678H5.807v9.678zm0-11.614h9.677v-9.677H5.807v9.677zm5.806-1.935H9.677V38.71H7.742v-1.935h1.935v-1.936h1.936v1.936h1.935v1.935h-1.935v1.935zm1.251
                                        12.297l-2.219-2.219-2.219 2.219-1.368-1.368 2.219-2.219-2.219-2.219
                                        1.368-1.369 2.219 2.22 2.219-2.22 1.369 1.369-2.219 2.219 2.219
                                        2.219-1.369 1.368zm6.491-16.167h5.806v1.935h-5.806v-1.935zm0
                                        13.548h5.806v1.935h-5.806v-1.935zm0-3.871h5.806v1.935h-5.806v-1.935zM3.871
                                        19.355h25.161v9.677H3.871v-9.677zm1.936
                                        7.742h21.29V21.29H5.807v5.807z" />
                                    </svg>
                                    <a href="03_job_lists_row_map.html" class="h5 info-box-title">Accounting
                                        & Finance</a>
                                </div>

                                <div class="info-box-content">
                                    <a href="#" class="info-box-link">309 open positions</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                            <div class="crumina-module crumina-info-box info-box--squared">

                                <div class="info-box-thumb">
                                    <svg class="puzzle-icon" width="60" height="60">
                                        <path fill="" fill-rule="evenodd" d="M58.071
                                            59.999V46.451h1.93v13.548h-1.93zm0-17.419h1.93v1.936h-1.93V42.58zm-1.498-20.908l1.218
                                            2.441-4.623 4.637-2.436-1.221c-.649.334-1.333.616-2.039.844l-.863
                                            2.594h-3.268v-1.935h1.878l.744-2.233.493-.138a11.538 11.538 0 0 0
                                            2.566-1.064l.447-.252 2.097 1.051
                                            2.655-2.663-1.049-2.104.253-.448a11.53 11.53 0 0 0
                                            1.058-2.573l.138-.497 2.229-.744V13.6l-2.229-.744-.138-.496a11.557
                                            11.557 0 0 0-1.058-2.574l1.68-.95c.444.788.808 1.627 1.088
                                            2.505l2.587.865v6.556l-2.587.864c-.226.71-.507 1.394-.841
                                            2.046zM52.786 4.573l-2.097 1.052-.447-.253a11.586 11.586 0 0
                                            0-2.566-1.064l-.493-.138-.743-2.236h-1.878V0h3.268l.862
                                            2.596c.706.227 1.39.51 2.039.843l2.436-1.221 4.13 4.143-1.364
                                            1.369-3.147-3.157zm-8.224 1.233c5.321 0 9.65 4.341 9.65 9.677 0
                                            5.336-4.329 9.678-9.65 9.678v-1.935c4.257 0 7.72-3.474
                                            7.72-7.743s-3.463-7.741-7.72-7.741V5.806zm0 5.806V9.677c3.193 0
                                            5.79 2.604 5.79 5.806s-2.597 5.807-5.79 5.807v-1.936a3.87 3.87 0 0
                                            0 3.86-3.871 3.87 3.87 0 0 0-3.86-3.871zm5.79
                                            18.387h1.93v1.936h-1.93v-1.936zm1.93
                                            12.581h-1.93v-8.709h1.93v8.709zm-1.954 4.62l2.127 12.799H0L2.128
                                            47.2a10.611 10.611 0 0 1
                                            7.113-8.348l8.303-2.775v-1.239h1.93v1.816l1.439 5.778
                                            3.898-4.691h2.834l3.897 4.691 1.441-5.778v-1.816h1.93v1.239l8.302
                                            2.775a10.608 10.608 0 0 1 7.113
                                            8.348zm-7.724-6.513l-7.973-2.665-2.138
                                            8.577-5.752-6.922h-1.026l-5.751 6.922-2.139-8.577-7.973 2.665a8.685
                                            8.685 0 0 0-5.82 6.831L2.279 58.064h6.672l.878-8.807 1.92.193-.859
                                            8.613h30.676l-.859-8.613 1.92-.193.879
                                            8.807h6.671l-1.752-10.546a8.69 8.69 0 0
                                            0-5.821-6.831zm-2.867-14.558h-1.441c-.504 1.693-1.388 3.238-2.632
                                            4.486l-3.763 3.773a4.79 4.79 0 0 1-3.411 1.418h-4.523a4.79 4.79 0 0
                                            1-3.411-1.418l-3.763-3.773c-1.244-1.248-2.128-2.793-2.632-4.486h-1.442a2.903
                                            2.903 0 0 1-2.895-2.903v-7.743c0-1.312.878-2.412 2.073-2.77C12.791
                                            5.527 18.934 0 26.228 0c7.295 0 13.437 5.526 14.332 12.713a2.897
                                            2.897 0 0 1 2.072 2.77v7.743c0 1.6-1.299 2.903-2.895 2.903zm-21.581
                                            3.118l3.764 3.773a2.907 2.907 0 0 0 2.046.851h4.523a2.91 2.91 0 0 0
                                            2.047-.851l3.763-3.773a8.664 8.664 0 0 0 1.989-3.118h-20.12a8.649
                                            8.649 0 0 0 1.988 3.118zm8.072-27.313c-6.195 0-11.437 4.6-12.374
                                            10.646h24.749c-.936-6.046-6.18-10.646-12.375-10.646zm14.474
                                            13.549a.968.968 0 0
                                            0-.965-.968h-.965v3.872h-1.929v-3.872H15.614v3.872h-1.93v-3.872h-.965a.968.968
                                            0 0 0-.965.968v7.743c0
                                            .533.433.967.965.967h.965v-3.871h1.93v3.871h21.229v-3.871h1.929v3.871h.965a.967.967
                                            0 0 0
                                            .965-.967v-7.743zm-23.158.968h17.369v5.806H17.544v-5.806zm1.93
                                            3.871h13.509v-1.935H19.474v1.935zm36.668
                                            16.452h-1.93v-1.936h1.93v1.936zm0 15.484h-1.93V38.709h1.93v13.549z"
                                        />
                                        </svg>
                                        <a href="03_job_lists_row_map.html" class="h5 info-box-title">IT
                                            Contractor</a>
                                    </div>

                                    <div class="info-box-content">
                                        <a href="#" class="info-box-link">260 open positions</a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                                <div class="crumina-module crumina-info-box info-box--squared">

                                    <div class="info-box-thumb">
                                        <svg class="puzzle-icon" width="60" height="60">
                                            <path fill="" fill-rule="evenodd" d="M46.984 1.835L47.85.104c4.038
                                                2.019 10.062 8.044 12.078
                                                13.087l-1.797.719c-1.83-4.576-7.495-10.249-11.147-12.075zm13.014
                                                28.166C59.998 46.542 46.541 60 29.999 60 13.457 60 0 46.542 0
                                                30.001 0 13.461 13.457.002 29.999.002c16.542 0 29.999 13.459
                                                29.999 29.999zM29.999 1.938c-15.474 0-28.064 12.589-28.064 28.063
                                                0 15.475 12.59 28.064 28.064 28.064 15.473 0 28.063-12.589
                                                28.063-28.064 0-15.474-12.59-28.063-28.063-28.063zm22.257 28.063c0
                                                12.273-9.984 22.258-22.257 22.258-12.274
                                                0-22.257-9.985-22.257-22.258
                                                0-1.222.103-2.421.294-3.59l-.004-.004.005-.004C9.762 15.836 18.951
                                                7.744 29.999 7.744c11.047 0 20.236 8.092 21.963 18.659a.018.018 0
                                                0 1 .005.004l-.004.004c.189 1.169.293 2.368.293 3.59zm-3.183
                                                6.943c-1.352-1.191-4.95-4.04-8.429-4.04-3.528 0-5.807 2.66-5.807
                                                6.774 0 3.945 1.927 7.449 2.984 9.076a20.418 20.418 0 0 0
                                                11.252-11.81zM22.175 48.752c1.056-1.631 2.985-5.142 2.985-9.074
                                                0-4.114-2.279-6.774-5.806-6.774-3.49 0-7.081 2.848-8.431 4.038
                                                1.947 5.328 6.042 9.628 11.252 11.81zm7.824-39.073c-9.205 0-16.989
                                                6.157-19.479 14.566 5.478-4.26 12.67-6.824 19.479-6.824 6.808 0
                                                14.001 2.564 19.479
                                                6.823-2.49-8.408-10.274-14.565-19.479-14.565zm20.126
                                                17.659c-5.293-4.934-12.936-7.982-20.126-7.982-7.189 0-14.832
                                                3.048-20.126 7.982a20.156 20.156 0 0 0-.196 2.663c0 1.701.233
                                                3.345.629 4.925 1.847-1.514 5.392-3.957 9.048-3.957 4.558 0 7.742
                                                3.581 7.742 8.709 0 4.164-1.839 7.805-3.049 9.752a20.25 20.25 0 0
                                                0 5.952.893 20.25 20.25 0 0 0
                                                5.952-.893c-1.21-1.947-3.049-5.588-3.049-9.752 0-5.128 3.184-8.709
                                                7.742-8.709 3.656 0 7.201 2.443 9.048
                                                3.957.395-1.58.629-3.224.629-4.925
                                                0-.905-.081-1.79-.196-2.663zM36.773
                                                26.13h1.935v1.936h-1.935V26.13zm-6.774 5.807a4.845 4.845 0 0
                                                1-4.839-4.839 4.844 4.844 0 0 1 4.839-4.838 4.843 4.843 0 0 1
                                                4.838 4.838 4.844 4.844 0 0 1-4.838 4.839zm0-7.742a2.907 2.907 0 0
                                                0-2.903 2.903 2.906 2.906 0 0 0 2.903 2.903c1.6 0 2.903-1.302
                                                2.903-2.903 0-1.6-1.303-2.903-2.903-2.903zm-8.71
                                                1.935h1.936v1.936h-1.936V26.13zm7.742
                                                29.999h-1.935v-1.935h1.935v1.935zm3.871
                                                0h-1.936v-1.935h1.936v1.935zm-19.888 2.037l-.866 1.731C8.11 57.879
                                                2.086 51.853.07 46.812l1.797-.72c1.83 4.576 7.495 10.249 11.147
                                                12.074z" />
                                            </svg>
                                            <a href="03_job_lists_row_map.html" class="h5 info-box-title">Motoring
                                                & Automotive</a>
                                        </div>

                                        <div class="info-box-content">
                                            <a href="#" class="info-box-link">214 open positions</a>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                                    <div class="crumina-module crumina-info-box info-box--squared">

                                        <div class="info-box-thumb">
                                            <svg class="puzzle-icon" width="60" height="60">
                                                <path fill="" fill-rule="evenodd" d="M55.466 56.129C54.376 58.414
                                                    52.05 60 49.355 60H38.71a5.636 5.636 0 0
                                                    1-5.068-3.132l-.306-.613A3.708 3.708 0 0 0 30 54.194a3.71 3.71 0
                                                    0 0-3.337 2.061l-.306.613A5.634 5.634 0 0 1 21.29
                                                    60H10.645c-2.695
                                                    0-5.021-1.586-6.111-3.871H0V42.58h4.534c1.09-2.284 3.416-3.87
                                                    6.111-3.87h38.71c2.695 0 5.021 1.586 6.111
                                                    3.87H60v13.549h-4.534zM1.936
                                                    44.516v1.936h1.935v-.968c0-.329.032-.651.077-.968H1.936zm1.935
                                                    8.71v-4.839H1.936v5.807h2.012a6.882 6.882 0 0
                                                    1-.077-.968zm50.322-7.742a4.844 4.844 0 0
                                                    0-4.838-4.839h-38.71a4.844 4.844 0 0 0-4.838 4.839v7.742a4.844
                                                    4.844 0 0 0 4.838 4.839H21.29c1.422 0 2.7-.79
                                                    3.337-2.063l.306-.612A5.635 5.635 0 0 1 30 52.258c2.159 0 4.101
                                                    1.2 5.068 3.132l.306.612a3.708 3.708 0 0 0 3.336
                                                    2.063h10.645a4.844 4.844 0 0 0
                                                    4.838-4.839v-7.742zm3.871-.968h-2.012c.045.317.077.639.077.968v.968h1.935v-1.936zm0
                                                    3.871h-1.935v4.839c0 .329-.032.65-.077.968h2.012v-5.807zM27.097
                                                    42.58h1.935v1.936h-1.935V42.58zm-17.42
                                                    2.904v6.774H7.742v-6.774a2.907 2.907 0 0 1
                                                    2.903-2.904h14.516v1.936H10.645a.97.97 0 0
                                                    0-.968.968zm46.452-8.71H3.871A3.875 3.875 0 0 1 0
                                                    32.903c0-1.434.793-2.674 1.954-3.342C2.146 17.188 10.4 6.435
                                                    22.258 3.04v-.137A2.907 2.907 0 0 1 25.161 0h9.678c1.6 0 2.903
                                                    1.302 2.903 2.903v.137C49.6 6.435 57.854 17.188 58.046
                                                    29.561c1.161.668 1.954 1.908 1.954 3.342a3.875 3.875 0 0 1-3.871
                                                    3.871zm0-5.806h-1.936v-1.936h1.895A26.092 26.092 0 0 0 41.613
                                                    6.606v16.62h-1.936V5.743a27.159 27.159 0 0
                                                    0-1.935-.683v22.037h-1.935V2.903a.97.97 0 0
                                                    0-.968-.968h-9.678a.97.97 0 0
                                                    0-.968.968v24.194h-1.935V5.06c-.658.205-1.302.432-1.935.683v17.483h-1.936V6.606A26.092
                                                    26.092 0 0 0 3.912 29.032h48.346v1.936H3.871a1.937 1.937 0 0
                                                    0-1.935 1.935c0 1.067.868 1.936 1.935 1.936h52.258a1.938 1.938 0
                                                    0 0 1.935-1.936 1.937 1.937 0 0
                                                    0-1.935-1.935zm-16.452-5.807h1.936v1.936h-1.936v-1.936zm-21.29
                                                    0h1.936v1.936h-1.936v-1.936z" />
                                                </svg>
                                                <a href="03_job_lists_row_map.html" class="h5 info-box-title">Construction
                                                    & Facilities</a>
                                            </div>

                                            <div class="info-box-content">
                                                <a href="#" class="info-box-link">168 open positions</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40 sorting-item">
                                        <div class="crumina-module crumina-info-box info-box--squared">

                                            <div class="info-box-thumb">
                                                <svg class="puzzle-icon" width="60" height="60">
                                                    <path fill="" fill-rule="evenodd" d="M60
                                                        58.078V60H0v-1.922h1.935V7.597L0 6.861V0l34.839
                                                        13.223v6.862l-1.936-.735v1.778L60
                                                        31.479v6.863l-1.936-.74v20.476H60zM9.677
                                                        54.235h15.484v1.923H9.677v1.92h19.355v-1.92h-1.935v-1.923h1.935v-1.921H9.677v1.921zm0-3.842h19.355v-1.921H9.677v1.921zm0-7.686h1.936v1.921H9.677v1.922h19.355v-1.922H13.548v-1.921h15.484v-1.921H9.677v1.921zm0-3.843h19.355v-1.921H9.677v1.921zm23.226-24.317L1.935
                                                        2.792v2.747l30.968 11.753v-2.745zM30.968 27.25v-8.634L3.871
                                                        8.331v49.747h3.871V36.943H5.806v-1.922h27.097v1.922h-1.935v21.135h25.161V36.863L30.968
                                                        27.25zm27.096 5.549l-25.161-9.613v2.745l25.161
                                                        9.613v-2.745zm-23.225 6.065h19.354v13.45H34.839v-13.45zm10.645
                                                        11.529h6.774V46.55h-6.774v3.843zm0-5.765h6.774v-3.842h-6.774v3.842zm-8.71
                                                        5.765h6.774V46.55h-6.774v3.843zm0-5.765h6.774v-3.842h-6.774v3.842zM9.677
                                                        18.689h15.484v13.45H9.677v-13.45zm8.71
                                                        11.529h4.839v-3.843h-4.839v3.843zm0-5.765h4.839V20.61h-4.839v3.843zm-6.774
                                                        5.765h4.839v-3.843h-4.839v3.843zm0-5.765h4.839V20.61h-4.839v3.843z"
                                                    />
                                                    </svg>
                                                    <a href="03_job_lists_row_map.html" class="h5 info-box-title">Estate
                                                        Agency</a>
                                                </div>

                                                <div class="info-box-content">
                                                    <a href="#" class="info-box-link">127 open positions</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40
                                            sorting-item">
                                            <div class="crumina-module crumina-info-box info-box--squared">
                                                <div class="info-box-thumb">
                                                    <svg class="puzzle-icon" width="60" height="60">
                                                        <path fill="" fill-rule="evenodd" d="M58.118 8.547a2.287 2.287 0
                                                            0 0-1.021 1.907v4.062h-1.936v-4.062c0-1.417.704-2.731
                                                            1.883-3.517a2.288 2.288 0 0 0 1.02-1.907V0H60v5.03a4.218 4.218
                                                            0 0 1-1.882 3.517zm-5.807 0a2.29 2.29 0 0 0-1.021
                                                            1.907v4.062h-1.935v-4.062c0-1.417.703-2.731 1.882-3.517a2.287
                                                            2.287 0 0 0 1.021-1.907V0h1.935v5.03a4.216 4.216 0 0 1-1.882
                                                            3.517zm-5.806 0a2.287 2.287 0 0 0-1.021
                                                            1.907v4.062h-1.936v-4.062c0-1.417.704-2.731 1.883-3.517a2.29
                                                            2.29 0 0 0 1.021-1.907V0h1.935v5.03a4.216 4.216 0 0 1-1.882
                                                            3.517zm3.818 7.905c6.06 0 9.677 3.979 9.677 10.645 0
                                                            5.195-3.597 9.396-10.403 12.147-2.077.839-4.459 1.53-7.016
                                                            2.067v3.205a4.845 4.845 0 0 1-4.839 4.839h-1.935a.969.969 0 0
                                                            0-.968.968V60h-1.936v-9.677a2.907 2.907 0 0 1
                                                            2.904-2.903h1.935a2.907 2.907 0 0 0 2.903-2.904v-2.829A63.332
                                                            63.332 0 0 1 30 42.58c-3.644
                                                            0-7.271-.312-10.645-.893v2.829a2.907 2.907 0 0 0 2.903
                                                            2.904h1.935a2.907 2.907 0 0 1 2.904
                                                            2.903V60h-1.936v-9.677a.969.969 0 0 0-.968-.968h-1.935a4.845
                                                            4.845 0 0
                                                            1-4.839-4.839v-3.205c-2.557-.536-4.939-1.227-7.016-2.067C3.597
                                                            36.493 0 32.292 0 27.097c0-6.666 3.617-10.645 9.677-10.645
                                                            2.097 0 3.976.8 6.153 1.728.512.218 1.043.439
                                                            1.589.662v-5.693l2.904-2.903 2.903 2.903v7.488c1.25.256
                                                            2.53.435 3.871.538v-8.026L30 10.246l2.903 2.903v8.026a31.27
                                                            31.27 0 0 0 3.871-.539v-7.488l2.903-2.904 2.904
                                                            2.904v5.693c.547-.223 1.078-.444 1.591-.663 2.176-.926
                                                            4.055-1.726 6.151-1.726zm-19.355-2.503L30
                                                            12.981l-.968.968v15.083h1.936V13.949zm9.677
                                                            0l-.968-.968-.967.968v15.083h1.935V13.949zm-3.871
                                                            17.019v-8.356c-1.252.24-2.535.404-3.871.503v7.853h-5.806v-7.854a33.905
                                                            33.905 0 0
                                                            1-3.871-.502v2.549H21.29V13.949l-.967-.968-.968.968v15.083h1.935v-1.935h1.936v3.871h-5.807v-10.05a76.164
                                                            76.164 0 0
                                                            1-2.347-.958c-2.064-.879-3.694-1.573-5.395-1.573-4.92 0-7.741
                                                            3.175-7.741 8.71 0 7.858 10.366 12.103 21.727
                                                            13.236l.183-.457a18.3 18.3 0 0 0 1.315-6.829v-.144h1.936v.144c0
                                                            2.563-.481 5.069-1.42 7.45a65.26 65.26 0 0 0
                                                            3.671.141l.305-.762a18.3 18.3 0 0 0
                                                            1.315-6.829v-.144h1.935v.144c0 2.597-.489 5.137-1.454
                                                            7.547l-.014.033a63.385 63.385 0 0 0
                                                            3.8-.196l.223-.555c.421-1.05.746-2.156.968-3.288l1.899.372a20.28
                                                            20.28 0 0 1-.939 3.257c10.942-1.285 20.678-5.505 20.678-13.12
                                                            0-5.535-2.821-8.71-7.741-8.71-1.701 0-3.33.694-5.394
                                                            1.572-.705.301-1.505.632-2.348.959v10.05h-5.807zm-.081
                                                            3.78c.054-.58.081-1.153.081-1.701v-.144h1.936v.144c0 .608-.03
                                                            1.242-.09 1.881l-1.927-.18z" />
                                                        </svg>
                                                        <a href="03_job_lists_row_map.html" class="h5 info-box-title">Restaurant
                                                            & Food Service</a>
                                                    </div>

                                                    <div class="info-box-content">
                                                        <a href="#" class="info-box-link">85 open positions</a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb40
                                                sorting-item">
                                                <div class="crumina-module crumina-info-box info-box--squared">
                                                    <div class="info-box-thumb">
                                                        <svg class="puzzle-icon" width="60" height="60">
                                                            <path fill="" fill-rule="evenodd" d="M59.998 29.033L46.542
                                                                42.672c.801 1.416.607 3.256-.585 4.464a3.617 3.617 0 0 1-2.754
                                                                1.079 3.725 3.725 0 0 1-1.065 2.791 3.613 3.613 0 0 1-2.754
                                                                1.08 3.732 3.732 0 0 1-1.065 2.792 3.62 3.62 0 0
                                                                1-3.632.929l-.054.059-2.978 3.018a3.717 3.717 0 0 1-2.661
                                                                1.117 3.71 3.71 0 0 1-2.66-1.117 3.82 3.82 0 0 1-1.085-3.056
                                                                3.619 3.619 0 0 1-3.556-.95 3.724 3.724 0 0 1-1.065-2.792
                                                                3.613 3.613 0 0 1-2.754-1.08 3.717 3.717 0 0 1-1.065-2.791
                                                                3.616 3.616 0 0 1-2.754-1.079 3.744 3.744 0 0 1
                                                                0-5.24l.28-.283-3.819-3.871-1.365 1.357L0
                                                                30.001l.409-.407V.001h6.117l21.026 20.805-1.214 1.207 1.028
                                                                1.041 15.467-6.456
                                                                2.449-2.482.818.829L56.237.001h3.366v26.53l-1.037 1.05 1.432
                                                                1.452zM27.685 57.516a1.837 1.837 0 0 0 2.62 0l2.978-3.019a1.9
                                                                1.9 0 0 0 0-2.656 1.835 1.835 0 0 0-2.62 0l-2.978 3.018a1.899
                                                                1.899 0 0 0 0 2.657zm-4.642-4.006c.681.69 1.788.69 2.469
                                                                0l2.864-2.903a1.789 1.789 0 0 0 0-2.503 1.729 1.729 0 0
                                                                0-2.469 0l-2.864 2.903a1.789 1.789 0 0 0 0
                                                                2.503zm-3.819-3.87a1.73 1.73 0 0 0 2.462.005l.007-.006
                                                                2.864-2.904.006-.006a1.789 1.789 0 0 0-.006-2.496 1.729 1.729
                                                                0 0 0-2.469 0l-2.864 2.904a1.789 1.789 0 0 0 0
                                                                2.503zm-3.819-3.872a1.73 1.73 0 0 0 2.462.006l.007-.007
                                                                2.864-2.903.006-.006a1.788 1.788 0 0 0-.006-2.496 1.729 1.729
                                                                0 0 0-2.469 0l-2.864 2.904a1.787 1.787 0 0 0 0
                                                                2.502zm2.978-31.331L6.392 26.358l-1.337-1.381
                                                                11.961-11.892L5.749 1.936H2.318v25.761l1.297-1.29 1.336
                                                                1.382-2.224 2.212 6.424 6.386 15.671-15.579-6.439-6.371zm6.591
                                                                8.931L11.879 36.387l3.806 3.858 1.234-1.252a3.625 3.625 0 0 1
                                                                5.169 0 3.721 3.721 0 0 1 1.065 2.792 3.618 3.618 0 0 1 2.754
                                                                1.079 3.721 3.721 0 0 1 1.065 2.792 3.615 3.615 0 0 1 2.754
                                                                1.079 3.725 3.725 0 0 1 1.062 2.84c1.313-.418 2.841-.12
                                                                3.844.897a3.814 3.814 0 0 1 1.102 2.696c0
                                                                .291-.033.577-.095.854.478.026.965-.144 1.33-.513a1.789 1.789
                                                                0 0 0 0-2.503l-7.637-7.74-.956-.969 1.35-1.368.956.968 7.637
                                                                7.742c.681.69 1.788.69 2.469 0a1.789 1.789 0 0 0
                                                                0-2.503l-7.637-7.741-.956-.969 1.35-1.369.956.969 7.637
                                                                7.741c.681.69 1.788.69 2.469 0a1.787 1.787 0 0 0
                                                                0-2.502L32.474 30.968a63.939 63.939 0 0 0-1.635 4.846 4.28
                                                                4.28 0 0 1-4.088 3.065c-.385 0-.776-.054-1.164-.165a4.3 4.3 0
                                                                0 1-2.646-2.229 4.393 4.393 0 0
                                                                1-.165-3.483l3.252-8.566-1.054-1.068zm2.91 1.562l-3.325
                                                                8.767a2.389 2.389 0 0 0 .091 1.924 2.34 2.34 0 0 0 1.461 1.231
                                                                2.353 2.353 0 0 0 2.901-1.595c1.818-6.114 3.58-9.782
                                                                5.238-10.901l.372.566 4.7-4.765-11.438
                                                                4.773zm17.398-8.077l-11.97 12.133-.029.063 11.999 12.164
                                                                12.016-12.18-12.016-12.18zM57.694 1.936h-.453l-9.768 14.401
                                                                9.743 9.876.478-.484V1.936zM47.265 33.548l.599.607-1.351
                                                                1.369-.599-.608a2.728 2.728 0 0
                                                                1-3.854-.038l1.351-1.368a.84.84 0 0 0 1.196
                                                                0l1.272-1.29a.866.866 0 0 0 0-1.212.834.834 0 0
                                                                0-1.195-.001l-1.273 1.291a2.731 2.731 0 0 1-3.896 0 2.822
                                                                2.822 0 0 1-.036-3.909l-.601-.61 1.35-1.368.601.609a2.73 2.73
                                                                0 0 1 3.855.038l-1.35 1.368a.838.838 0 0 0-1.196 0l-1.273
                                                                1.29a.868.868 0 0 0 0 1.212.837.837 0 0 0 1.195
                                                                0l1.274-1.29a2.731 2.731 0 0 1 3.896 0 2.823 2.823 0 0 1 .035
                                                                3.91zm-29.353-15.16c1.6 0 2.901 1.303 2.901 2.903a2.905 2.905
                                                                0 0 1-2.901 2.903 2.905 2.905 0 0 1-2.901-2.903c0-1.6
                                                                1.301-2.903 2.901-2.903zm0 3.871a.982.982 0 0 0
                                                                .992-.968.982.982 0 0 0-.992-.968.982.982 0 0 0-.992.968c0
                                                                .533.445.968.992.968z" />
                                                            </svg>
                                                            <a href="03_job_lists_row_map.html" class="h5 info-box-title">Sales
                                                                & Marketing</a>
                                                        </div>

                                                        <div class="info-box-content">
                                                            <a href="#" class="info-box-link">42 open positions</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="#" class="crumina-button button--yellow button--xl
                        load-more-button" data-load-link="category-to-load.html"
                       data-container="category-grid">Show More Categories</a>
                </div>
            </div>

        </div>
    </section>
@endsection
