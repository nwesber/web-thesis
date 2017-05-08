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
        <strong style="color: red;"><i><small>* required fields</small></i></strong>
        <div class="form-group clearTop">
          <label for="eventTitle">*Event Title:</label>
          <input type="text" name="eventTitle" class="form-control" placeholder="Unititled Event" >
        </div>

        <h5 class="clearTop">
          <strong>Event Details:</strong>
          <hr>
        </h5>

        <div class="form-group row">
          <div class="col-md-6" >
            <label for="eventStartDate">*Date Start:</label>
            <input type="date" name="eventStartDate" class="form-control" id="eventStartDate" onchange = "dynamicModal()">
          </div>
           <div class="col-md-6">
            <label for="eventEndDate">*Date End:</label>
            <input type="date" name="eventEndDate" id="eventEndDate" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-6 bootstrap-timepicker timepicker">
            <label for="eventTimeStart">Time Start:</label>
            <input type="text" name="eventTimeStart" class="form-control" id="eventTimeStart">
          </div>
           <div class="col-md-6 bootstrap-timepicker timepicker">
            <label for="eventTimeEnd">Time End:</label>
            <input type="text" name="eventTimeEnd" class="form-control" id="eventTimeEnd">
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

        <div class="form-group row" style="margin-bottom: 0px;">
          <div class="col-md-1">
            <div class="checkbox">
              <label><input type="checkbox" id="chkRepeat" name="chkRepeat" value="repeatEvent" onclick="removeText()"><strong>Repeat</strong></label>
            </div>
          </div>
        </div>

        <div>
          <p><strong><small><i id="repeatText"></i></small></strong></p>
        </div>

        <div class="form-group">
          <label for="eventColor">Choose Color:</label>
          <input type="text" name="eventColor" id="showPaletteOnly" class="form-control">
        </div>
         <h5 class="clearTop">
          <strong>Visibility:</strong>
          <hr>
        </h5>
        <div class="radio">
          <label><input type="radio" name="shared" value="0" checked='checked'>Private</label>
        <div class="radio">
          <label><input type="radio" name="shared" value="1">Public</label>
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
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="exitRepeat()">Cancel</button>
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
    color: "MediumBlue ",
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
    document.getElementById("repeatText").textContent = "";
    document.getElementById("never").checked = false;
    document.getElementById("on").checked = false;
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
