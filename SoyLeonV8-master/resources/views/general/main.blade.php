<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Universidad Anáhuac Querétaro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="./public/img/logos/anahuac-queretaro.png">

        <link href="./public/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">

        <link href="http://themesbrand.com/lexa/layouts/assets/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
        <link href="http://themesbrand.com/lexa/layouts/assets/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
        <link href="http://themesbrand.com/lexa/layouts/assets/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
        <link href="http://themesbrand.com/lexa/layouts/assets/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="./public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="./public/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="./public/css/style.css" rel="stylesheet" type="text/css" />



    </head>

    <body>

        <!-- Top Bar Start -->
        <div class="topbar">
             <!-- Navbar -->
             <nav class="navbar-custom">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="./public/img/logos/anahuac.png" alt="logo-small" class="logo-sm">
                        </span>
                        <!--<span>
                            <img src="./public/img/logos/anahuac.png" alt="logo-large" class="logo-lg">
                        </span>-->
                    </a>
                </div>

                <ul class="list-unstyled topbar-nav float-right mb-0">


                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="./public/img/user/user.png" alt="profile-user" class="rounded-circle" />
                            <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i>Mi perfil</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Configuración</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout"><i class="dripicons-exit text-muted mr-2"></i> Cerrar sesión</a>
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
                    <img src="./public/img/user/user.png" alt="user" class="rounded-circle img-thumbnail mb-1">
                    <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
                    <div class="media-body">
                        <h5 class="text-light">{{ Crypt::decryptString(auth()->user()->name) }} </h5>
                        <ul class="list-unstyled list-inline mb-0 mt-2">
                            <li class="list-inline-item">
                                <a href="#" class=""><i class="mdi mdi-account text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class=""><i class="mdi mdi-settings text-light"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="logout" class=""><i class="mdi mdi-power text-danger"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title mb-2"><i class="mdi mdi-monitor mr-2"></i>Administrativos</h4>
                            <div class="">
                                <ol class="breadcrumb">

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
                <!-- end left-sidenav-->
            </div>
            <!--end page-wrapper-inner -->
            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mb-4">
    						@if (isset($menu))
                  @foreach ($menu as $key => $value)
                        <div class="col-lg-3">
                            <div class="card overflow-hidden">
                                <div class="card-body bg-gradient1">
                                    <div class="">
                                        <div class="card-icon">
                                            <i class="{{ $value['icon'] }} "></i>
                                        </div>
                                        <h2 class="font-weight-bold text-white"></h2>
                                        <p class="text-white mb-0 font-16"></p>
                                    </div>
                                </div>
                                <div class="card-body dash-info-carousel">
                									 <a class="nav-link " href="{{ $value['slug'] }}">
                                    <div id="carousel_best_saler" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="text-center">
                                                     <i class="{{ $value['icon'] }} fa-10x"></i>
                                                    <h5>{{ $value['name'] }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                									</a>
                                </div><!--end card-body-->
                            </div><!--end card-->

                  @endforeach
                @endif


                    </div><!--end row-->

                </div><!-- container -->

                <footer class="footer text-center text-sm-left">
                    &copy; 2022 <span class="text-muted d-none d-sm-inline-block float-right">Universidad Anáhuac Querétaro</span>
                </footer>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        <!-- jQuery  -->
       <script src="./public/js/jquery.min.js"></script>
        <script src="./public/js/bootstrap.bundle.min.js"></script>
        <script src="./public/js/waves.min.js"></script>
        <script src="./public/js/jquery.slimscroll.min.js"></script>
        <script src="./public/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="./public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="./public/plugins/moment/moment.js"></script>
        <script src="./public/plugins/apexcharts/apexcharts.min.js"></script>
        <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
        <script src="https://apexcharts.com/samples/assets/series1000.js"></script>
        <script src="https://apexcharts.com/samples/assets/ohlc.js"></script>


    </body>
</html>
