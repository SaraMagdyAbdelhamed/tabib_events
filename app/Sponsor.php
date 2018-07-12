<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $id = 'id';
    protected $table = 'sponsors';
    protected $fillable = ['name', 'logo_ar', 'logo_en', 'created_by', 'updated_by'];
    public $timestamps = true;
}
