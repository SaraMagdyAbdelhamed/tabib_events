<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $id = 'id';
    protected $table = 'event_bookings';
  
    public $timestamp = true;

    // relations
    public function event($model='App\EventMobile') {
        return $this->belongsTo($model, 'event_id');
    }
 
    public function user() {
        return $this->belongsTo('App\Users','user_id');
    }

     public function bookingTicket() {
        return $this->hasMany('App\EventBookingTicket', 'booking_id');
    }
    //quiries

    

    //localizations
}
