@extends('layouts.dashboard')

@section('content')

<h1>Group</h1>
<div class = "container">
	<div class = "row">
		<div class = "form-group">
			@if($group->count() > 0)
			@foreach($group as $grp)
			<div class="container">
				<div class="row">
					<ul>
						<li>
							<h4>
							<a href=" {{ url('/group/') }} ">{{ $grp->group_name }}</a>
							<a href="{{ url('/group/'.$grp->id. '/edit-group') }}"><input type="button" class="btn btn-warning text-center" value="Rename"></a>
							<a href="{{ url('') }}"><input type="button" class="btn btn-danger text-center" value="Delete"></a>
							</h4>
						</li>
					</ul>
				</div>
			</div>
			<hr/>
			@endforeach
			@else
				<h5>-- No Groups Found --</h5>
			@endif
			<a href="{{ url('/group/add-group/') }}"><input type = "button" class = "btn btn-primary form-control" value = "Add Group"></a>
		</div>
	</div>
</div>
@endsection
