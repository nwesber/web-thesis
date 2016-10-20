@extends('layouts.dashboard')

@section('content')

<div class="container">

	<div class="box">
	  <div class="box-body">
	    <div class="col-12 no-padding">
	    	<div class="col-10">
	      	<h3 class="no-margin no-padding">Routine</h3>
	      </div>
	      <div class="col-2 routineHeader">
	      	<a class="color-black full-width" href="{{ url('/routine/add-routine/') }}">
	          <button class="float-right no-margin full-width text-center">
	             <span><h4 class="no-padding no-margin color-white">Create</h4></span>
	          </button>
	        </a>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container">

	 @if($routine->count() > 0)
		 @foreach($routine as $rout)
		 <div class="col-sm-3">
		 	<div class="card">
			 <div class="card-text no-padding no-margin">
			  <h3 class="text-center no-padding no-margin">
					<a href=" {{ url('/routine/'.$rout->id.'/task') }} ">
						{{ $rout->routine_name }}
					</a>
				</h3>

				<div class="col-12" style="margin-left: 14px;">
					<div class="col-6 no-collapse">
		        <a class="color-black full-width" href="{{ url('/routine/'.$rout->id. '/edit') }}">
		          <button class="full-width button-white">
		            Rename
		          </button>
		        </a>
		      </div>
		      <div class="col-6 no-collapse">
		        <a id="confirmation"
		           class="color-black full-width"
		           href="{{ url('/routine/'.$rout->id. '/delete') }}"
		           onclick="myFunction(event)">
		          <button class="full-width button-white">
		            Delete
		          </button>
		        </a>
		      </div>
				</div>

			 </div>
			</div>
		 </div>
		 @endforeach
	 @else
			<h3 class="text-center">-- No Routines Found --</h3>
	 @endif


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
