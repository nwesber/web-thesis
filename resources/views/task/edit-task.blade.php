@extends('layouts.dashboard')

@section('content')

<div class="row">
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
		    Due Date: <input type="text" value="{{$task->due_date}}" name="taskDue" class = "form-control" required="true">
		    Priority: <input type="text" value="{{$task->priority}}" name="taskPrio" class = "form-control" required="true"> 
		    Task Day: <input type="text" value="{{$task->task_day}}" name="taskDay" class = "form-control" required="true">
		    Time Start: <input type="time" name="timeStart" value="{{ $task->time_start }}" class="form-control" required="true">	

		    <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}"><input type="button" class="btn btn-primary pull-right" value="Back"></a>
		    <input type="submit" value="Save" class = "btn btn-info pull-right">
	    {!! Form::close() !!}
  </div>
</div>

@endsection