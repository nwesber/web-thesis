@extends('layouts.dashboardv2')

@section('content')

<!-- <div class="row">
  <div class="col-lg-12">
    @if( Session::has('message') )
        <div class="alert alert-success fade in" role="alert" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
</div>

<h1>Edit Task</h1>
<div class = "container">
  <div class = "form-group">
  {!! Form::model($task, ['method' => 'POST', 'action' => array('TaskController@updateTask', $routine->id, $task->id), 'id' => 'form1', 'class' => 'form-vertical'])   !!}
		    Task Title: <input type="text" value="{{$task->task_title}}" name="taskTitle" class = "form-control" required="true">
		    Task Description: <input type="text" value="{{$task->task_description}}" name="taskDesc" class = "form-control" required="true">
		    Due Date: <input type="date" value="{{$task->due_date}}" name="taskDue" class = "form-control" required="true">
		    Priority: <input type="text" value="{{$task->priority}}" name="taskPrio" class = "form-control" required="true">
		    Task Day: <input type="text" value="{{$task->task_day}}" name="taskDay" class = "form-control" required="true">
		    Time Start: <input type="time" name="timeStart" value="{{ $task->time_start }}" class="form-control" required="true">

		    <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}"><input type="button" class="btn btn-primary pull-right" value="Back"></a>
		    <input type="submit" value="Save" class = "btn btn-info pull-right">
	    {!! Form::close() !!}
  </div>
</div> -->


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

    <p class="page-header">
      <ol class="breadcrumb">
        <li><a href="{{ url('/routine') }}">Home</a></li>
        <li><a href="{{ url('/routine/'.$routine->id.'/task') }}"> {{ $routine->routine_name}}</a></li>
        <li><a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li>
        <li class="active">Edit Task</li>
      </ol>
    </p>
  </div>
  <div class="col-md-12">
    {!! Form::model($task, ['method' => 'POST', 'action' => array('TaskController@updateTask', $routine->id, $task->id), 'id' => 'form1', 'class' => 'form-vertical'])   !!}
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Edit Task</strong></div>
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
        <input type="submit" value="Save" class = "btn btn-info pull-right">
      </div>
    </div>

    {!! Form::close() !!}
  </div>

</div>
@endsection
