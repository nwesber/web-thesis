@extends('layouts.dashboard')

@section('content')
	

<div id='calendar'></div> 
	{!! $calendar->calendar() !!}
    {!! $calendar->script() !!}



<script type="text/javascript">
    $(document).ready(function() {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('#calendar');
    var newEvent = new Object();
    newEvent.title = "some text";
    newEvent.start = new Date();
    newEvent.allDay = false;

    $('#calendar').fullCalendar({
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        
        // add event name to title attribute on mouseover
        eventMouseover: function(event, jsEvent, view) {
            if (view.name !== 'agendaDay') {
                $(jsEvent.target).attr('title', event.title);
            }
        },
        eventClick: function(event){
            $(".closon").click(function() {
                calendar.fullCalendar('removeEvents',event._id);
            });
        },      
       /* dayClick: function(date, allDay, jsEvent, view) {
            calendar.fullCalendar( 'renderEvent', newEvent );
            // calendar.fullCalendar('renderEvent', { title: prompt('YOUR TITLE'), start: date, allDay: true }, true );
        },*/
        dayClick: function(date, allDay, jsEvent, view) {
            calendar.fullCalendar('renderEvent', { title: prompt('YOUR TITLE'), start: date, allDay: true }, true );
            /**
             * again : ajax call to store event in DB
             */
            jQuery.post(
                "home", // your url
                { // re-use event's data
                    title: title,
                    start: date,
                    allDay: allDay,
                }
            );
        },

        // For DEMO only
        // *************
        events: [
        {
            title: 'This must be editable',
            start: new Date(y, m, 1)},
        {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2)},
        {   
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d - 3, 16, 0),
            allDay: false},
        {
            id: 999,
            title: 'Repeating Event',
            start: new Date(y, m, d + 4, 16, 0),
            allDay: false},
        {
            title: 'Meeting',
            start: new Date(y, m, d, 10, 30),
            allDay: true},
        {
            title: 'Lunch',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false},
        {
            title: 'Birthday Party',
            start: new Date(y, m, d + 1, 19, 0),
            end: new Date(y, m, d + 1, 22, 30),
            allDay: false},
        {
            title: 'Click for Google',
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'}
        ]
    });
});

</script>

@endsection