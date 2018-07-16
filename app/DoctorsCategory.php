<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorsCategory extends Model
{
    // Table attribute
    protected $primaryKey = 'id';
    protected $table = 'specializations';

    protected $fillable = ['name', 'created_by', 'created_at', 'created_by', 'updated_by'];
    public $timestamps = true;
}
