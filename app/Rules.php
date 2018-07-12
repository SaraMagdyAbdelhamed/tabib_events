<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'rules';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\Users','user_rules','user_id','rule_id');
    }

}
