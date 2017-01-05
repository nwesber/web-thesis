@extends('layouts.dashboardv2')

@section('content')

<div class="container">
  <div class="col-lg-12">
    <div class="row">
      <h3 class="page-header">
        {{ $routine->routine_name}}
      </h3>
    </div>
  </div>
  <div style="margin-bottom: 60px;"></div>
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
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i> <strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay1 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>

    <div id="monday" class="tab-pane fade">
      <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay2 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <div id="tuesday" class="tab-pane fade">
          <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay3 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <div id="wednesday" class="tab-pane fade">
      <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay4 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <div id="thursday" class="tab-pane fade">
      <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay5 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <div id="friday" class="tab-pane fade">
      <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay6 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <div id="saturday" class="tab-pane fade">
      <div class="row">
        <div style="margin-top: 20px;"></div>
        <div class="col-md-12">
          <div>
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
              <button class="btn btn-primary btn-md"><i class="fa fa-plus fa-fw"></i><strong>Add Task</strong></button>
            </a>
          </div>
        </div>
        <br>
        <div style="margin-bottom: 30px;"></div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>My Tasks:</strong>
            </div>
            @foreach($taskDay7 as $task)
            <div class="list-group">
              <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$task->task_title}}</h4>
                <p class="list-group-item-text">{{$task->task_description}}</p>
              </a>
            </div>
            @endforeach

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
@endsection
