<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSpecialization extends Model
{
     protected $id = 'id';
    protected $table = 'event_specializations';
    protected $fillable = ['event_id', 'specialization_id'];
    public $timestamps = false;

}
