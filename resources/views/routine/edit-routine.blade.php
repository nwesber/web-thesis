@extends('layouts.dashboard')

@section('content')


<h1>Rename Routine</h1>
<div class = "container">
	<div class = "row">
		<div class = "form-group">
			{!! Form::open(array('action' => array('RoutineController@updateRoutine', $routine->id), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
				<ul>
					<li>
						<h4>
						<a href=" {{ url('/task') }} ">{{ $routine->routine_name }}</a>
						<input type ="text" class="form-control" name="routineName" value="{{ $routine->routine_name }}">
						<input type="submit" value="Save Routine" class = "btn btn-info pull-right form-control">
						<a href="{{ url('/routine') }}"><input type="button"  class="btn btn-primary pull-right form-control" value="Back"></a>
						</h4>
					</li>
				</ul>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection