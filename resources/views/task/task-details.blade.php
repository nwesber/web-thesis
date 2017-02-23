@extends('layouts.dashboardv3')

@section('class', 'class="active"')

@section('content')

@if( Session::has('message') )
  <div class="alert alert-success fade in" role="alert" align="center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('message') }}</strong>
  </div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>View Details:</strong>
        <div class="pull-right dropdown">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-gear fa-fw"></i>Options <span class="caret"></span>
          </button>
          <ul class="dropdown-menu ">
            <li><a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/task-details/'. Crypt::encrypt($task->id) . '/edit') }}">Edit Task</a></li>
            <li><a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/task-details/'. Crypt::encrypt($task->id) . '/delete') }}" onclick="myFunction(event)">Delete Task</a>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task') }}">Return to {{ $routine->routine_name}}</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body">
        <h3>{{$task->task_title}}</h3>
        <table class="table">
          <tr>
            <td>Task Description:</td>
            <td><strong>{{$task->task_description}}</strong></td>
          </tr>
          <tr>
            <td>Due Date:</td>
            <td><strong>{{ Carbon\Carbon::parse($task->due_date)->format('D, M-d-Y') }}</strong></td>
          </tr>
          <tr>
            <td>Priority:</td>
            <td><strong>{{ $task->priority }}</strong></td>
          </tr>
          <tr>
            <td>Time Start:</td>
            <td><strong>{{ \Carbon\Carbon::parse($task->time_start)->format('g:i A') }}</strong></td>
          </tr>
          <tr>
            <td>Progess:</td>
            @if($task->is_completed == 1)
              <td><strong>Completed</strong></td>
            @else
              <td><strong>In Progress</strong></td>
            @endif
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>


<script>
  function myFunction(e) {
    if (confirm('Are you sure you want to delete this task?')) {
    } else {
      e.preventDefault();
    }
  }
</script>
@endsection
