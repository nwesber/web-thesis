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
            <li><a href="{{ URL::to('updateRepeatEvent/' . Crypt::encrypt($event->id)) }}">Edit Event</a></li>
            <li><a href="{{ URL::to('deleteRepeatEvent/' . Crypt::encrypt($event->id))  }}" onclick="myFunction(event)">Delete Event</a></li>
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
              <tr>
                <td>Visibility:</td>
                @if($event->is_shared == 1)
                <td><strong>Public</strong></td>
                @else
                <td><strong>Private</strong></td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function myFunction(e) {
    if (confirm('Are you sure you want to delete this Event?')) {
    } else {
      e.preventDefault();
    }
  }
</script>
@endsection
