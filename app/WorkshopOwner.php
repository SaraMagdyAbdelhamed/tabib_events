<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopOwner extends Model
{
    protected $id = 'id';
    protected $table = 'workshop_owners';
    protected $fillable = ['workshop_id', 'user_id'];
    public $timestamps = false;
}
