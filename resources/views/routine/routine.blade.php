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

<h1>Routines</h1>
<div class = "container">
	<div class = "row">
		<div class = "form-group">
			@if($routine->count() > 0)
			@foreach($routine as $rout)
			<div class="container">
				<div class="row">
					<ul>
						<li>
							<h4><a href=" {{ url('/routine/'.$rout->id.'/task') }} ">{{ $rout->routine_name }}</a>
							<a href="{{ url('/routine/'.$rout->id. '/edit') }}"><input type="button" class="btn btn-warning text-center" value="Rename"></a>
							<a href="{{ url('/routine/'.$rout->id. '/delete') }}"><input type="button" class="btn btn-danger text-center" value="Delete"></a>
							</h4>
						</li>
					</ul>
				</div>
			</div>
			<hr/>
			@endforeach
			@else
				<h5>-- No Routines Found --</h5>
			@endif
			<a href="{{ url('/routine/add-routine/') }}"><input type = "button" class = "btn btn-primary form-control" value = "Add Routine"></a>
		</div>
	</div>
</div>
@endsection