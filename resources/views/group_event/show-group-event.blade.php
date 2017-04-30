@extends('layouts.dashboardv3')

@section('group', 'class="active"')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Group Event Details:</strong>
        <div class="pull-right dropdown">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-gear fa-fw"></i>Options <span class="caret"></span>
          </button>
          <ul class="dropdown-menu ">
            <li><a href="{{ URL::to('/group/editGroupEvent/' . Crypt::encrypt($groupEvent->id)) }}">Edit Event</a></li>
            <li><a href="{{ URL::to('/group/deleteGroupEvent/' . Crypt::encrypt($groupEvent->id)) }}" onclick="myFunction(event)">Delete Event</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/group/' . Crypt::encrypt($group->id)) }}">Return to My Group Events</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body">
        <h3>{{ $groupEvent->event_title}}</h3>
        <div>
          <table class="table">
            <tbody>
              <tr>
                <td>Group Event Description:</td>
                <td><strong>{{ $groupEvent->event_description }}</strong></td>
              </tr>
              <tr>
                <td>Group Event Location:</td>
                <td><strong>{{ $groupEvent->location }}</strong></td>
              </tr>
              <tr>
                <td>Time Start:</td>
                <td><strong>{{ Carbon\Carbon::parse($groupEvent->time_start)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
              <tr>
                <td>Time End:</td>
                <td><strong>{{ Carbon\Carbon::parse($groupEvent->time_end)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
                <tr>
                <td>Created By:</td>
                <td><strong>{{ $user->name }}</td>
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
