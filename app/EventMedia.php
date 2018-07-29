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
        return $this->belongsTo('App\Event', 'event_id');
    }

     
}
