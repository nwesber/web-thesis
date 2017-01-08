@extends('layouts.dashboardv2')


@section('content')

<div class="row">
  <div class="col-md-12 clearBottom">
    <div class="clearTop"></div>
    <div class="btn-group pull-right">
      <a href="javascript:void(0);"
         class="btn btn-primary"
         role="button">
         <i class="fa fa-plus" aria-hidden="true"></i>&nbsp; &nbsp;Add Event
      </a>
    </div>
  </div>
  <div class="clearTop"></div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>My Events</strong></div>
      <div class="panel-body">
        {!! $calendar->calendar() !!}
      </div>
    </div>
  </div>
</div>

{!! $calendar->script() !!}

@endsection
