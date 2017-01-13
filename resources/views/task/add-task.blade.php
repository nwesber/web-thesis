@extends('layouts.dashboardv2')

@section('content')



<div class="row">
	<div class="col-lg-12">
	  <p class="page-header">
			<ol class="breadcrumb">
			  <li><a href="{{ url('/routine') }}">Home</a></li>
			  <li><a href="{{ url('/routine/'.$routine->id.'/task') }}"> {{ $routine->routine_name}}</a></li>
			  <li class="active">New Task</li>
			</ol>
		</p>
	</div>

	<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>New Task</strong>

      </div>
      <!-- /.panel-heading -->
      {!! Form::open(array('action' => array('TaskController@storeTask', $routine->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
      <div class="panel-body">

      	<div class="form-group">
			    <label for="taskTitle">Task Name:</label>
			    <input type="text" name="taskTitle" class="form-control" required="true" placeholder="Unititled Task">
			  </div>
			  <div class="form-group">
			  	<input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday"> All Day
			  </div>

			  <div class="panel panel-default">
			  	<div class="panel-heading"> <strong>Task Details</strong></div>
			  	<div class="panel-body">
					  <div class="form-group">
						  <label for="taskDesc">Task Description:</label>
						  <textarea class="form-control" rows="4" id="taskDesc" name="taskDesc"></textarea>
						</div>
						<div class="form-group col-md-4">
						  <label for="taskDue">Due Date:</label>
						  <input type="date" name="taskDue" class="form-control" value="<?php echo date("Y-m-d");?>" required="true">
						</div>
						<div class="form-group col-md-4">
						  <label for="timeStart">Time Start:</label>
						  <input type="time" name="timeStart" class="form-control" required="true">
						</div>
						<div class="form-group col-md-4">
						  <label for="taskPrio">Priority:</label><br>
						  <div class="form-group">
							  <select class="form-control" id="taskPrio" name="taskPrio">
							    <option value="Low">Low</option>
							    <option value="Medium">Medium</option>
							    <option value="High">High</option>
							  </select>
							</div>
						</div>
						<div id="showIt" class="form-group">
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
			  	</div>
			  </div>
			  <div class="col-md-12">
			  	<div class="pull-right">
			  		<a href="{{ url('/') }}">
          		<button class="btn btn-default btn-md"></i> Back</button>
       		  </a>
       		  <input type="submit" value="Add Task" class="btn btn-primary">
			  	</div>

			  </div>
      </div>
      <!-- /.panel-body -->
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


