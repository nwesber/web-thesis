@extends('layouts.dashboard')

@section('content')

<h1>Add Task</h1>
<div class = "container">
	<div class = "row">
	  <div class = "form-group">
		  	 {!! Form::open(array('action' => array('TaskController@storeTask', $routine->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
			    Task Name: <input type = "text" name = "taskTitle" class = "form-control" required="true"><br>
			    Task Description: <input type = "text" name = "taskDesc" class = "form-control" required="true"><br>
			    Due Date: <input type="date" name="taskDue" class="form-control" value="<?php echo date("Y-m-d");?>" required="true"><br>
			    Priority: <br>
			    <input type="radio" name="taskPrio" value="Low" required="true"> Low<br>
			    <input type="radio" name="taskPrio" value="Medium" required="true"> Medium<br>
			    <input type="radio" name="taskPrio" value="High" required="true"> High<br>
			    <div id="showIt">
			    Select Day:<br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Sunday"> Sunday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Monday"> Monday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Tuesday"> Tuesday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Wednesday"> Wednesday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Thursday"> Thursday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Friday"> Friday <br>
			    <input type ="checkbox" name="taskDay[]" id="taskDay" value="Saturday"> Saturday <br>
			    </div>
			    Time Start: <input type="time" name="timeStart" class="form-control"><br>
			    <input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday"> All Day
			    <hr/>
			    	<input type="submit" value="Add Task" class = "btn btn-info pull-right form-control">
			    	<a href="{{ url('/routine/'.$routine->id.'/task') }}"><input type="button"  class="btn btn-primary pull-right form-control" value="Cancel"></a>
		    {!! Form::close() !!}
	  </div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#allDay').on('click', function(){
			if(document.getElementById('allDay').checked) {
			    $("#showIt").hide();
			} else {
			    $("#showIt").show();
			}
		});
	});
</script>
@endsection


