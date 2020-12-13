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
        <li><a href="{{url('/')}}">@lang('site.Home')</a></li>
        <li><a href="{{url('faq')}}">@lang('site.FAQ')</a></li>

        <li class="menu-item-has-mega-menu menu-item-has-children">
            <a href="#">
                <span class="show indicator"><i class="puzzle-icon far fa-angle-down"></i></span>
                @lang('global.Products')
            </a>
            <div class="megamenu">
                <div class="megamenu-row">

                    <div class="col3">
                        <ul>
                            <li class="megamenu-item-info"><h6 class="megamenu-item-info-title">@lang('site.OtherServices')</h6></li>
                            <li>
                                <a><i class="puzzle-icon fas fa-caret-left"></i>@lang('site.ComingSoon')</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col3">
                        <ul>
                            <li class="megamenu-item-info"><h6 class="megamenu-item-info-title">@lang('site.ExtraServices')</h6></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.PayForm')</a></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.PayInvoice')</a></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.PayForm')</a></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.DedicatedGateway')</a></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.QRPay')</a></li>
                            <li><a href=""><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.USSDPay')</a></li>
                        </ul>
                    </div>

                    <div class="col3">
                        <ul>
                            <li class="megamenu-item-info"><h6 class="megamenu-item-info-title">@lang('site.MainServices')</h6></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.IPG')</a></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.MultiplexIPG')</a></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.MPG')</a></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.AsanLink')</a></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.InAppPay')</a></li>
                            <li><a href="#"><i class="puzzle-icon fas fa-caret-left"></i>@lang('global.PayWithWallet')</a></li>
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

                <li><a href="{{url('plugins')}}">@lang('global.Plugins')</a></li>
                <li><a href="{{url('documentations')}}">@lang('global.MerchantAPIDoc')</a></li>
                <li><a target="_blank" href="https://github.com/asanpay">Github</a></li>

            </ul>
        </li>


        <li class=""><a href="{{url('fees')}}">@lang('global.Fees')</a></li>
        <li class=""><a href="{{url('blog')}}">@lang('global.Blog')</a></li>
        <li class=""><a href="{{url('contact-us')}}">@lang('global.ContactUs')</a></li>
    </ul>

</nav>
