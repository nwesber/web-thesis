@extends('layouts.dashboardv3')
@section('group', 'class="active"')


@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="col-lg-12">
      @if( Session::has('message') )
        <div class="alert alert-success fade in" role="alert" align="center">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>{{ Session::get('message') }}</strong>
        </div>
      @endif
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-users fa-fw"></i> <strong>Group</strong>
        <div class="pull-right">
          <a href="{{ url('/group/add-group/') }}">
            <button class="btn btn-primary btn-xs"><i class="fa fa-plus fa-fw"></i> Create</button>
          </a>
        </div>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for groups.. ">
        <ul id="myUL">
          @if($group->count() > 0)
            @foreach($group as $grp)
            <li>
              <a href="{{ url('/group/'. Crypt::encrypt($grp->id))  }}">
                <i class="fa fa-users fa-fw"></i> {{ $grp->group_name }}
                <!-- <small class="pull-right"><i>Added</i></small> -->
              </a>
            </li>
            @endforeach
          @else
            <h3 class="text-center">Looks like you don't have any group.</h3>
            <a href="{{ url('/group/add-group/') }}">
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
