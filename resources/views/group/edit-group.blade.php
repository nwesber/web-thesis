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

  <div class="clearTop"></div>
    <a href="{{ url('group/' . $group->id) }}"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Back">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <br>

<h1>Rename Group</h1>
  <div class = "container">
    <div class = "row">
      <div class = "form-group">
        {!! Form::open(array('action' => array('GroupController@updateGroup', $group->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
          <ul>
            <li>
              <h4>
              <input type ="text" class="form-control" name="groupName" value="{{ $group->group_name }}">
              <input type="submit" value="Save Group Name" class = "btn btn-info pull-right form-control">
              <a href="{{ url('/group/' . $group->id) }}"><input type="button"  class="btn btn-primary pull-right form-control" value="Cancel"></a>
              </h4>
            </li>
          </ul>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

@endsection
