@extends('layouts.dashboardv2')


@section('content')

<div class="row">
  <!-- <div class="col-md-12 clearBottom">
    <div class="clearTop"></div>
    <div class="btn-group pull-right">
      <a href="{{ url('group/'. $group->id .'/shareEvent') }}"
         class="btn btn-primary"
         role="button">
         <i class="fa fa-share" aria-hidden="true"></i>&nbsp; &nbsp;Share An Event
      </a>
    </div> -->

  <div class="col-md-12 clearTop">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>{{ $group->group_name }} Events</strong>
        <div class="dropdown pull-right">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-gear fa-fw"></i> Group Settings <span class="caret"></span></button>
          <ul class="dropdown-menu" aria-labelby="dropdownMenu1">
            <li>
              <a href="{{ url('/group/'.$group->id. '/add-member') }}"><i class="fa fa-plus fa-fw"></i> Add Member</a>
            </li>
            <li>
              <a href="{{ url('/group/'.$group->id. '/view-member') }}"><i class="fa fa-users fa-fw"></i> View Member</a>
            </li>
            <li>
              <a href="{{ url('/group/'.$group->id. '/edit-group') }}"><i class="fa fa-edit fa-fw"></i> Rename Group</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ url('group/'. $group->id .'/shareEvent') }}"><i class="fa fa-share" aria-hidden="true"></i> Share An Event</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="{{ url('/group/'.$group->id. '/leave-group') }}"><i class="fa fa-sign-out fa-fw"></i> Leave Group</a>
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
