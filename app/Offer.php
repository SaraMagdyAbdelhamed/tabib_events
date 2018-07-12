<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $id = 'id';
    protected $table = 'offers';
    protected $fillable = ['name', 'description', 'image_en', 'image_ar', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;
}
