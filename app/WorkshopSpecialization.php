<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopSpecialization extends Model
{
    protected $id = 'id';
    protected $table = 'workshop_specializations';
    protected $fillable = ['workshop_id', 'specialization_id'];
    public $timestamps = false;
}
