@extends('layouts.dashboardv2')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="clearTop"></div>
    @if( Session::has('message') )
      <div class="alert alert-success fade in" role="alert" align="center">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>{{ Session::get('message') }}</strong>
      </div>
    @endif
  <div class="col-md-12">
    <div class="clearTop"></div>
    <a href="{{ url('routine/'.$routine->id.'/task') }}"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Back">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <div class="btn-group pull-right">
      <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id. '/edit') }}"
         class="btn btn-warning"
         role="button"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Edit">
         <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id. '/delete') }}"
         class="btn btn-danger"
         role="button"
         onclick="myFunction(event)"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Delete">
         <i class="fa fa-trash-o" aria-hidden="true"></i>
      </a>
    </div>
  </div>
    <div class="col-lg-12">
      <h3 class="page-header">
        {{$task->task_title}}
      </h3>
      <div class="panel panel-default">

        <table class="table table-striped">
          <tbody>
            <tr>
              <td><strong>Task Description:</strong> </td>
            </tr>
            <tr>
              <td>{{$task->task_description}}</td>
            </tr>
            <tr>
              <td><strong>Due Date:</strong></td>
            </tr>
            <tr>
              <td>{{ $task->due_date }}</td>
            </tr>
            <tr>
              <td><strong>Priority:</strong></td>
            </tr>
             <tr>
              <td>{{ $task->priority }}</td>
            </tr>
             <tr>
              <td><strong>Time Start:</strong></td>
            </tr>
             <tr>
              <td>{{ \Carbon\Carbon::parse($task->time_start)->format('g:i A') }} </td>
            </tr>
            <tr>
              <td><strong>Progress:</strong></td>
            </tr>
            <tr>
              @if($task->is_completed == 1)
                <td>Completed</td>
              @else
                <td>In Progress</td>
              @endif
            </tr>
          </tbody>
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
