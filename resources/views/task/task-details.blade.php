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

<h1>Task Details</h1>
<div class = "container">
	<div class = "row">
		Task Title: {{$task->task_title}}<br>
		Task Description: {{$task->task_description}}<br>
		Due Date: {{ $task->due_date }}<br>
		Priority: {{ $task->priority }}<br>
		Time Start: {{ $task->time_start }}<br>
		
		@if($task->is_completed == 1)
		Progress: Completed
		@else
		Progress: In Progress
		@endif 
		<br>
		<br>
		<a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id. '/edit') }}"><input type="button" class="btn btn-warning" value="Edit"></a>
		<a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id. '/delete') }}"><input type="button" class="btn btn-danger" value="Delete"></a>
		<a href="{{ url('routine/'.$routine->id.'/task') }}"><input type="button" class="btn btn-primary" value="Back"></a>
	</div>
</div>

@endsection