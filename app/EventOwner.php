<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOwner extends Model
{
    protected $id = 'id';
    protected $table = 'event_owners';
    protected $fillable = ['event_id', 'user_id'];
    public $timestamps = false;

    
}
