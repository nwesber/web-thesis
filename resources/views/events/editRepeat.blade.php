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
      <strong style="color: red;"><i><small>* required fields</small></i></strong>
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
              <input type="date" name="eventStartDate" class="form-control" id="eventStartDate" onchange = "dynamicModal()" required="required">
            </div>
             <div class="col-md-6">
              <label for="eventEndDate">*Date End:</label>
              <input type="date" name="eventEndDate" id="eventEndDate" class="form-control" required="required">
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
        <div class="form-group row" style="margin-bottom: 0px;">
          <div class="col-md-1">
            <div class="checkbox">
              <label><input type="checkbox" id="chkRepeat" name="chkRepeat" value="repeatEvent" onchange="removeText()"><strong>Repeat</strong></label>
            </div>
          </div>
        </div>

        <div>
          <p><strong><small><i id="repeatText"></i></small></strong></p>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Repeating Event Details</h4>
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
        <div>
          <label for="modalStart">Starts On:</label>
          <input type="date" name="modalStart" id="modalStart" class="form-control" disabled="true">
        </div>

        <div class="clearTop">
          <label for="modalStart">Ends On:</label>
          <div class="radio" id="radioNever">
            <label>
              <input type="radio" name="endsOn" id="never" value="never" onchange="dynamicModal()"/>Never
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="endsOn" id="on" value="endsOn" onchange="dynamicModal()">On <input type="date" name="modalEnd" id="modalEnd" disabled="true"  onchange = "dynamicModal()"/>
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

<script type="text/javascript">
function removeText(){
  if(document.getElementById('chkRepeat').checked == false){
    document.getElementById("repeatText").textContent = "";
    document.getElementById("never").checked = false;
    document.getElementById("on").checked = false;
  }
}
</script>
<script>
$(document).ready(function(){
    $('#chkRepeat').on('click', function(){
      if(document.getElementById('chkRepeat').checked == false) {
        document.getElementById('eventEndDate').readOnly = false;
      }
    });
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
    var modalEnd = document.getElementById("modalEnd").value;
    modalStart.value = startDate;

    if(option == 'week'){
      $("#radioNever").hide();
    }else{
      $("#radioNever").show();
    }

    if(document.getElementById('on').checked) {
      document.getElementById("modalEnd").disabled = false;
      document.getElementById("repeatText").textContent = "Repeat every " +  option + " until " + modalEnd;
    }else if(document.getElementById('never').checked){
      document.getElementById("modalEnd").disabled = true;
      document.getElementById("repeatText").textContent = "Repeat every " +  option;
    }
  }
</script>
@endsection
