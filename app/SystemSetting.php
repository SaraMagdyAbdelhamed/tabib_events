<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'system_settings';

    protected $fillable = ['name', 'value'];
    public $timestamps = false;
}
