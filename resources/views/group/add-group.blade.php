@extends('layouts.dashboardv3')
@section('group', 'class="active"')
@section('content')

<h1>Add Group</h1>

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
  	{!! Form::open(array('action' => array('GroupController@storeGroup'), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
	  	<div class="col-md-12 form-group{{ $errors->has('groupName') ? ' has-error' : '' }}">
	    <label for="groupName">* Group Name</label>
	    <input type="text" id="groupName" class="form-control" name="groupName" required>
		    @if($errors->has('groupName'))
		        <span class="help-block">
		            <strong class="danger">{{ $errors->first('groupName') }}</strong>
		        </span>
		    @endif
		</div>
  	<input type="submit" value="Create Group" class = "btn btn-info pull-right">
    <a href="{{ url('/group') }}"><input type="button"  class="btn btn-primary pull-right" value="Back"></a>
  	{!! Form::close() !!}
  </div>
</div>
@endsection
