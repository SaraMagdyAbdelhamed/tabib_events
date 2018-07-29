<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventWorkshop extends Model
{
    protected $id = 'id';
    protected $table = 'event_workshops';
    protected $fillable = ['event_id', 'work_shop_id'];
    public $timestamps = false;
}
