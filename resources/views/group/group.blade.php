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
							<a href=" {{ url('/group/'.$grp->id) }} ">{{ $grp->group_name }}</a><br>
							<a href="{{ url('/group/'.$grp->id. '/add-member') }}"><input type="button" class="btn btn-info text-center" value="Add Member"></a>
							<a href="{{ url('/group/'.$grp->id. '/view-member') }}"><input type="button" class="btn btn-info text-center" value="View Member"></a>
							<a href="{{ url('/group/'.$grp->id. '/edit-group') }}"><input type="button" class="btn btn-warning text-center" value="Rename"></a>
							<a href="{{ url('/group/'.$grp->id. '/leave-group') }}"><input type="button" class="btn btn-danger" value="Leave Group"></a>
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
			<a href="{{ url('/group/add-group/') }}"><input type = "button" class = "btn btn-primary form-control" value = "Create Group"></a>
		</div>
	</div>
</div>
@endsection
