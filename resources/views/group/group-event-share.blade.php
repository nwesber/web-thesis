@extends('layouts.dashboardv2')

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

<div class="row">
  <div class="col-md-12 clearBottom">
    <div class="clearTop"></div>
    <a href="{{ url('group/' . $group->id) }}"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Back">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>

    <h1>Share These Events</h1>
	{!! Form::open(array('action' => array('GroupController@performShare', $group->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
	<ul>
	@if($events->count() > 0)
		@foreach($events as $event)
		<div class="col-sm-12">
		<hr width="55%">
			<div class="col-sm-6">
				<li>{{ $event->event_title }}</li>
			</div>
			<div class ="col-sm-6">
				<input type="checkbox" name="shareEvent[]" value="{{ $event->event_title }}" title="Share This Event">
			</div>
		</div>
		@endforeach
	<input type="submit" class = "btn btn-primary" value="Share Event">	
	@else
		<h5>-- No Event Found --</h5>
		<input type="submit" class = "btn btn-primary" value="Share Event" disabled="true">
	</ul>
	@endif
	{!! Form::close() !!}
</div>

@endsection