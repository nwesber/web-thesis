@extends('layouts.dashboardv3')

@section('event', 'class="active"')

@section('content')
{!! Form::model($event, ['method' => 'PATCH', 'action' => ['CalendarController@update', Crypt::encrypt($event->id)], 'id' => 'form1']) !!}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Update Event</strong>
        <div class="pull-right">
          <a href="{{ url('/event', Crypt::encrypt($event->id)) }}">
            <button class="btn btn-default btn-xs" type="button"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">
        {{ Form::hidden('oldStart', $event->time_start , array('id' => 'oldStart')) }}
        {{ Form::hidden('oldEnd', $event->time_end, array('id' => 'oldEnd')) }}
        <div class="form-group">
          <label for="eventTitle">Event Title:</label>
          <input type="text" name="eventTitle" class="form-control" required="true" value="{{ $event->event_title }}">
        </div>


        <div class="form-group row">
          <div class="col-md-6">
            <label for="eventStartDate">Date Start:</label>
            <p class="small">Previous:  <strong>{{ Carbon\Carbon::parse($event->time_start)->format('D, M-d-Y h:i A') }} </strong></p>
            <input type="datetime-local" name="eventStartDate" class="form-control" id="eventStartDate">
          </div>
           <div class="col-md-6">
            <label for="eventEndDate">Date End:</label>
            <p class="small">Previous:  <strong>{{ Carbon\Carbon::parse($event->time_end)->format('D, M-d-Y h:i A') }} </strong></p>
            <input type="datetime-local" name="eventEndDate" class="form-control" value="{{ $event->time_end }}">
          </div>
        </div>

        <h5 class="page-header">
          <strong>Event Details:</strong>
        </h5>
        <div class="form-group">
          <label for="eventDesc">Event Description:</label>
          <textarea class="form-control" rows="4" id="eventDesc" name="eventDesc">{{ $event->event_description }}</textarea>
        </div>
        <div class="form-group">
          <label for="eventLocation">Location:</label>
          <input type="text" name="eventLocation" id="eventLocation" class="form-control" required="true" value="{{ $event->location }}">
        </div>
         <div class="form-group">
          <label for="chooseColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control" required="true" value="{{ $event->color }}">
        </div>
        <h5 class="clearTop">
          <strong>Visibility</strong>
          <hr>
        </h5>
        <div class="radio">
          <label><input type="radio" name="shared" value="0" checked='checked'>Private</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="shared" value="1">Public</label>
        </div>
        <div class="pull-right">
          <button type="submit" class="btn btn-primary" value="Submit">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            &nbsp; &nbsp;Save Event
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">

$("#showPaletteOnly").spectrum({
    color: "CornflowerBlue ",
    showPaletteOnly: true,
    change: function(color) {
        printColor(color);
    },
    palette: [
      [
        'black',
        'Grey ',
        'DarkRed ',
        'red',
        'orange',
        'yellow',
        'green',
        'blue',
        'MediumBlue ',
        'indigo '
      ],

      [
        'white',
        'LightGrey',
        'brown',
        'pink',
        'orange',
        'Khaki',
        'GreenYellow ',
        'LightSkyBlue',
        'CornflowerBlue  ',
        'Plum  '
      ]
    ]
});

</script>
@endsection
