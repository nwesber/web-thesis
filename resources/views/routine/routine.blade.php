@extends('layouts.dashboardv2')

@section('content')

<div class="row">
	<div class="col-lg-12">
	  <h1 class="page-header"></h1>
	</div>

	<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bicycle fa-fw"></i> <strong>Routine</strong>
        <div class="pull-right">
        	<a href="{{ url('/routine/add-routine/') }}">
        		<button class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Create</button>
        	</a>
        </div>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">

     		@if($routine->count() > 0)
		 			@foreach($routine as $rout)
	        <div class="list-group">
	        	<div class="col-md-8" style="padding-top: 5px;">
		          <a href="{{ url('/routine/'.$rout->id.'/task') }}" class="list-group-item">
		             <i class="fa fa-soccer-ball-o fa-fw"></i>&nbsp;&nbsp;{{ $rout->routine_name }}
		          </a>
	          </div>
	          <div class="col-md-2" style="padding-top: 5px;">
	          	<a href="{{ url('/routine/'.$rout->id. '/edit') }}" class="list-group-item">
		            <i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp; Rename
		          </a>
	          </div>
	          <div class="col-md-2" style="padding-top: 5px;">
	          	<a href="{{ url('/routine/'.$rout->id. '/delete') }}" class="list-group-item" onclick="myFunction(event)">
		            <i class="fa fa-trash fa-fw"></i>&nbsp;&nbsp; Delete
		          </a>
	          </div>
	      	</div>
	      	<hr>
      		@endforeach
			  @else
					<h3 class="text-center">Looks like you don't have any routines.</h3>
					<a href="{{ url('/routine/add-routine/') }}">
        		<button class="btn btn-primary btn-md btn-center"><i class="fa fa-plus fa-fw"></i> Create</button>
        	</a>
			  @endif

      </div>
      <!-- /.panel-body -->
    </div>
	</div>

</div>

<script>
	function myFunction(e) {
	  if (confirm('Are you sure you want to delete this routine?')) {
		} else {
			e.preventDefault();
		}
	}
</script>
@endsection
