@extends('layouts.dashboardv2')


@section('content')

<div class="row">
  <div class="col-md-12 clearBottom">
    <div class="clearTop"></div>
    <a href="#"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Back">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <div class="btn-group pull-right">
      <a href="#"
         class="btn btn-warning"
         role="button"
         data-toggle="tooltip"
         data-placement="bottom"
         title="Edit">
         <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      <a href="#"
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
  <div class="clearTop"></div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <h3>{{ $event->event_title}}</h3>
        <div>
          <table class="table">
            <tbody>
              <tr>
                <td>Event Description:</td>
                <td><strong>{{ $event->event_description }}</strong></td>
              </tr>
               <tr>
                <td>Location:</td>
                <td><strong>{{ $event->location }}</strong></td>
              </tr>
              <tr>
                <td>Time Start:</td>
                <td><strong>{{ Carbon\Carbon::parse($event->time_start)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
              <tr>
                <td>Time End:</td>
                <td><strong>{{ Carbon\Carbon::parse($event->time_end)->format('D, M-d-Y h:i A') }}</strong></td>
              </tr>
            </tbody>
          </table>


        </div>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection