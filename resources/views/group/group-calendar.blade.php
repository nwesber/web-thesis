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

  <div class="col-md-12 clearBottom">
    <div class="clearTop"></div>
      <div class="btn-group pull-right">
        <ul class="nav navbar-top-links navbar-right">
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-gear fa-fw"></i> Group Settings <i class="fa fa-caret-down"></i>
            </a>
             <ul class="dropdown-menu dropdown-user">
              <li>
                <a href="{{ url('/group/'.$group->id. '/add-member') }}"><i class="fa fa-plus fa-fw"></i> Add Member</a>
              </li>
              <li>
                <a href="{{ url('/group/'.$group->id. '/view-member') }}"><i class="fa fa-users fa-fw"></i> View Member</a>
              </li>
              <li class="divider"></li>
              <li>
                 <a href="{{ url('group/'. $group->id .'/shareEvent') }}">
                  <i class="fa fa-share" aria-hidden="true"></i> Share An Event
                 </a>
               </li>
              <li class="divider"></li>
              <li>
                <a href="{{ url('/group/'.$group->id. '/leave-group') }}"><i class="fa fa-sign-out fa-fw"></i> Leave Group</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
  </div>
  <div class="clearTop"></div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>My Group Events</strong></div>
      <div class="panel-body">
        {!! $calendar->calendar() !!}
      </div>
    </div>
  </div>
</div>

{!! $calendar->script() !!}

@endsection
