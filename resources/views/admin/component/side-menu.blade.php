<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="Go Dental" class="w-6" src="{{asset('icons/log.png')}}">
        <span class="hidden xl:block text-white text-lg ml-3"> Go Dental </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <!--Dashboard-->
        <li>
            <a href="{{ route('dashboard.index') }}" class="side-menu {{ (request()->is('admin/dashboard')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-house p-1 fa-lg"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <!--Product Attribute-->
        @if (Auth::guard('web')->user()->can('brand_access') || Auth::guard('web')->user()->can('category_access'))
        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('admin/brand')) || (request()->is('admin/category'))  ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-truck-ramp-box fa-lg p-1"></i> </div>
                    <div class="side-menu__title">
                        Product Attribute
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
            </a>
            <ul class="">
                @can('brand_access')
                <li>
                    <a href="{{ route('brand.index') }}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-b p-1 fa-lg"></i> </div>
                        <div class="side-menu__title"> Brand </div>
                    </a>
                </li>
                @endcan
                @can('category_access')
                <li>
                    <a href="{{ route('category.index') }}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-c p-1 fa-lg"></i> </div>
                        <div class="side-menu__title"> Category </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        <!--Product-->
        @if (Auth::guard('web')->user()->can('product_create') || Auth::guard('web')->user()->can('product_access') || Auth::guard('web')->user()->can('inventory_access'))
        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('admin/product')) || (request()->is('admin/inventory')) || (request()->is('admin/addproduct')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="fa-brands fa-product-hunt  fa-lg p-1"></i></div>
                    <div class="side-menu__title">
                        Product
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                @can('product_access')
                <li>
                    <a href="{{Route('product.index')}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-p fa-lg p-1"></i> </div>
                        <div class="side-menu__title"> Product </div>
                    </a>
                </li>
                @endcan
                @can('inventory_access')
                <li>
                    <a href="{{Route('inventory.index')}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-warehouse fa-lg p-1"></i> </div>
                        <div class="side-menu__title"> Inventory </div>
                    </a>
                </li>
                @endcan

                @can('inventory_transfer_access')
                    <li>
                        <a href="{{Route('transfer.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i class="fa-solid fa-shuffle mr-1 fa-lg p-1"></i> </div>
                            <div class="side-menu__title"> Transfer </div>
                        </a>
                    </li>
                @endcan

                @can('product_create')
                <li>
                    <a href="{{Route('product.create')}}" class="side-menu">
                        <div class="side-menu__icon"> <i class="fa-solid fa-plus mr-1 fa-lg p-1"></i> </div>
                        <div class="side-menu__title"> Add New Product </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        @can('supplier_access')
        <li>
            <a href="{{ route('supplier.index') }}" class="side-menu {{ (request()->is('admin/supplier')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-boxes-packing p-1 fa-lg"></i></div>
                <div class="side-menu__title"> Supplier </div>
            </a>
        </li>
        @endcan
        <!--Orders-->
        @can('order_access')
        <li>
            <a href="{{Route('orders.index')}}" class="side-menu {{ (request()->is('admin/orders')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-cart-plus fa-lg p-1"></i> </div>
                <div class="side-menu__title"> Orders </div>
            </a>
        </li>
        @endcan

        <!--Post-->
        @can('post_access')
        <li>
            <a href="{{Route('post.index')}}" class="side-menu {{ (request()->is('admin/post')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-signs-post fa-lg p-1"></i> </div>
                <div class="side-menu__title"> Home Banner </div>
            </a>
        </li>
        @endcan
        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create') || Auth::guard('web')->user()->can('customer_access'))
        <!--Divider-->
        <li class="side-nav__devider my-6"></li>
        @endif
        <!--Customers-->
        @can('customer_access')
        <li>
            <a href="{{Route('customer.index')}}" class="side-menu {{ (request()->is('admin/customer')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-user-doctor fa-lg p-1"></i> </div>
                <div class="side-menu__title"> Customers </div>
            </a>
        </li>
        @endcan
        <!--Users-->
        <!--Roles-->
        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create'))
        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('admin/role')) || (request()->is('admin/permission')) || (request()->is('admin/user')) ?  'side-menu--active ' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-users-gear fa-lg p-1"></i> </div>
                <div class="side-menu__title">
                    Users
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                @can('user_management_access')
                    <li>
                        <a href="{{Route('user.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i class="fa-solid fa-user fa-lg p-1"></i> </div>
                            <div class="side-menu__title">Users</div>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                    <li>
                        <a href="{{Route('role.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i class="fa-solid fa-r fa-lg p-1"></i> </div>
                            <div class="side-menu__title">Role</div>
                        </a>
                    </li>
                @endcan
                @can('user_create')
                    <li>
                        <a href="{{Route('user.create')}}" class="side-menu">
                            <div class="side-menu__icon">  <i class="fa-solid fa-plus mr-1 fa-lg p-1"></i>  </div>
                            <div class="side-menu__title">Add New User</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        @endif
        @if (Auth::guard('web')->user()->can('report_access') || Auth::guard('web')->user()->can('analytics_access'))
        <!--Divider-->
        <li class="side-nav__devider my-6"></li>
        @endif
        @can('report_access')
            <!--Reports-->
            <li>
                <a href="{{Route('report.index')}}" class="side-menu {{ (request()->is('admin/report')) ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"> <i class="fa-solid fa-chart-pie fa-lg p-1"></i> </div>
                    <div class="side-menu__title"> Reports </div>
                </a>
            </li>
        @endcan

        @can('analytics_access')
            <!--Analytics-->
            <li>
                <a href="{{Route('analytics.index')}}" class="side-menu {{ (request()->is('admin/analytics')) ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"> <i class="fa-solid fa-chart-simple fa-lg p-1"></i> </div>
                    <div class="side-menu__title"> Analytics </div>
                </a>
            </li>
        @endcan

    </ul>
</nav>
