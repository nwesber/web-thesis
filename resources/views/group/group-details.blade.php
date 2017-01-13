@extends('layouts.dashboard')

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

<h1>Group Details</h1>
<div class = "container">
	<div class = "row">
		Group Name: {{$group->group_name}}<br>
		<br>
		<a href="{{ url('group/'.$group->id. '/edit-group') }}"><input type="button" class="btn btn-warning" value="Edit"></a>
		<a href="{{ url('group/') }}"><input type="button" class="btn btn-primary" value="Back"></a>
	</div>
</div>

@endsection