<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    protected $id = 'id';
    protected $table = 'event_media';
    protected $fillable = ['event_id', 'link', 'type'];
    public $timestamps = false;

    public function event() {
        return $this->belongsTo('App\EventBackend', 'event_id');
    }

     public function eventMobile() {
        return $this->belongsTo('App\EventMobile', 'event_id');
    }
}
