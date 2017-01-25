@extends('layouts.dashboardv3')

@section('event', 'class="active"')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Event Details:</strong>
        <div class="pull-right dropdown">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-gear fa-fw"></i>Options <span class="caret"></span>
          </button>
          <ul class="dropdown-menu ">
            <li><a href="{{ URL::to('updateEvent/' . Crypt::encrypt($event->id)) }}">Edit Task</a></li>
            <li><a href="{{ url('#') }}" onclick="myFunction(event)">Delete Task</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/event') }}">Return to My Events</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body">
        <h3>{{ $event->event_title}}</h3>
        <div>
          <table class="table">
            <tbody>
              <tr>
                <td>Event Description:</td>
                <td><strong>{{ $event->event_description }}</strong></td>
              </tr>
              <tr>
                <td>Location:</td>
                <td><strong>{{ $event->location }}</strong></td>
              </tr>
              <tr>
                <td>Time Start:</td>
                <td><strong>{{ Carbon\Carbon::parse($event->time_start)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
              <tr>
                <td>Time End:</td>
                <td><strong>{{ Carbon\Carbon::parse($event->time_end)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
