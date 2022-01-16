<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{ url('/admin') }}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item   ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Language::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.languages')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.languages.create')}}"
                            data-i18n="nav.dash.crypto">أضافة
                            لغة جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Category::defaultCategory() ->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.categories')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create')}}"
                            data-i18n="nav.dash.crypto">أضافة
                            قسم جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Product::defaultProduct() ->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.products')}}" data-i18n="nav.dash.ecommerce">
                            عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}" data-i18n="nav.dash.crypto">أضافة
                            منتج </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">السحوبات</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Lottery::defaultLottery() ->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.lotteries')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.lotteries.create')}}"
                            data-i18n="nav.dash.crypto">أضافة
                            سحب </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المستخدمين </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{App\Models\User::defaultUser() ->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.users')}}" data-i18n="nav.dash.ecommerce">
                            عرض كل المستخدمين </a></li>
                    <li class=""><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce"> إضافة مستخدم جديد </a>
                    </li>
                    <li class=""><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce"> عرض كل المشرفين </a></li>
                    <li class=""><a class="menu-item" href="#" data-i18n="nav.dash.ecommerce"> إضافة مشرف جديد </a></li>

                    <li class=""><a class="menu-item" href="{{route('admin.roles')}}" data-i18n="nav.dash.ecommerce">
                            عرض الأدوار </a></li>
                    <li class=""><a class="menu-item" href="{{route('admin.roles.create')}}"
                            data-i18n="nav.dash.ecommerce"> إضافة دور جديد </a></li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الوكلاء </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2">
                        {{App\Models\User::where('role_id',4)->where('active',1) ->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="{{route('admin.agents.create')}}" data-i18n="nav.dash.ecommerce">
                            اضافة وكيل</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('admin.agents.requests')}}" data-i18n="nav.dash.ecommerce">
                            الطلبات
                            <span class="badge badge badge-danger badge-pill float-right mr-2">
                                {{App\Models\User::where('role_id',4)->where('active',0) ->count()}}</span></a>
                    </li>
                    <li class=""><a class="menu-item" href="{{route('admin.agents')}}" data-i18n="nav.dash.ecommerce">
                            عرض الوكلاء
                            <span class="badge badge badge-danger badge-pill float-right mr-2">
                                {{App\Models\User::where('role_id',4)->where('active',1) ->count()}}</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ trans('الشحن') }} </span>
                </a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="{{route('admin.user.charge')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('شحن رصيد') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('admin.charges')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('ألعمليات المعلقة') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('admin.user.log')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('عملياتي') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('admin.agent.transactions.log')}}"
                            data-i18n="nav.dash.ecommerce">
                            {{ trans('جميع عمليات الوكلاء') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{ trans('التقارير') }} </span>
                </a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="{{route('ActiveProducts.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('المنتجات المفعلة') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('DisabledProducts.reports')}}"
                            data-i18n="nav.dash.ecommerce">
                            {{ trans('المنتجات الغير مفعلة') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('ActiveLotteries.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('السحوبات المفعلة') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('DisabledLotteries.reports')}}"
                            data-i18n="nav.dash.ecommerce">
                            {{ trans('السحوبات الغير مفعلة') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('ActiveUsers.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('المستخدمين المفعلين') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('DisabledUsers.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('المستخدمين المتوقفين') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('ActiveAgents.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('الوكلاء المفعلين') }}</a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="{{route('DisabledAgents.reports')}}" data-i18n="nav.dash.ecommerce">
                            {{ trans('الوكلاء المتوقفين') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
