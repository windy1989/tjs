<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <form class="form-inline">
                <button type="button" id="sidebarToggleTop" class="btn btn-link rounded-circle">
                    <i class="fa fa-bars"></i>
                </button>
                <a href="javascript:void(9);" class="nav-link text-dark d-none d-sm-block" style="pointer-events: none;">
                    {{ date('l, d F Y') }}&nbsp;
                    <span id="header-clock-realtime"></span>
                </a>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow mx-1">
                    <a href="javascript:void(0);" class="nav-link">
                        <div id="google_translate_element"></div>
                    </a>
                </li>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Calvin Dito Pratama</span>
                        <img class="img-profile rounded-circle" src="{{ asset('template/back-office/img/undraw_profile.svg') }}">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>