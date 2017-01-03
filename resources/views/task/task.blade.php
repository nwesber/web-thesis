@extends('layouts.dashboardv2')

@section('content')

<div class="container">
  <div class="col-lg-12">
    <div class="row">
      <h3 class="page-header">{{ $routine->routine_name}}
         <div class="pull-right">
          <a href="{{ url('routine/'.$routine->id.'/task/add-task/') }}">
            <button class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Add Task</button>
          </a>
          <a href="{{ url('/routine') }}">
            <button class="btn btn-default btn-xs"><i class="fa fa-plus fa-fw"></i> Back</button>
          </a>
        </div>
      </h3>

    </div>
  </div>

  <a href="#" class="nav-tabs-dropdown btn btn-block btn-primary">Tabs</a>
  <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-tabs-horizontal">
    <li class="active"><a data-toggle="tab" href="#sunday">Sunday</a></li>
    <li><a data-toggle="tab" href="#menu1">Monday</a></li>
    <li><a data-toggle="tab" href="#menu2">Tuesday</a></li>
    <li><a data-toggle="tab" href="#menu3">Wednesday</a></li>
    <li><a data-toggle="tab" href="#menu2">Thursday</a></li>
    <li><a data-toggle="tab" href="#menu3">Friday</a></li>
    <li><a data-toggle="tab" href="#menu3">Saturday</a></li>
  </ul>

  <div class="tab-content">
    <div id="sunday" class="tab-pane fade in active">
      <br>
      <div class="row">
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
