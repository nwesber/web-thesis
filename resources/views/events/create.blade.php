@extends('layouts.dashboardv3')

@section('event', 'class="active"')

@section('content')
{!!Form::open(array('url' => '/createEvent')) !!}
<div class="row">
  <div class="col-md-12">
    @include('errors.errors')
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
          <input type="text" name="eventTitle" class="form-control" placeholder="Unititled Event" >
        </div>

        <h5 class="clearTop">
          <strong>Event Details:</strong>
          <hr>
        </h5>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="eventStartDate">Date Start:</label>
            <input type="date" name="eventStartDate" class="form-control" id="eventStartDate" onchange = "dynamicModal()">
          </div>
           <div class="col-md-6">
            <label for="eventEndDate">Date End:</label>
            <input type="date" name="eventEndDate" class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="eventTimeStart">Time Start:</label>
            <input type="time" name="eventTimeStart" class="form-control" id="eventTimeStart">
          </div>
           <div class="col-md-6">
            <label for="eventTimeEnd">Time End:</label>
            <input type="time" name="eventTimeEnd" class="form-control" id="eventTimeEnd">
          </div>
        </div>

        <div class="form-group">
          <label for="eventDesc">Event Description:</label>
          <textarea class="form-control" rows="4" id="eventDesc" name="eventDesc"></textarea>
        </div>
        <div class="form-group">
          <label for="eventLocation">Location:</label>
          <input type="text" name="eventLocation" id="eventLocation" class="form-control">
        </div>

        <div class="form-group row">
          <div class="col-md-1">
            <div class="checkbox">
              <label><input type="checkbox" id="chkRepeat" name="chkRepeat" value="repeatEvent"><strong>Repeat</strong></label>
            </div>
          </div>
           <div class="col-sm-2">
            <div class="checkbox">
              <label><input type="checkbox" id="allDay" name="allDay" ><strong>All Day</strong></label>
            </div>
          </div>
        </div>
        <p id="summary"></p>
        <div class="form-group">
          <label for="eventColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control">
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label for="sel1">Repeats:</label>
          <select class="form-control" id="repeat" onchange = "dynamicModal()" name="repeat">
            <option value="year">Yearly</option>
            <option value="month">Monthly</option>
            <option value="week">Weekly</option>
          </select>
        </div>

        <div class="form-group clearBottom" style="overflow-x:auto; display: none;" id="weeks">
          <p><strong>Repeat On:</strong></p>
          <select class="form-control" id="weeklyRepeat" onchange = "dynamicModal()" name="weeklyRepeat">
            <option value="0">Every Sunday</option>
            <option value="1">Every Monday</option>
            <option value="2">Every Tuesday</option>
            <option value="3">Every Wednesday</option>
            <option value="4">Every Thursday</option>
            <option value="5">Every Friday</option>
            <option value="6">Every Saturday</option>
          </select>
        </div>

        <div>
          <label for="modalStart">Starts On:</label>
          <input type="date" name="modalStart" id="modalStart" class="form-control" disabled="true">
        </div>

        <div class="clearTop">
          <label for="modalStart">Ends On:</label>
          <div class="radio">
            <label>
              <input type="radio" name="endsOn" id="never" value="never" checked='checked' onchange="dynamicModal()"/>Never
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="endsOn" id="on" value="endsOn" onchange="dynamicModal()">On <input type="date" name="modalEnd" id="modalEnd" disabled="true" />
            </label>
          </div>
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="exitRepeat()">Close</button>
      </div>
    </div>

  </div>
</div>


{!! Form::close() !!}
<script type="text/javascript">
  $('input[name="chkRepeat"]').on('change', function(e){
   if(e.target.checked){
     $('#myModal').modal();
   }
});

</script>


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

<script type="text/javascript">
  function exitRepeat(){
    document.getElementById("chkRepeat").checked = false;
  }
  function dynamicModal(){
    var option = document.getElementById("repeat").value;
    var startDate = document.getElementById("eventStartDate").value;
    var occurrences = "";
    var modalStart = document.getElementById("modalStart");

    modalStart.value = startDate;

    if(document.getElementById('on').checked) {
      document.getElementById("modalEnd").disabled = false;
    }else if(document.getElementById('never').checked){
      document.getElementById("modalEnd").disabled = true;
    }

    if(option == 'week'){
      $("#weeks").show();
    }else if(option == 'month'){
      $("#weeks").hide();
    }else if(option == 'year'){
      $("#weeks").hide();
    }


  }

</script>
@endsection
