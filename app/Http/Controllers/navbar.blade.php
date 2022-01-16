<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">
                    <div class="detail-email d-flex align-items-center justify-content-center">
                        <i class="icon-email"></i>
                        <p>Email : </p>
                        <span>
                            info@yume4u.com
                        </span>
                    </div>
                    @guest
                    <div class="detail-call d-flex align-items-center justify-content-center">
                        <i class="icon-deal"></i>
                        <p>
                            <a class="register" href="/agent/register" data-link-action="display-register-form">
                                كن شريكا للنجاح - سجل كوكيل
                            </a>
                            <span class="or-text"> أو </span>
                            <a class="login" href="/agent/login" rel="nofollow" title="تسجيل الدخول إلى حسابك"> دخول
                                الوكلاء</a>

                        </p>
                    </div>
                    @endguest
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
                    <div class="register-out">
                        @auth
                        <div class="dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true">
                                {{auth()->user()->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="@if (!isset(auth()->user()->role_id)){
{{route('admin.dashboard')}}
}@elseif(auth()->user()->role_id == 5){
{{route('user.dashboard')}}
}@elseif(auth()->user()->role_id == 4){
{{route('agent.dashboard')}}
}">{{ trans('لوحة التحكم') }}</a>
                                <hr class="menu-divider">
                                <p class="dropdown-item text-bold" href="">My Wallet : {{auth()->user()->wallet}}
                                    &nbsp; Y</p>
                                <hr class="menu-divider">
                                <a class="dropdown-item text-danger" href="{{route('member.logout')}}">Logout</a>
                            </div>
                        </div>
                        @endauth
                        @guest

                        <a class="register" href="/register" data-link-action="display-register-form">
                            إشتراك
                        </a>


                        <span class="or-text"> أو </span>
                        <a class="login" href="/login" rel="nofollow" title="تسجيل الدخول إلى حسابك">دخول</a>
                        @endguest

                    </div>

                    <!-- begin module:ps_currencyselector/ps_currencyselector.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_currencyselector/ps_currencyselector.tpl -->

                    <!--
                    <div id="_desktop_currency_selector" class="currency-selector groups-selector hidden-sm-down currentcy-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="main">
                            <span class="expand-more">GBP</span>
                        </div>
                        <div class="currency-list dropdown-menu">
                            <div class="currency-list-content text-left">
                                <div class="currency-item current flex-first">
                                    <a title="جنيه إسترليني" rel="nofollow" href="http://demo.bestprestashoptheme.com/savemart/ar/?home=home_3&amp;SubmitCurrency=1&amp;id_currency=1">UK£ GBP</a>
                                </div>
                                <div class="currency-item">
                                    <a title="دولار أمريكي" rel="nofollow" href="http://demo.bestprestashoptheme.com/savemart/ar/?home=home_3&amp;SubmitCurrency=1&amp;id_currency=2">US$ USD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->




                    <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_currencyselector/ps_currencyselector.tpl -->
                    <!-- end module:ps_currencyselector/ps_currencyselector.tpl -->

                    <!-- begin module:ps_languageselector/ps_languageselector.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_languageselector/ps_languageselector.tpl -->

                    <div id="_desktop_language_selector"
                        class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            role="main">
                            <span class="expand-more"><img class="img-fluid" src="{{asset('assets/images/ar.jpg')}}"
                                    alt="اللغة العربية" width="16" height="11" /></span>
                        </div>
                        <div class="language-list dropdown-menu">
                            <div class="language-list-content text-left">
                                <div class="language-item">
                                    <div>
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('assets/images/en.jpg')}}" alt="English"
                                                width="16" height="11" />
                                            <span>English</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="language-item current flex-first">
                                    <div class="current">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('assets/images/ar.jpg')}}"
                                                alt="اللغة العربية" width="16" height="11" />
                                            <span>اللغة العربية</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_languageselector/ps_languageselector.tpl -->
                    <!-- end module:ps_languageselector/ps_languageselector.tpl -->

                </div>
            </div>
        </div>
    </div>
</div>
