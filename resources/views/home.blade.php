@extends('layouts.dashboardv3')

@section('home', 'class="active"')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">

   	<div class="panel-heading text-center"><strong>{{ $greet }} {{ Auth::user()->name }}!</strong></div>

      <div class="panel-heading"><strong>Upcoming Events</strong>
      </div>
      <div class="panel-body">
        {!! $calendar->calendar() !!}
      </div>
    </div>
  </div>
</div>

{!! $calendar->script() !!}

@endsection
