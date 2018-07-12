<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopBranchTime extends Model
{
    protected $id = 'id';
    protected $table = 'shop_branch_times';
    protected $fillable = ['branch_id', 'day_id','from','to'];
    public $timestamps = false;


    public function branch()
    {
    	return $this->belongsTo('App\ShopBranch','branch_id');
    }
}
