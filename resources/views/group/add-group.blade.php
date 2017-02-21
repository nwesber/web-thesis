@extends('layouts.dashboardv3')
@section('group', 'class="active"')
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
      <div class="panel-heading"><strong>New Group</strong>
      </div>
      <div class="panel-body">
        <div class = "form-group">
          {!! Form::open(array('action' => array('GroupController@storeGroup'), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
            <div class="col-md-12 form-group{{ $errors->has('groupName') ? ' has-error' : '' }}">
            <label for="groupName">Group Name</label>
            <input type="text" id="groupName" class="form-control" name="groupName" required placeholder="Legion of Doom">
              @if($errors->has('groupName'))
                  <span class="help-block">
                      <strong class="danger">{{ $errors->first('groupName') }}</strong>
                  </span>
              @endif
          </div>
          <div class="col-md-12">
            <a href="{{ url('/group') }}"><input type="button"  class="btn btn-default" value="Back"></a>
            <input type="submit" value="Save Group" class = "btn btn-primary">
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
