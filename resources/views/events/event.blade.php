@extends('layouts.dashboardv2')


@section('content')

<div class="row">
  <div class="col-md-12 clearTop">
  </div>
  <div class="clearTop"></div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>My Events</strong>
        <div class="pull-right">
          <a href="{{ route('event.create') }}">
            <button class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add Event</button>
          </a>
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
