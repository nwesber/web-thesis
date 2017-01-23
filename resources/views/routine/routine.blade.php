@extends('layouts.dashboardv2')

@section('content')

<div class="row">

	<div class="col-md-12 clearTop">
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
        <table class="table table-striped">
          <tbody>
          @if($routine->count() > 0)
            @foreach($routine as $rout)
              <tr>
                <td><i class="fa fa-soccer-ball-o fa-fw"></i><a href="{{ url('/routine/'.$rout->id.'/task') }}">
                 {{ $rout->routine_name }}
              </a></td>
              </tr>
            @endforeach
          @else
            <h3 class="text-center">Looks like you don't have any routines.</h3>
            <a href="{{ url('/routine/add-routine/') }}">
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
