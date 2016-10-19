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
    <link rel="stylesheet" type="text/css" href="https://bowercdn.net/c/klasify-0.4.4/stylesheets/klasify.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/material.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/routine.css') }}">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialite.min.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Routine</span>
          <div class="mdl-layout-spacer"></div>

        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="{{ URL::asset('images/user.jpg') }}" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span style="margin-top: 10px;">Welcome, {{ Auth::user()->name }}</span>
            <div class="mdl-layout-spacer"></div>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="{{ url('/routine') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assignment</i>Routine</a>
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">event</i>Events</a>
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Groups</a>
          <a class="mdl-navigation__link" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i>Logout</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="GET" style="display: none;">
                      {{ csrf_field() }}
                  </form>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

             @yield('content')

        </div>
      </main>
    </div>


</body>
</html>

