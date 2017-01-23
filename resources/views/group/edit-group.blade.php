@extends('layouts.dashboardv2')

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


<h1>Rename Group</h1>
<div class = "container">
  <div class = "row">
    <div class = "form-group">
      {!! Form::open(array('action' => array('GroupController@updateGroup', $group->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
        <ul>
          <li>
            <h4>
            <a href=" {{ url('/group/'.$group->id) }} ">{{ $group->group_name }}</a>
            <input type ="text" class="form-control" name="groupName" value="{{ $group->group_name }}">
            <input type="submit" value="Save Group" class = "btn btn-info pull-right form-control">
            <a href="{{ url('/group') }}"><input type="button"  class="btn btn-primary pull-right form-control" value="Cancel"></a>
            </h4>
          </li>
        </ul>
      {{ Form::close() }}
    </div>
  </div>
</div>

@endsection