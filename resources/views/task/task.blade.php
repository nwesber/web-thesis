@extends('layouts.dashboardv2')

@section('content')

<div class="container">
  <div class="col-lg-12">
    <div class="row">
      <h3 class="page-header">{{ $routine->routine_name}}</h3>
    </div>
  </div>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Sunday</a></li>
    <li><a data-toggle="tab" href="#menu1">Monday</a></li>
    <li><a data-toggle="tab" href="#menu2">Tuesday</a></li>
    <li><a data-toggle="tab" href="#menu3">Wednesday</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <br>
      <div class="row">


        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
               <i class="fa fa-bicycle fa-fw"></i> <strong>Tasks</strong>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              @foreach($taskDay1 as $task)
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4><a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></h4>
                  </div>
                </div>

              @endforeach


            </div>
            <!-- /.panel-body -->
          </div>
        </div>

      </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
   <div class = "form-group text-center">
      <hr/>
          <div class = "col-sm-12">
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}"><input type = "button" class = "btn btn-info form-control" style = "width:50%" value = "Add Task"></a>
          </div>
          <div class = "col-sm-12">
            <a href="{{ url('/routine') }}"><input type = "button" class = "btn btn-primary form-control" style = "width:50%" value = "Back"></a>
          </div>
      </div>
</div>




<!-- <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
</head>
  <div class="container">
    <div class="row">
        <div class="section">
          <div id="tabs" class="c-tabs no-js">
            <div class="c-tabs-nav">

              <a href="#" class="c-tabs-nav__link is-active">
                <span>Sunday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Monday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Tuesday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Wednesday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Thursday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Friday</span>
              </a>
              <a href="#" class="c-tabs-nav__link">
                <span>Saturday</span>
              </a>

            </div>
            <div class="c-tab is-active">
              <div class="c-tab__content">
              <ul>
              @foreach($taskDay1 as $task)
                  <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
            <div class="c-tab">
              <div class="c-tab__content">
              <ul>
              @foreach($taskDay2 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
            <div class="c-tab">
              <div class="c-tab__content">
             <ul>
              @foreach($taskDay3 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
            <div class="c-tab">
              <div class="c-tab__content">
             <ul>
              @foreach($taskDay4 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
            <div class="c-tab">
              <div class="c-tab__content">
             <ul>
              @foreach($taskDay5 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
             <div class="c-tab">
              <div class="c-tab__content">
             <ul>
              @foreach($taskDay6 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
             <div class="c-tab">
              <div class="c-tab__content">
              <ul>
              @foreach($taskDay7 as $task)
                   <h4><li>Task: <a href="{{ url('routine/'.$routine->id.'/task/task-details/'.$task->id) }}">{{$task->task_title}}</a></li></h4>
              @endforeach
              </ul>
              </div>
            </div>
        </div>
      </div>
      <div class = "form-group text-center">
      <hr/>
          <div class = "col-sm-12">
            <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}"><input type = "button" class = "btn btn-info form-control" style = "width:50%" value = "Add Task"></a>
          </div>
          <div class = "col-sm-12">
            <a href="{{ url('/routine') }}"><input type = "button" class = "btn btn-primary form-control" style = "width:50%" value = "Back"></a>
          </div>
    	</div>
    </div>
  </div>

<script src="{{ asset('js/src/tabs.js') }}"></script>
<script>
  var myTabs = tabs({
    el: '#tabs',
    tabNavigationLinks: '.c-tabs-nav__link',
    tabContentContainers: '.c-tab'
  });
  myTabs.init();
</script> -->


@endsection
