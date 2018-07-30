<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $id = 'id';
    protected $table = 'specializations';
    protected $fillable = ['name', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
