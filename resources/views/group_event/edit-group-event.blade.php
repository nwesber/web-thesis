@extends('layouts.dashboardv3')

@section('group', 'class="active"')

@section('content')
{!! Form::model($groupEvent, ['method' => 'PATCH', 'action' => ['GroupEventController@updateGroupEvent', Crypt::encrypt($groupEvent->id)], 'id' => 'form1']) !!}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Update Event</strong>
        <div class="pull-right">
          <a href="{{ url('/group', Crypt::encrypt($groupEvent->id)) }}">
            <button class="btn btn-default btn-xs" type="button"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">
        {{ Form::hidden('oldStart', $groupEvent->time_start , array('id' => 'oldStart')) }}
        {{ Form::hidden('oldEnd', $groupEvent->time_end, array('id' => 'oldEnd')) }}
        <div class="form-group">
          <label for="eventTitle">Group Event Title:</label>
          <input type="text" name="eventTitle" class="form-control" required="true" value="{{ $groupEvent->event_title }}">
        </div>


        <div class="form-group row">
          <div class="col-md-6">
            <label for="eventStartDate">Date Start:</label>
            <p class="small">Previous:  <strong>{{ Carbon\Carbon::parse($groupEvent->time_start)->format('D, M-d-Y h:i A') }} </strong></p>
            <input type="datetime-local" name="eventStartDate" class="form-control" id="eventStartDate">
          </div>
           <div class="col-md-6">
            <label for="eventEndDate">Date End:</label>
            <p class="small">Previous:  <strong>{{ Carbon\Carbon::parse($groupEvent->time_end)->format('D, M-d-Y h:i A') }} </strong></p>
            <input type="datetime-local" name="eventEndDate" class="form-control" value="{{ $groupEvent->time_end }}">
          </div>
        </div>

        <h5 class="page-header">
          <strong>Group Event Details:</strong>
        </h5>
        <div class="form-group">
          <label for="eventDesc">Group Event Description:</label>
          <textarea class="form-control" rows="4" id="eventDesc" name="eventDesc">{{ $groupEvent->event_description }}</textarea>
        </div>
        <div class="form-group">
          <label for="eventLocation">Group Event Location:</label>
          <input type="text" name="eventLocation" id="eventLocation" class="form-control" required="true" value="{{ $groupEvent->location }}">
        </div>
         <div class="form-group">
          <label for="chooseColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control" required="true" value="{{ $groupEvent->color }}">
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
