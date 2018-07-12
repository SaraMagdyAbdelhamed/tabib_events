<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $id = 'id';
    protected $table = 'event_tickets';
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = false;


    // relations

    // reverse relation for EventMobile by default and for EventBackend
    public function event($model = 'App\EventMobile')
    {
        return $this->belongsTo($model, 'event_id');
    }

    //quiries

    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    //localizations



}
