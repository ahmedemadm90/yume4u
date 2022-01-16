<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('agent.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>


            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Product::where('user_id',auth()->user()->id)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('agent.products.create')}}" data-i18n="nav.dash.crypto">أضافة
                            منتج </a>
                    </li>
                    <li class=""><a class="menu-item" href="{{route('agent.products')}}" data-i18n="nav.dash.ecommerce">
                            عرض الكل </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">السحوبات </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Lottery::where('user_id',auth()->user()->id)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('agent.active.lotteries')}}"
                            data-i18n="nav.dash.crypto">السحوبات المفعلة
                        </a>
                    </li>
                    <li class=""><a class="menu-item" href="{{route('agent.expired.lotteries')}}"
                            data-i18n="nav.dash.ecommerce">
                            السحوبات المنتهية </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">شحن رصيد </span>
                    {{-- <span class="badge badge badge-success badge-pill float-right mr-2"></span> --}}
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('agent.charges')}}" data-i18n="nav.dash.crypto"> العمليات
                            المعلقة
                            <span
                                class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Transaction::where('agent_id',auth()->user()->id)->where('state','pindding')->count()}}</span>
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{route('agent.user.charge')}}" data-i18n="nav.dash.crypto">شحن رصيد
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{route('agent.user.log')}}" data-i18n="nav.dash.crypto">عملياتي
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
