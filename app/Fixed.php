<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixed extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'fixed_pages';

    protected $fillable = ['name', 'body', 'updated_by'];
    public $timestamps = true;
}
