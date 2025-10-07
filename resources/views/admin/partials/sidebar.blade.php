<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('/dashboard') }}" class="logo">
                <img src="{{ asset('backend/assets/img/logo_light.png') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Products --}}
                <li class="nav-item {{ request()->routeIs('products.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#products"
                        aria-expanded="{{ request()->routeIs('products.*') ? 'true' : 'false' }}">
                        <i class="fas fa-th-list"></i>
                        <p>Sản Phẩm</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('products.*') ? 'show' : '' }}" id="products">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                                <a href="{{ route('products.index') }}">
                                    <span class="sub-item">Danh sách sản phẩm</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                                <a href="{{ route('products.create') }}">
                                    <span class="sub-item">Tạo mới sản phẩm</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Frames --}}
                <li
                    class="nav-item {{ request()->routeIs('frames.*') || request()->routeIs('frame-types.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#frames"
                        aria-expanded="{{ request()->routeIs('frames.*') || request()->routeIs('frame-types.*') ? 'true' : 'false' }}">
                        <i class="fas fa-images"></i>
                        <p>Khung hình</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('frames.*') || request()->routeIs('frame-types.*') ? 'show' : '' }}"
                        id="frames">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('frames.index') ? 'active' : '' }}">
                                <a href="{{ route('frames.index') }}">
                                    <span class="sub-item">Danh sách khung hình</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('frames.create') ? 'active' : '' }}">
                                <a href="{{ route('frames.create') }}">
                                    <span class="sub-item">Thêm mới khung hình</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('frame-types.index') ? 'active' : '' }}">
                                <a href="{{ route('frame-types.index') }}">
                                    <span class="sub-item">Loại khung hình</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Backdrops --}}
                <li class="nav-item {{ request()->routeIs('backdrops.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#backdrops"
                        aria-expanded="{{ request()->routeIs('backdrops.*') ? 'true' : 'false' }}">
                        <i class="far fa-window-maximize"></i>
                        <p>Phông nền</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('backdrops.*') ? 'show' : '' }}" id="backdrops">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('backdrops.index') ? 'active' : '' }}">
                                <a href="{{ route('backdrops.index') }}">
                                    <span class="sub-item">Danh sách phông nền</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('backdrops.create') ? 'active' : '' }}">
                                <a href="{{ route('backdrops.create') }}">
                                    <span class="sub-item">Thêm mới phông nền</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Blogs --}}
                <li class="nav-item {{ request()->routeIs('blogs.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#blogs"
                        aria-expanded="{{ request()->routeIs('blogs.*') ? 'true' : 'false' }}">
                        <i class="fa fa-newspaper"></i>
                        <p>Tin tức</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('blogs.*') ? 'show' : '' }}" id="blogs">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('blogs.index') ? 'active' : '' }}">
                                <a href="{{ route('blogs.index') }}">
                                    <span class="sub-item">Danh sách tin tức</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('blogs.create') ? 'active' : '' }}">
                                <a href="{{ route('blogs.create') }}">
                                    <span class="sub-item">Thêm mới tin tức</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Settings --}}
                <li class="nav-item {{ request()->routeIs('settings.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#settings"
                        aria-expanded="{{ request()->routeIs('settings.*') ? 'true' : 'false' }}">
                        <i class="fa fa-cogs"></i>
                        <p>Cấu hình</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('settings.*') ? 'show' : '' }}" id="settings">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('settings.index') ? 'active' : '' }}">
                                <a href="{{ route('settings.index') }}">
                                    <span class="sub-item">Thông tin Website</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>