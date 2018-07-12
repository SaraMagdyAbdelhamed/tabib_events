<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $id = 'id';
    protected $table = 'trending_keywords';
    protected $fillable = ['name', 'created_by', 'updated_by'];
    public $timestamp = true;
}
