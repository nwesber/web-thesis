@extends('layouts.dashboardv2')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="clearTop"></div>
    <a href="{{ url('/') }}"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Return to Routines">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <div class="btn-group pull-right">
      <a href="#"
         class="btn btn-primary"
         role="button"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Add Task">
         <i class="fa fa-plus" aria-hidden="true"></i>
      </a>
      <a href="{{ url('/routine/'.$routine->id. '/edit') }}"
         class="btn btn-warning"
         role="button"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Edit">
         <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      <a href="{{ url('/routine/'.$routine->id. '/delete') }}"
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

  <div class="col-md-12">
    <div class="col-lg-12">
      <div class="row">
        <h3 class="page-header">
          {{ $routine->routine_name}}
        </h3>
      </div>
    </div>

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
                <strong>My Tasks:</strong>
              </div>

              @forelse($taskDay1 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>

              @forelse($taskDay2 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>
              @forelse($taskDay3 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>
              @forelse($taskDay4 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>
              @forelse($taskDay5 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>
              @forelse($taskDay6 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
                <strong>My Tasks:</strong>
              </div>
              @forelse($taskDay7 as $task)
              <div class="list-group">
                <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                  <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                  <p class="list-group-item-text">{{$task->task_description}}</p>
                </a>
              </div>
              @empty
              <div class="list-group">
                <li class="list-group-item text-center">Oops! It seems that you don't have any task/s yet.<br>
                  <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
                    <button class="btn btn-primary btn-md">
                      <i class="fa fa-plus fa-fw"></i>
                      <strong>Add Task</strong>
                    </button>
                  </a>
                </li>
              </div>
              @endforelse

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
