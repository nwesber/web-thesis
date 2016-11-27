<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'iSCHED') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboard.css') }}">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/menu.js') }}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <div id="wrapper">
    <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"> Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/routine') }}"><strong>iSCHED</strong></a>
        </div>

        <!-- Navbar-Header -->
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
             <ul class="dropdown-menu dropdown-user">
                <li>
                  <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
          </li>
        </ul>

        <!-- Navbar Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

              <li class="sidebar-search">
                <div class="input-group custom-search-form">
                  <input type="text" class="form-control" placeholder="Search . . . .">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </li>

              <li>
                <a href="{{ url('/routine') }}"><i class="fa fa-dashboard fa-fw"></i> Home</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Events</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Groups</a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
    <!-- END -->

    <div id="page-wrapper">
      @yield('content')
    </div>

  </div>
</body>
</html>

