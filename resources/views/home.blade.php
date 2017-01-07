<!-- <!doctype html>
<html lang="en">
<head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>


    <style>
        /* ... */
    </style>
</head>
<body>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
</body>
</html> -->

@extends('layouts.dashboardv2')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">My Events</div>
            <div class="panel-body">
                  {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
</div>

{!! $calendar->script() !!}

@endsection
