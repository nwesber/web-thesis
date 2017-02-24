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
      <div class="panel-heading"> <strong>{{ $routine->routine_name}}</strong>
        <div class="pull-right dropdown">
          <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-gear fa-fw"></i>Options <span class="caret"></span>
          </button>
          <ul class="dropdown-menu ">

            <li class="dropdown-header">Task</li>
            <li><a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/add-task/') }}">Create Task</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Routine Settings</li>
            <li><a href="{{ url('/routine/'. Crypt::encrypt($routine->id) . '/edit') }}">Edit Routine</a></li>
            <li><a href="{{ url('/routine/'. Crypt::encrypt($routine->id) . '/delete') }}" onclick="myFunction(event)">Delete Routine</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('/routine') }}">Return to All Routines</a></li>
          </ul>
        </div>
      </div>
      <div class="panel-body">



        <div class="col-md-12">
          <a href="#" class="nav-tabs-dropdown btn btn-block btn-primary">Tabs</a>
          <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-tabs-horizontal">
            <li class="active"><a data-toggle="tab" href="#sunday">Sunday</a></li>
            <li><a data-toggle="tab" href="#monday">Monday</a></li>
            <li><a data-toggle="tab" href="#tuesday">Tuesday</a></li>
            <li><a data-toggle="tab" href="#wednesday">Wednesday</a></li>
            <li><a data-toggle="tab" href="#thursday">Thursday</a></li>
            <li><a data-toggle="tab" href="#friday">Friday</a></li>
            <li><a data-toggle="tab" href="#saturday">Saturday</a></li>
          </ul>

          <div class="tab-content">
            <div id="sunday" class="tab-pane fade in active">
             <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>

                    <table class="table">
                      <tbody>
                       @forelse($taskDay1 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>

            <div id="monday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>

                    <table class="table">
                      <tbody>
                       @forelse($taskDay2 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
            <div id="tuesday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>
                  <table class="table">
                      <tbody>
                       @forelse($taskDay3 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id) .'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>

                  </div>
                </div>

              </div>
            </div>
            <div id="wednesday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>
                  <table class="table">
                      <tbody>
                       @forelse($taskDay4 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>

                  </div>
                </div>

              </div>
            </div>
            <div id="thursday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>
                  <table class="table">
                      <tbody>
                       @forelse($taskDay5 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>

                  </div>
                </div>

              </div>
            </div>
            <div id="friday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>
                    <table class="table">
                      <tbody>
                       @forelse($taskDay6 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>

                  </div>
                </div>

              </div>
            </div>
            <div id="saturday" class="tab-pane fade">
              <div class="row">
                <div class="clearTop"></div>
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <strong>My Tasks:</strong><br>
                      <span class="small" style="font-size:11px"><strong>Legend:</strong>
                        <font color='red'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - High
                        <font color='green'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Medium
                        <font color='black'><i class="fa fa-square fa-1" aria-hidden="true"></i></font> - Low
                      </span>
                    </div>
                    <table class="table">
                      <tbody>
                       @forelse($taskDay7 as $task)
                       <tr>
                          <td>
                            @if($task->priority == 'High')
                            <font color="red"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Medium')
                            <font color="green"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                             {{$task->task_title}}
                            </a>
                            @elseif($task->priority == 'Low')
                            <font color="black"><i class="fa fa-soccer-ball-o fa-fw"></i></font>
                              <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/task-details/'. Crypt::encrypt($task->id)) }}">
                                {{$task->task_title}}
                              </a>
                            @endif
                          </td>
                       </tr>
                       @empty
                        <div class="list-group">
                          <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                            <a href="{{ url('routine/'. Crypt::encrypt($routine->id).'/task/add-task/') }}">
                              <button class="btn btn-primary btn-md">
                                <i class="fa fa-plus fa-fw"></i>
                                <strong>Add Task</strong>
                              </button>
                            </a>
                          </li>
                        </div>
                       @endforelse
                      </tbody>
                    </table>

                  </div>
                </div>

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.nav-tabs-dropdown').each(function(i, elm) {

    $(elm).text($(elm).next('ul').find('li.active a').text());

});

$('.nav-tabs-dropdown').on('click', function(e) {

    e.preventDefault();

    $(e.target).toggleClass('open').next('ul').slideToggle();

});

$('#nav-tabs-wrapper a[data-toggle="tab"]').on('click', function(e) {

    e.preventDefault();

    $(e.target).closest('ul').hide().prev('a').removeClass('open').text($(this).text());

});

</script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script>
  function myFunction(e) {
    if (confirm('Are you sure you want to delete this routine?')) {
    } else {
      e.preventDefault();
    }
  }
</script>
@endsection
