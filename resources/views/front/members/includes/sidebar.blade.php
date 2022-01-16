<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('user.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{trans('السحوبات')}} </span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('user.active.lotteries',auth()->user()->id)}}"
                            data-i18n="nav.dash.ecommerce">
                            {{ trans('سحوباتي') }} </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">عمليات الشحن </span>
                    {{-- <span class="badge badge badge-success badge-pill float-right mr-2"></span> --}}
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('user.transactions.log',auth()->user()->id)}}"
                            data-i18n="nav.dash.crypto"> تاريخ الشحن
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
