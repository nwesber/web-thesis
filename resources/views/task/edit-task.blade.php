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
		    Priority: 
         
          @if($task->priority == 'High')
            <input type="radio" name="taskPrio" value="Low" value="{{$task->priority}}" required="true"> Low
            <input type="radio" name="taskPrio" value="Medium" value="{{$task->priority}}" required="true"> Medium
            <input type="radio" name="taskPrio" value="High" value="{{$task->priority}}" required="true" checked> High 
          
          @elseif($task->priority == 'Medium')
            <input type="radio" name="taskPrio" value="Low" value="{{$task->priority}}" required="true"> Low
            <input type="radio" name="taskPrio" value="Medium" value="{{$task->priority}}" required="true" checked> Medium
            <input type="radio" name="taskPrio" value="High" value="{{$task->priority}}" required="true"> High 

          @elseif($task->priority == 'Low')
            <input type="radio" name="taskPrio" value="Low" value="{{$task->priority}}" required="true" checked> Low
            <input type="radio" name="taskPrio" value="Medium" value="{{$task->priority}}" required="true"> Medium
            <input type="radio" name="taskPrio" value="Low" value="{{$task->priority}}" required="true"> High
          
          @else
            <input type="radio" name="taskPrio" value="Low" value="{{$task->priority}}" required="true"> Low
            <input type="radio" name="taskPrio" value="Medium" value="{{$task->priority}}" required="true"> Medium
            <input type="radio" name="taskPrio" value="High" value="{{$task->priority}}" required="true"> High 
          
          @endif
          <br>
        <div id="showIt">
          Select Day:<br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Sunday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Sunday%')) { echo "checked='checked'";} ?>> Sunday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Monday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Monday%')) { echo "checked='checked'";} ?>> Monday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Tuesday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Tuesday%')) { echo "checked='checked'";} ?>> Tuesday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Wednesday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Wednesday%')) { echo "checked='checked'";} ?>> Wednesday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Thursday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Thursday%')) { echo "checked='checked'";} ?>> Thursday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Friday" <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Friday%')) { echo "checked='checked'";} ?>> Friday <br>
          <input type ="checkbox" name="taskDay[]" id="taskDay" class="task" value="Saturday"  <?php if(\DB::table('task')->where('$task->task_day', 'LIKE', '%Saturday%')) { echo "checked='checked'";} ?>> Saturday <br>
        </div>
		    Time Start: <input type="time" name="timeStart" value="{{ $task->time_start }}" class="form-control" required="true">	
        @if($task->taskDay == 'All Day')
        <input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday" <?php if(\DB::table('task')->where('$task->task_day', '!=', 'All Day')) { echo !"checked='checked'";} ?>> All Day 

        @else
        <input type ="checkbox" name="taskDay[]" id="allDay" value="Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday" <?php if(\DB::table('task')->where('$task->task_day', '=', 'All Day')) { echo "checked='checked'";} ?>> All Day  
        
        @endif
		    <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}"><input type="button" class="btn btn-primary pull-right" value="Cancel"></a>
		    <input type="submit" value="Save Task" class = "btn btn-info pull-right">
	    {!! Form::close() !!}
  </div>
</div>

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