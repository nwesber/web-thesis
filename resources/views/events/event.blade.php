@extends('layouts.dashboardv2')


@section('content')

<div class="row">
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
