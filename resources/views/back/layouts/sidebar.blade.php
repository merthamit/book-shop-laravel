<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('panel') }}" class="logo">
                <img src="{{ asset('back') }}/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                    height="20" />
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
                <li class="nav-item ">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Anasayfa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="sub-item">Anasayfa</span>
                                </a>
                                <a href="{{ route('panel') }}">
                                    <span class="sub-item">Panel</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @foreach (config('sidebar.items') as $item)
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#{{ $item['title'] }}">
                            <i class="{{ $item['icon'] }}"></i>
                            <p>{{ $item['title'] }}</p>
                            <span class="caret"></span>
                        </a>
                        @php
                            $subs = $item['subtitle'];
                            $subsLink = array_column($subs, 'link');
                        @endphp
                        <div class="collapse @if (in_array(Request::segment(2), $subsLink)) show @endif" id="{{ $item['title'] }}">
                            <ul class="nav nav-collapse">
                                @foreach ($item['subtitle'] as $subtitle)
                                    <li class="@if (Request::segment(2) == $subtitle['segment']) active @endif">
                                        <a href="{{ route($subtitle['link']) }}">
                                            <span class="sub-item">{{ $subtitle['title'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
