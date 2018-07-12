<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersInterest extends Model
{
   protected $primaryKey = 'id';
    protected $table = 'user_interests';

    public function interest()
    {
    	return $this->hasMany('App\Interest','interest_id');
    }
}
