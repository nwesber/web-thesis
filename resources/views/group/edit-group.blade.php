@extends('layouts.dashboardv3')
@section('group', 'class="active"')
@section('content')



<div class="row">
  <div class="col-lg-12">
    @if( Session::has('message') )
        <div class="alert alert-success fade in" role="alert" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
  </div>

 <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <strong>Rename Group</strong>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        {!! Form::open(array('action' => array('GroupController@updateGroup', Crypt::encrypt($group->id)), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
          <div class="col-md-12">
            <p id="oldGroup" name="oldGroup"><strong>Old Group Name: </strong>{{ $group->group_name }}</p>
          </div>
          <div class="col-md-12 form-group{{ $errors->has('groupName') ? ' has-error' : '' }}">
            <label for="groupName">New Group Name <span>*</span></label>
            <input type="text" id="groupName" class="form-control" name="groupName" value="{{ $group->group_name }}" required>
              @if($errors->has('groupName'))
                <span class="help-block">
                  <strong class="danger">{{ $errors->first('groupName') }}</strong>
                </span>
              @endif
          </div>

          <div class="col-md-12">
            <a href="{{ URL::to('group/' . Crypt::encrypt($group->id)) }}">
              <button type="button" class="btn btn-default">Back</button>
            </a>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

          {!! Form::close() !!}

      </div>
      <!-- /.panel-body -->
    </div>
  </div>

@endsection
