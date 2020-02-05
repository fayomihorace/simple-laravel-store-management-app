<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('path') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>G</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">GestStock</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="max-height: 50px">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    @if(Auth::check())
                    </a>
                    <ul class="dropdown-menu">
                        @endif
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="#"  style="color: white; font-weigth: bold">
                                <i class="fa fa-user"></i> {{session('utilisateur')[0]->username}}  |
                                </a>
                                <a href="{{ url('user/logout') }}"  style="color: white; font-weigth: bold">
                                logout   <i class="fa fa-arrow-circle-down"></i> 
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>