<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">التجار </span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Vendor::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.vendors' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.vendors')}}" data-i18n="nav.dash.ecommerce"> عرض الكل</a>
                    </li>

                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">العملاء </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Customer::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.customers' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.customers')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام </span>
                    <span
                        class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\Category::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.categories' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.categories')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأصناف </span>
                    <span
                        class="badge badge badge-secondary badge-pill float-right mr-2">{{\App\Models\Type::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.types' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.types')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الألوان </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Color::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.colors' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.colors')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">العروض </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Offer::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.offers' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.offers')}}" data-i18n="nav.dash.ecommerce">عرض الكل</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">{{\App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="{{'index.designs' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.designs')}}" data-i18n="nav.dash.ecommerce">
                            التصاميم
                            <span class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Design::count()}}</span>
                        </a>

                    </li>

                    <li class="{{'index.fabrics' == request()->path() ? 'active' : ''}}"><a class="menu-item" href="{{route('index.fabrics')}}" data-i18n="nav.dash.ecommerce">
                            الأقمشة
                            <span class="badge badge badge-warning badge-pill float-right mr-2">{{\App\Models\Fabric::count()}}</span>
                        </a>

                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
