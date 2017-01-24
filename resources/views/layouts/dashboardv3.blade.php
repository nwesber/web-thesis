<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'web-project') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.4.0/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard/dashboardv2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/task.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/event.css') }}">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css"/>

    <style type="text/css">
      .footer {
        display: table;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
      }
    </style>


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/jquery-1.12.3.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/dashboard/tether.min.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('js/dashboard/dashboardv2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard/menu.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.4.0/js/bootstrap-colorpicker.min.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
      MENU
      </button>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/routine') }}">
        <strong>iSCHED</strong>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Account
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">SETTINGS</li>
              <li class=""><a href="#">Other Link</a></li>
              <li class=""><a href="#">Other Link</a></li>
              <li class=""><a href="#">Other Link</a></li>
              <li class="divider"></li>
              <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   <i class="fa fa-sign-out fa-fw"></i>
                   Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container-fluid main-container">
    <div class="col-md-2 sidebar">
      <div class="row">
        <div class="absolute-wrapper"> </div>
        <!-- Menu -->
        <div class="side-menu">
          <nav class="navbar navbar-default" role="navigation">
            <!-- Main Menu -->
            <div class="side-menu-container">
              <ul class="nav navbar-nav">
                <li @yield('class')><a href="{{ url('/routine') }}"><i class="fa fa-dashboard fa-fw"></i> Routine</a></li>
                <li @yield('event')><a href="{{ url('/event') }}"><i class="fa fa-calendar fa-fw"></i> Event</a></li>
                <li @yield('group')><a href="{{ url('/group') }}"><i class="fa fa-users fa-fw"></i> Group</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav>

        </div>
      </div>
    </div>
    <div class="col-md-10 content">
      @yield('content')
    </div>
    <footer class="pull-left footer">
      <p class="col-md-12">
        <hr class="divider">
        Copyright &COPY; 2017 <a href="https://www.iacademy.edu.ph" target="_blank">iACADEMY</a>
      </p>
    </footer>
  </div>
</html>

