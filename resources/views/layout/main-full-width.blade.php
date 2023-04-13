<!DOCTYPE html>
<html lang="es_MX" dir="ltr">

<head>
    <head>
        <meta charset="utf-8" /><meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content=" Descripción del módulo " name="description" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('/public/img/logos/ico.png') }}">

        <!-- App css -->
        <link href="{{ url('/public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('/public/css/style.css').'?'.date('msh') }}" rel="stylesheet" type="text/css" />

        @yield('header')
    </head>

      <nav class="navbar navbar-expand-lg topbar-left bg-primary p-0">
        <div class="container-fluid">

        <div class="topbar-left">
            <a href="index.html" class="logo">
                <span>
                    <img src="{{ url('/public/img/logos/anahuac-blanco.png') }}" alt="logo-small" class="logo-sm">
                </span>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">menú</span>
        </button>
        <ul class="list-unstyled topbar-nav float-right mb-0">

          <li class="dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <img src="{{ url('/public/img/user/leo_user.png') }}" alt="profile-user" class="rounded-circle bg-white" />

          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="dripicons-exit text-muted mr-2"></i> Cerrar sesión</a>
          </div>
        </li>
        </ul>
      </div>
      </nav>

      @include('general.menu')

      <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="d-flex ">

                          <div class="icon-main-div d-flex rounded bg-primary" style=" border: 2px solid #fff">
                            <i class="icon {{  $info['currentSubmenu']['sub_icon'] }} icon-main pl-3 pr-3 m-auto text-white"></i>
                          </div>
                          <div class="ml-2">
                            <h1 class="mt-0 mb-0 header-title" style="color:#ff5900">{{ isset($info['currentSubmenu']['sub_name'])?$info['currentSubmenu']['sub_name']:"Sin nombre" }}</h1>
                            <p class="text-muted m-0 font-13"> {{ $info['currentSubmenu']->menu->men_name }} / {{ $info['currentSubmenu']['sub_name'] }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-8 col-md-6">
                        @yield('filter')
                      </div>
                    </div>
                  </div>
                </div>
              </div>


                      @yield('content')
            </div>
          </div>
        </div>
      </div>


        <!-- jQuery  -->
        <script src="{{ url('/public/js/jquery.min.js') }}"></script>
        <script src="{{ url('/public/js/bootstrap.bundle.min.js') }}"></script>
        @yield('footer')

        <!-- App js -->
        <script src="{{ url('public/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('public/js/app.js') }}"></script>






    </body>
</html>
