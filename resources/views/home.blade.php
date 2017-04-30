@extends('layouts.dashboardv3')

@section('home', 'class="active"')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center" style="border: none;"><strong>
       @if( $greet == 'Good Morning' || $greet == 'Good Afternoon') 
          <i class="fa fa-sun-o" aria-hidden="true">
       @else
          <i class="fa fa-moon-o" aria-hidden="true">
       @endif
      </i> {{ $greet }} {{ Auth::user()->name }}!</strong></div>
    </div>

    <div class="panel panel-default">
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
