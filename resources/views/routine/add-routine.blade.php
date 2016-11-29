@extends('layouts.dashboardv2')

@section('content')

<!-- <h1>Add Routine</h1>
<div class="row">
        <div class="col-lg-12">
    @if( Session::has('message') )
        <div class="alert alert-success fade in" role="alert" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
</div>
<div class = "container">
  <div class = "form-group">
  	{!! Form::open(array('action' => array('RoutineController@storeRoutine'), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
	  	<div class="col-md-12 form-group{{ $errors->has('routineName') ? ' has-error' : '' }}">
	    <label for="routineName">* Routine Name</label>
	    <input type="text" id="routineName" class="form-control" name="routineName" required>
		    @if($errors->has('routineName'))
		        <span class="help-block">
		            <strong class="danger">{{ $errors->first('routineName') }}</strong>
		        </span>
		    @endif
		</div>
  	<a href="{{ url('/routine') }}"><input type="button"  class="btn btn-primary pull-right" value="Back"></a>
  	<input type="submit" value="Add Routine" class = "btn btn-info pull-right">
  	{!! Form::close() !!}
  </div>
</div> -->


<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"></h1>
  </div>


  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bicycle fa-fw"></i> <strong>New Routine</strong>
        <div class="pull-right">
          <a href="#">
            <button class="btn btn-default btn-xs">Back</button>
          </a>
        </div>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">


      </div>
      <!-- /.panel-body -->
    </div>
  </div>

</div>


<div class="container">

  <div class="col-12">
    @if( Session::has('message') )
      <div class="alert alert-warning fade in full-width" role="alert" align="center">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>{{ Session::get('message') }}</strong>
    @endif
  </div>

  <div class="box">
    <div class="box-body">
      <div class="col-12">
        <h3 class="no-margin no-padding">Add Routine</h3>
      </div>
    </div>
  </div>

  <div class="box">
    <div class="box-body-gray">
      <div class="col-12 routineForm">
        <div clas="col-12">
          {!! Form::open(array('action' => array('RoutineController@storeRoutine'), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
          <div class="col-md-12 form-group{{ $errors->has('routineName') ? ' has-error' : '' }}">
            <label for="routineName">Routine Name <span class="color-red">*</span></label>
            <input type="text" id="routineName" class="full-width" name="routineName" placeholder="Diet in 30 Days" required>
              @if($errors->has('routineName'))
                <span class="help-block">
                  <strong class="danger">{{ $errors->first('routineName') }}</strong>
                </span>
              @endif
          </div>

          <div class="col-md-12 full-width no-padding">
            <div class="col-3 no-margin">
              <input type="submit" value="Submit" class = "btn btn-primary pull-right">
            </div>
            <div class="col-3 no-margin">
              <a href="{{ url('/routine') }}"><input type="button"  class="btn btn-default pull-right" value="Back"></a>
            </div>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

</div>
@endsection







