@extends('layouts.dashboardv3')

@section('event', 'class="active"')

@section('content')
{!! Form::model($event, ['method' => 'PATCH', 'action' => ['CalendarController@updateRepeatEvent', Crypt::encrypt($event->id)], 'id' => 'form1']) !!}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Update Event</strong>
        <div class="pull-right">
          <a href="{{ url('/repeatEvent', Crypt::encrypt($event->id)) }}">
            <button class="btn btn-default btn-xs" type="button"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">
        {{ Form::hidden('oldStart', $event->time_start , array('id' => 'oldStart')) }}
        {{ Form::hidden('oldEnd', $event->time_end, array('id' => 'oldEnd')) }}
        <div class="form-group">
          <label for="eventTitle">*Event Title:</label>
          <input type="text" name="eventTitle" class="form-control" required="true" value="{{ $event->event_title }}">
        </div>


        <div class="form-group row">
          <div class="col-md-6">
            <label for="eventStartDate">Current Date Start:</label>
            <p class="small"><strong>{{ Carbon\Carbon::parse($event->time_start)->format('D, M-d-Y h:i A') }} </strong></p>
          </div>
           <div class="col-md-6">
            <label for="eventEndDate">Current Date End:</label>
            <p class="small"><strong>{{ Carbon\Carbon::parse($event->time_end)->format('D, M-d-Y h:i A') }} </strong></p>
          </div>
          <div class="form-group">
            <div class="col-md-6" >
              <label for="eventStartDate">*Date Start:</label>
              <input type="date" name="eventStartDate" class="form-control" id="eventStartDate" onchange = "dynamicModal()">
            </div>
             <div class="col-md-6">
              <label for="eventEndDate">*Date End:</label>
              <input type="date" name="eventEndDate" id="eventEndDate" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 bootstrap-timepicker timepicker">
              <label for="eventTimeStart">Time Start:</label>
              <input type="text" name="eventTimeStart" class="form-control" id="eventTimeStart">
            </div>
             <div class="col-md-6 bootstrap-timepicker timepicker">
              <label for="eventTimeEnd">Time End:</label>
              <input type="text" name="eventTimeEnd" class="form-control" id="eventTimeEnd">
            </div>
          </div>
        </div>

        <h5 class="">
          <strong>Event Details:</strong>
          <hr/>
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
          <label for="eventColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control" value="{{ $event->color }}">
        </div>
        <h5 class="clearTop">
          <strong>Visibility:</strong>
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
