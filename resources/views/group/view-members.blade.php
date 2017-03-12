@extends('layouts.dashboardv3')
@section('group', 'class="active"')
@section('content')

{!! Form::open(array('action' => array('GroupController@updateMember', Crypt::encrypt($group->id)), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}
<div class="col-lg-12">
  @if( Session::has('message') )
    <div class="alert alert-danger fade in" role="alert" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{ Session::get('message') }}</strong>
    </div>
  @endif
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>List of Members</strong>
				<div class="pull-right">
          <button class="btn btn-default btn-xs" type="button" onclick="goBack()">
            Back
          </button>
	        @if($users->count() > 0)
						<input type="submit" class = "btn btn-primary btn-xs" value="Remove Member">
					@else
						<input type="submit" class = "btn btn-primary btn-xs" value="Remove Member" disabled="true">
					@endif
      	</div>
			</div>
			<div class="panel-body">
				 <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <ul id="myUL">
          @if($users->count() > 0)
						@foreach($users as $user)
              <li>
                <a>
                  <input type="checkbox" name="removeMember[]" value="{{ $user->user_id }}" title="Remove Member" style="margin-right: 20px;">
                  {{ $user->name }}
                </a>
              </li>
            @endforeach
          @else
            <h5>-- No Members Found --</h5>
            <input type="submit" class = "btn btn-primary" value="Add Member" disabled="true">
          @endif
        </ul>
      </div>
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

<script>
  function goBack() {
      window.history.go(-1);
  }
</script>

@endsection
