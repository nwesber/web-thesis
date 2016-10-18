@extends('layouts.dashboard')

@section('content')

<h1>Add Routine</h1>
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
</div>


@endsection







