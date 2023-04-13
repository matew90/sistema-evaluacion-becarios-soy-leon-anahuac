<!DOCTYPE html>
<html lang="es_MX" dir="ltr">

<head>
    <head>
        <meta charset="utf-8" /><meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title') | UAQ</title>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" Descripción del módulo " name="description" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('/public/img/logos/ico.png') }}">

        <!-- App css -->
        <link href="{{ url('/public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/style.css').'?123566666' }}" rel="stylesheet" type="text/css" />
    </head>

        <!-- Top Bar Start -->
        <!-- <div class="topbar">
             <nav class="navbar-custom">
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="{{ url('/public/img/logos/anahuac.png') }}" alt="Anáhuac Querétaro" class="logo-sm">
                        </span>
                        <span>
                            <img src="{{ url('/public/img/logos/anahuac.png') }}" alt="Anáhuac Querétaro" class="logo-lg">
                        </span>
                    </a>
                </div>
            </nav>
        </div> -->

        <div class="topbar">
             <!-- Navbar -->
             <nav class="navbar-custom">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="{{ url('/public/img/logos/anahuac.png') }}" alt="Anáhuac Querétaro" class="logo-sm">
                        </span>
                        <span>
                            <img src="{{ url('/public/img/logos/anahuac.png') }}" alt="Anáhuac Querétaro" class="logo-lg">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topbar-nav float-right mb-0">

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline nav-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications (258)
                            </h6>
                            <div class="slimscroll notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                    <p class="notify-details">Your item is shipped<small class="text-muted">It is a long established fact that a reader will</small></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details">New Message received<small class="text-muted">You have 87 unread messages</small></p>
                                </a>
                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/user-1.jpg" alt="profile-user" class="rounded-circle" />
                            <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted mr-2"></i> My Wallet</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted mr-2"></i> Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                        </div>
                    </li>
                    <li class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle nav-link" id="mobileToggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>
                </ul>

                <ul class="list-unstyled topbar-nav mb-0">
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>

                </ul>

            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->

        <div class="page-wrapper-img">
            <div class="page-wrapper-img-inner">
                <div class="sidebar-user media">
                  <!-- user info -->
                    <img src="{{ url('/public/img/user/user.png') }}" alt="user" class="rounded-circle img-thumbnail mb-1">
                    <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
                    <div class="media-body">
                        <h5 class="text-light">{{ Crypt::decryptString(Auth::user()->name) }} </h5>
                        <ul class="list-unstyled list-inline mb-0 mt-2">
                            <li class="list-inline-item">
                                <a href="#" class=""><i class="mdi mdi-account text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class=""><i class="mdi mdi-settings text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class=""><i class="mdi mdi-power text-danger"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Page-Title -->
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="page-title-box">

                          <!-- <h4 class="page-title mb-2">  <i class=" mr-2"></i></h4> -->
                          <h4 class="page-title mb-2">  <i class="{{ $info['act_menu']->men_icon }} mr-2"></i>{{ (empty($info['act_submenu']))?$info['act_menu']['men_name']:(json_decode($info['act_menu']['sub_bread'], true)[$info['act_submenu']]['name']) }}</h4>
                            <div class="">
                              <!-- breadcrumb -->
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Frogetor</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li> -->
                                  {{ (empty($info['act_submenu']))?$info['act_menu']['men_name']:(json_decode($info['act_menu']['sub_bread'], true)[$info['act_submenu']]['name']) }}
                                </ol>
                            </div>
                        </div><!--end page title box-->
                    </div><!--end col-->
                </div><!--end row-->

                <!-- end page title end breadcrumb -->
            </div><!--end page-wrapper-img-inner-->
        </div><!--end page-wrapper-img-->


        <div class="page-wrapper">
            <div class="page-wrapper-inner">
                <div class="navbar-custom-menu">
                    <div class="container-fluid">
                      @include('general.menu')
                    </div>
                </div>
                <!-- end left-sidenav-->
            </div>
            <!--end page-wrapper-inner -->
            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                  @yield('content')
                </div>
                <footer class="footer text-center text-sm-left">
                    &copy; 2022 Universidad Anáhuac Querétaro  <span class="text-muted d-none d-sm-inline-block float-right"> by DMNH</span>
                </footer>
            </div>
        </div>

        <!-- jQuery  -->
        <script src="{{ url('/public/js/jquery.min.js') }}"></script>
        <script src="{{ url('/public/js/bootstrap.bundle.min.js') }}"></script>
        @yield('footer')

        <!-- App js -->
        <script src="{{ url('assets/js/app.js') }}"></script>




    </body>
</html>
