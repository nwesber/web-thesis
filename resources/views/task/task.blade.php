@extends('layouts.dashboard')

@section('content')

<head>
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
</script>


@endsection