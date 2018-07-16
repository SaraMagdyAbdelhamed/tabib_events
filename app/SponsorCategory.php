<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorCategory extends Model
{
    protected $id = 'id';
    protected $table = 'sponsor_categories';
    protected $fillable = ['name', 'image', 'created_by', 'updated_by'];
    public $timestamps = true;
}
