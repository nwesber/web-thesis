@extends('layouts.dashboardv3')

@section('group', 'class="active"')

@section('content')


<div class="row">

  <div class="col-md-12">
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
        <table class="table table-striped">
          <tbody>
            @if($group->count() > 0)
              @foreach($group as $grp)
                <tr>
                  <td>
                    <i class="fa fa-users fa-fw"></i>&nbsp;
                      <a href=" {{ url('/group/'.$grp->id) }} ">{{ $grp->group_name }}</a>
                  </td>
                </tr>
              @endforeach
            @else
            <h3 class="text-center">Looks like you don't have any group.</h3>
            <a href="{{ url('/group/add-group/') }}">
              <button class="btn btn-primary btn-md btn-center"><i class="fa fa-plus fa-fw"></i> Create</button>
            </a>
            @endif
          </tbody>
        </table>
      </div>
      <!-- /.panel-body -->
    </div>
  </div>

</div>
@endsection
