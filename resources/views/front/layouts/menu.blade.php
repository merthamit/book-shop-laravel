<!--================ Start Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="index.html"><img src="{{ asset('/front') }}/img/logo.png"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    @php
                        $menus = config('menu.items');
                    @endphp
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        @foreach ($menus as $menu)
                            <li class="nav-item @if (Request::segment(1) == $menu['segment']) active @endif "><a class="nav-link"
                                    href="{{ route($menu['link']) }}">{{ $menu['title'] }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="nav-shop">
                        @if (Auth::check())
                            <li class="nav-item">
                                <a href="{{ route('shop.cart') }}">
                                    <i class="ti-shopping-cart"></i>
                                    <span class="nav-shop__circle">{{ $count }}</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('my.orders') }}">
                                        <i class="fas fa-truck fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Siparişlerim
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Çıkıp Yap
                                    </a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item mr-0">
                                <a class="button button-header" href="{{ route('login') }}">Giriş Yap</a>
                            </li>
                            <li class="nav-item ml-0">
                                <a class="button button-header" href="{{ route('register') }}">Kayıt Ol</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================ End Header Menu Area =================-->
