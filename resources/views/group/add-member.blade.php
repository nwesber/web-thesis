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

	<div class="clearTop"></div>
    <a href="{{ url('group/' . $group->id) }}"
       class="btn btn-default"
       role="button"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Back">
       <i class="fa fa-arrow-left" aria-hidden="true"></i>
    </a>
    <br>
	List of Users:
	{!! Form::open(array('action' => array('GroupController@storeMember', $group->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
	<ul>
	@if($users->count() > 0)
		@foreach($users as $user)
		<div class="col-sm-12">
		<hr width="55%">
			<div class="col-sm-6">
				<li>{{ $user->name }}</li>
			</div>
			<div class ="col-sm-6">
				<input type="checkbox" name="addMember[]" value="{{ $user->name }}" title="Add Member">
			</div>
		</div>
		@endforeach
	@else
		<h5>-- No Members Found --</h5>
		<input type="submit" class = "btn btn-primary" value="Add Member" disabled="true">
	@endif
	</ul>
	<input type="submit" class = "btn btn-primary" value="Add Member">
	{!! Form::close() !!}
</div>

@endsection