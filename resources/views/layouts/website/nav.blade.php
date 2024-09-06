<header class="section page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-corporate" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="106px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-aside-outer">
                <div class="rd-navbar-aside">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!-- RD Navbar Toggle-->
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <!--Brand-->
                            <a class="brand" href="index.html">
                                <h6>Discover Egypt</h6>
                            </a>
                            {{-- <img src="{{asset('site/images/logo-default-450x37.png')}}" alt="" width="225" height="18"/> --}}
                        </div>
                    </div>
                    <div class="rd-navbar-aside-right rd-navbar-collapse">
                        @auth('web')
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('logout', 'web') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        @lang('site.logout')
                                    </a>
                                    <form id="logout-form" action="{{ route('logout', 'web') }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('GET')
                                    </form>
                                </div>
                            </div>
                        @endauth
                        @guest()
                            <a href="{{ route('user.register') }}">@lang('site.create_account')</a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <div class="rd-navbar-nav-wrap">
                        <li class="dropdown tasks-menu" style="text-decoration: none ;">
                            <a href="#" style="text-decoration: none ; color:white" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"> @lang('site.lang')</i></a>
                            <ul class="dropdown-menu">
                                <li style="text-decoration: none ;">
                                    {{--<!-- inner menu: contains the actual data -->--}}
                                    <ul class="menu">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" style="text-decoration: none ; color:black" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item"><a class="rd-nav-link" href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="{{ route('places.trips') }}">@lang('site.trip_beach')</a></li>
                            <li class="rd-nav-item"><a class="rd-nav-link" href="{{ route('all.hotels') }}">@lang('site.hotels')</a></li>
                            @auth('web')
                                <li class="rd-nav-item"><a class="rd-nav-link" href="{{ route('tickets') }}">@lang('dashboard.tickets')</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
