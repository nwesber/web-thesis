<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://code.getmdl.io/1.2.1/material.cyan-light_blue.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

<div class="mdl-layout mdl-js-layout">
    <section class="container">
        <div id="cube" class="show-front">
            <figure class="front">
                <div class="mdl-card mdl-shadow--6dp">
                    <div class="mdl-card__title mdl-color--primary mdl-color-text--white relative">
                        <h2 class="mdl-card__title-text">iSCHED</h2>
                    </div>
                    <form role="form" method="POST" action="{{ url('/login') }}">
                      {{ csrf_field() }}
                      <div class="mdl-card__supporting-text">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" id="email" type="email" name="email"/>
                              <label class="mdl-textfield__label" for="email">Email</label>
                          </div>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                              <label class="mdl-textfield__label" for="password">Password</label>
                          </div>
                      </div>

                      <div class="mdl-card__actions mdl-card--border">
                          <div class="mdl-grid">
                              <button type="submit" class="mdl-cell mdl-cell--12-col mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
                                  Login
                              </button>

                          </div>

                          <div class="mdl-grid">
                              <div class="mdl-cell mdl-cell--12-col">
                                  <a onClick='flip("show-left")' class="mdl-color-text--primary">Sign up!</a>
                                  <a onClick='flip("show-bottom")' class="mdl-color-text--primary" style="float: right">Lost
                                      Password?</a>
                              </div>
                          </div>
                      </div>
                    </form>

                </div>
            </figure>
            <figure class="left">
                <div class="mdl-card mdl-shadow--6dp">
                    <div class="mdl-card__title mdl-color--primary mdl-color-text--white relative">
                        <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"
                           onClick='flip("show-front")'>
                            <i class="material-icons">arrow_back</i>
                        </a>
                        <h2 class="mdl-card__title-text">Sign up</h2>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                      {{ csrf_field() }}
                      <div class="mdl-card__supporting-text">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" id="name" name="name"/>
                              <label class="mdl-textfield__label" for="name">Name</label>
                          </div>
                           <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" id="email" name="email"/>
                              <label class="mdl-textfield__label" for="email">Email</label>
                          </div>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                              <label class="mdl-textfield__label" for="password">Password</label>
                          </div>
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" type="password" id="password_confirmation" name="password_confirmation"/>
                              <label class="mdl-textfield__label" for="password_confirmation">Password repeat</label>
                          </div>
                      </div>

                      <div class="mdl-card__actions mdl-card--border">
                          <div class="mdl-grid">
                              <button class="mdl-cell mdl-cell--12-col mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
                                  Sign up
                              </button>
                          </div>
                      </div>
                    </form>
                </div>

            </figure>
            <figure class="bottom">
                <div class="mdl-card mdl-shadow--6dp">
                    <div class="mdl-card__title mdl-color--primary mdl-color-text--white relative">
                        <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"
                           onClick='flip("show-front")'>
                            <i class="material-icons">arrow_back</i>
                        </a>
                        <h2 class="mdl-card__title-text">Lost Password</h2>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                    <div class="mdl-card__supporting-text">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="email" id="email" name="email" />
                            <label class="mdl-textfield__label" for="email">E-Mail</label>
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-grid">
                            <button class="mdl-cell mdl-cell--12-col mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
                                Reset Password
                            </button>
                        </div>
                    </div>
                    </form>

                </div>
            </figure>
        </div>
    </section>
</div>


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <script type="text/javascript">
        window.flip = function(flip) {
         $('#cube').removeClass();
         $('#cube').addClass(flip);
        }
    </script>
</body>
</html>




<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
