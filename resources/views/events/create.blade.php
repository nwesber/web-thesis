@extends('layouts.dashboardv3')

@section('event', 'class="active"')

@section('content')
{!!Form::open(array('url' => '/createEvent')) !!}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Create Event</strong>
        <div class="pull-right">
          <a href="{{ url('/event') }}">
            <button class="btn btn-default btn-xs" type="button"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">

        <div class="form-group">
          <label for="eventTitle">Event Title:</label>
          <input type="text" name="eventTitle" class="form-control" required="true" placeholder="Unititled Event">
        </div>

        <div id="notFullDay">
          <div class="col-md-6">
            <div class="form-group">
              <label for="eventStartDate">Date Start:</label>
              <input type="datetime-local" name="eventStartDate" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eventEndDate">Date End:</label>
              <input type="datetime-local" name="eventEndDate" class="form-control">
            </div>
          </div>
        </div>

        <div id="isFullDay" class="hideDate">
          <div class="col-md-6">
            <div class="form-group">
              <label for="eventStartDate">Date Start:</label>
              <input type="date" name="eventStartDate" class="form-control" disabled="true">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="eventEndDate">Date End:</label>
              <input type="date" name="eventEndDate" class="form-control" disabled="true">
            </div>
          </div>
        </div>

        <!-- <div class="form-group">
          <input type ="checkbox" name="fullDay" id="fullDay" value="1"> All Day
        </div> -->
        <h5 class="page-header">
          <strong>Event Details:</strong>
        </h5>
        <div class="form-group">
          <label for="eventDesc">Event Description:</label>
          <textarea class="form-control" rows="4" id="eventDesc" name="eventDesc"></textarea>
        </div>
        <div class="form-group">
          <label for="eventLocation">Location:</label>
          <input type="text" name="eventLocation" id="eventLocation" class="form-control" required="true">
        </div>

        <div class="form-group">
          <label for="chooseColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control" required="true">
        </div>

        <div class="pull-right">
          <button type="reset" class="btn btn-default" value="Reset">Reset</button>
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
    color: "rgb(244, 204, 204)",
    showPaletteOnly: true,
    change: function(color) {
        printColor(color);
    },
    palette: [
      ['black', 'white', 'blanchedalmond',
      'rgb(255, 128, 0);', 'hsv 100 70 50'],
      ['red', 'yellow', 'green', 'blue', 'violet']
    ]
});

</script>

@endsection
