@extends('layouts.dashboardv3')

@section('class', 'class="active"')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
    @if( Session::has('message') )
        <div class="alert alert-success fade in" role="alert" align="center">
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
          <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">
            <button class="btn btn-default btn-xs"><i class="fa fa-arrow-left fa-fw" aria-hidden="true"></i> Back</button>
          </a>
        </div>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="taskTitle">Task Name:</label>
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
          <label for="taskPrio">Priority:</label>
           <input type="text" value="{{$task->priority}}" name="taskPrio" class = "form-control" required="true">
        </div>
        <div class="form-group">
          <label for="Task Day">Task Day/s:</label>
            <input type="text" value="{{$task->task_day}}" name="taskDay" class = "form-control" required="true">
        </div>
        <div class="form-group">
          <label for="timeStart">Time Start:</label>
            <input type="time" name="timeStart" value="{{ $task->time_start }}" class="form-control" required="true">
        </div>
        <input type="submit" value="Save" class = "btn btn-primary pull-right">
      </div>
    </div>

    {!! Form::close() !!}
  </div>

</div>
@endsection

<script>
  $(document).ready(function(){
      if(document.getElementById('allDay').checked) {
          $("#showIt").hide();
      } else {
          $("#showIt").show();
      }
       $('#allDay').on('click', function(){
      if(document.getElementById('allDay').checked) {
          $("#showIt").hide();
      } else {
          $("#showIt").show();
          $('.task').prop('checked',false);
      }
    });
  });
</script>

@endsection
>>>>>>> groupcrud
