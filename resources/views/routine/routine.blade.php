@extends('layouts.dashboardv3')

@section('class', 'class="active"')

@section('content')
@if( Session::has('message') )
  <div class="alert alert-success fade in" role="alert" align="center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('message') }}</strong>
  </div>
@endif
<div class="row">
	<div class="col-md-12">

    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-bicycle fa-fw"></i> <strong>My Routine</strong>
        <div class="pull-right">
        	<a href="{{ url('/routine/add-routine/') }}">
        		<button class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Create</button>
        	</a>
        </div>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for routines.. ">
        <ul id="myUL">
          @if($routine->count() > 0)
            @foreach($routine as $rout)
            <li>
              <a href="{{ url('/routine/'.Crypt::encrypt($rout->id).'/task') }}">
                <i class="fa fa-soccer-ball-o fa-fw"></i> {{ $rout->routine_name }}
                <!-- <small class="pull-right"><i>Added</i></small> -->
              </a>
            </li>
            @endforeach
          @else
            <h3 class="text-center">Looks like you don't have any routines.</h3>
            <a href="{{ url('/routine/add-routine/') }}">
              <button class="btn btn-primary btn-md btn-center"><i class="fa fa-plus fa-fw"></i> Create</button>
            </a>
          @endif
        </ul>
      </div>
      <!-- /.panel-body -->
    </div>
	</div>

</div>


<script type="text/javascript">
  function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
  }
</script>
@endsection
