<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends \Illuminate\Database\Eloquent\Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //...

    /**
     * Optional FullCalendar.io settings for this event
     *
     * @return array
     */
    public function getEventOptions()
    {
        return [
            'color' => $this->background_color,
            //etc
        ];
    } 
}
