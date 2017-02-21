@extends('layouts.dashboardv3')

@section('content')
@if( Session::has('message') )
  <div class="alert alert-success fade in" role="alert" align="center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('message') }}</strong>
  </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Change Password</div>

             <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/postUpdatePassword') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="col-md-4 control-label">Current Password</label>

                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control" name="current_password" value="{{ old('password') }}" required>

                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <label for="new_password" class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password" required>

                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
