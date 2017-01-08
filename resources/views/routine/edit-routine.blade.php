@extends('layouts.dashboardv2')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"></h1>
  </div>

  <div class="col-lg-12">
    @if( Session::has('message') )
      <div class="alert alert-warning fade in" role="alert" align="center">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>{{ Session::get('message') }}</strong>
    @endif
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bicycle fa-fw"></i> <strong>Rename Routine</strong>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
       		{!! Form::open(array('action' => array('RoutineController@updateRoutine', $routine->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
          <div class="col-md-12">
            <p id="oldRoutine" name="oldRoutine"><strong>Old Routine Name: </strong>{{ $routine->routine_name }}</p>
          </div>
          <div class="col-md-12 form-group{{ $errors->has('routineName') ? ' has-error' : '' }}">
            <label for="routineName">New Routine Name <span>*</span></label>
            <input type="text" id="routineName" class="form-control" name="routineName" value="{{ $routine->routine_name }}" required>
              @if($errors->has('routineName'))
                <span class="help-block">
                  <strong class="danger">{{ $errors->first('routineName') }}</strong>
                </span>
              @endif
          </div>

          <div class="col-md-12">
          	<a href="{{ url('/routine') }}">
              <button class="btn btn-default">Back</button>
            </a>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

          {!! Form::close() !!}

      </div>
      <!-- /.panel-body -->
    </div>
  </div>

</div>
@endsection
