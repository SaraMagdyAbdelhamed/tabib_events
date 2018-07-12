<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBookingTicket extends Model
{
    protected $id = 'id';
    protected $table = 'event_booking_tickets';
  
    public $timestamp = true;

    // relations
    public function event($model='App\EventMobile') {
        return $this->belongsTo($model, 'event_id');
    }

    public function booking() {
        return $this->belongsTo('App\EventBooking', 'booking_id');
    }
 

    //quiries

    

    //localizations



}
