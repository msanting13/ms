        <!-- Navbar Area -->
        <div class="mag-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="magNav">

                    <!-- Nav brand -->
                    <a href="index.html" class="nav-brand"><img src="/mag/img/core-img/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Nav Content -->
                    <div class="nav-content d-flex align-items-center">
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li class="active"><a href="/">Home</a></li>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                        <div class="top-meta-data d-flex align-items-center">
                         <!-- Authentication Links -->
                            @guest
                                <a href="{{ route('login') }}" class="login-btn">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            @else

                                <a href="#" class="login-btn">
                                    Hello! {{ Auth::user()->name }}
                                </a>
                                @if(Auth::user()->hasRole('role_admin'))   
                                    <a href="{{ route('admin.dashboard') }}" class="submit-video"><span><i class="fa fa-dashboard"></i></span> <span class="video-text">Dashboard</span></a>
                                @else
                                     <a href="{{ route('user.dashboard') }}" class="submit-video"><span><i class="fa fa-dashboard"></i></span> <span class="video-text">Dashboard</span></a>
                                @endif
                                <a class="login-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="login-btn" title="Sign out">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>