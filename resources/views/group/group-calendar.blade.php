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
      <div class="panel-heading"><strong>{{ $group->group_name }} Events</strong>
        <div class="dropdown pull-right">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-gear fa-fw"></i> Group Settings <span class="caret"></span></button>
          <ul class="dropdown-menu" aria-labelby="dropdownMenu1">
            <li>
              <a href="{{ url('/group/'. Crypt::encrypt($group->id). '/add-member') }}">Add Member/s</a>
            </li>
            <li>
              <a href="{{ url('/group/'. Crypt::encrypt($group->id). '/view-member') }}">View Member/s</a>
            </li>
            <li>
              <a href="{{ url('/group/'. Crypt::encrypt($group->id). '/edit-group') }}">Rename Group</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ url('/group/' . Crypt::encrypt($group->id) . '/create-event') }}"></i>New Event</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ url('/group/'. Crypt::encrypt($group->id). '/leave-group') }}"> Leave Group</a>
            </li>
          </ul>
        </div>

      </div>
      <div class="panel-body">
        {!! $calendar->calendar() !!}
      </div>
    </div>
  </div>
</div>

{!! $calendar->script() !!}

@endsection
