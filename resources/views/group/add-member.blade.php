@extends('layouts.dashboardv3')
@section('group', 'class="active"')
@section('content')
{!! Form::open(array('action' => array('GroupController@storeMember', Crypt::encrypt($group->id)), 'method' => 'POST', 'id' => 'form1', 'class' => 'form-vertical')) !!}


@if(  Session::get('message')  == 'Successfully Added User(s)!' )
  <div class="alert alert-success fade in" role="alert" align="center">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('message') }}</strong>
  </div>
@elseif( Session::get('message')  == 'Please select atleast 1 from the list!' )
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
        <a href="{{ url('/group/' . Crypt::encrypt($group->id)) }}">
          <button class="btn btn-default btn-xs" type="button">
            Back
          </button>
        </a>
        @if($users->count() > 0)
         <input type="submit" class = "btn btn-primary btn-xs" value="Add Member">
        @else
         <input type="submit" class = "btn btn-primary btn-xs" disabled="true" value="Add Member">
        @endif
      </div>
      </div>
      <div class="panel panel-body" id="checkAll">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
          @if($users->count() > 0)
             <button type="button" class="btn btn-primary pull-right"  id="selectAll" /> Select / Deselect All Members<br/></button>
             <div style="padding-top: 3%;">
          </div>
          @else
            <button type="button" class="btn btn-primary pull-right" id="selectAll" disabled="" hidden="" /> Select / Deselect All Members<br/></button>
            <div style="padding-top: 3%;" hidden="">
            </div>
          @endif
          
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
$(document).ready(function () {
  $('#checkAll').on('click', '#selectAll', function () {
    if ($(this).hasClass('allChecked')) {
        $('input[type="checkbox"]', '#checkAll').prop('checked', false);
    } else {
        $('input[type="checkbox"]', '#checkAll').prop('checked', true);
    }
    $(this).toggleClass('allChecked');  
  })
});
</script>

@endsection
