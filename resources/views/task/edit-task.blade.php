@extends('layouts.dashboardv3')

@section('class', 'class="active"')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
    @if( Session::has('message') )
        <div class="alert alert-danger fade in" role="alert" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
    </div>
  </div>
  <div class="col-md-12">
    {!! Form::model($task, ['method' => 'POST', 'action' => array('TaskController@updateTask', Crypt::encrypt($routine->id), Crypt::encrypt($task->id)), 'id' => 'form1', 'class' => 'form-vertical'])   !!}
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Edit Task</strong>
        <div class="pull-right">
          <a href="{{ url('routine/'.Crypt::encrypt($routine->id).'/task/task-details/'.Crypt::encrypt($task->id)) }}">
            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="taskTitle">*Task Name:</label>
           <input type="text" value="{{$task->task_title}}" name="taskTitle" class = "form-control" required="true">
        </div>
        <div class="form-group">
          <label for="taskDesc">Task Description:</label>
          <textarea class="form-control" rows="4" id="taskDesc" name="taskDesc">{{$task->task_description}}</textarea>
        </div>
        <div class="form-group">
          <label for="taskDue">Due Date:</label>
           <input type="date" value="{{$task->due_date}}" name="taskDue" class = "form-control" required="true">
        </div>
        <div class="form-group">
          <label for="taskPrio">Priority:</label><br>
          <div class="form-group">
            <select class="form-control" id="taskPrio" name="taskPrio">
              <option value="{{$task->priority}}" name="taskPrio" selected="" hidden="">{{$task->priority}}</option>
              <option value="Low" name="taskPrio">Low</option>
              <option value="Medium" name="taskPrio">Medium</option>
              <option value="High" name="taskPrio">High</option>
            </select>
          </div>
        </div>
        <div class="form-group bootstrap-timepicker timepicker">
          <label for="timeStart">Time Start:</label>
            <input type="time" name="timeStart" value="{{ $task->time_start }}" class="form-control" required="true">
        </div>
        <div class="form-group">
          <label for="Task Day">Task Day/s:</label>
            @if($task->task_day == 'All Day')
              <div class="form-group">
                <input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday" checked> All Week
              </div>
            @elseif($task->task_day != 'All Day')
              <div class="form-group">
                <input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday" unchecked> All Week
              </div>
            @endif
            <div id="showIt" class="form-group">
              <strong>Currently Selected Day/s:</strong> <input type="text" name="oldTaskDay" value="{{ $task->task_day }}" hidden="">({{ $task->task_day }})
            </div>
            
        </div>
        <div id="showIt2" class="form-group">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><strong> Select Day/s:</strong></div>
                  <div class="panel-body">
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Sunday"> Sunday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Monday"> Monday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Tuesday"> Tuesday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Wednesday"> Wednesday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Thursday"> Thursday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Friday"> Friday <br>
                    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Saturday"> Saturday <br>
                  </div>
                </div>
              </div>
            </div>
        <input type="submit" value="Save" class = "btn btn-primary pull-right">
      </div>
    </div>

    {!! Form::close() !!}
  </div>

</div>


<script>
  $(document).ready(function(){
      if(document.getElementById('allDay').checked) {
          $("#showIt").hide();
          $("#showIt2").hide();
      } else {
          $("#showIt").show();
          $("#showIt2").show();
      }
       $('#allDay').on('click', function(){
      if(document.getElementById('allDay').checked) {
          $("#showIt").hide();
          $("#showIt2").hide();
      } else {
          $("#showIt").show();
          $("#showIt2").show();
          $('.task').prop('checked',false);
      }
    });
  });
</script>

@endsection
