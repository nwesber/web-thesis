@extends('layouts.dashboardv3')
@section('group', 'class="active"')
@section('content')
{!! Form::open(array('action' => array('GroupController@storeMember', Crypt::encrypt($group->id)), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}

@if( Session::has('message') )
  <div class="alert alert-danger fade in" role="alert" align="center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('message') }}</strong>
  </div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>List of Users</strong>
      <div class="pull-right">
          <button class="btn btn-default btn-xs" type="button" onclick="goBack()">
            Back
          </button>
         <input type="submit" class = "btn btn-primary btn-xs" value="Add Member">
      </div>
      </div>
      <div class="panel panel-body">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <ul id="myUL">
          @if($users->count() > 0)
            @foreach($users as $user)
              <li>
                <a>
                  <input type="checkbox" name="addMember[]" value="{{ $user->id }}" class="here" title="Add Member" style="margin-right: 20px;">
                  {{ $user->name }}
                  <!-- <small class="pull-right"><i>Added</i></small> -->
                </a>
              </li>
            @endforeach
          @else
            <h5>-- No Users Found --</h5>
            <input type="submit" class = "btn btn-primary" value="Add Member" disabled="true">
          @endif
        </ul>

      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}

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

<script>
  function goBack() {
      window.history.go(-1);
  }
</script>
@endsection
