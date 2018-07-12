<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopBranch extends Model
{
    protected $id = 'id';
    protected $table = 'shop_branches';
    protected $fillable = ['shop_id', 'branch','address','longtuide','latitude'];
    public $timestamps = false;


    public function shop()
    {
    	return $this->belongsTo('App\Shop','shop_id');
    }

     public function branch_time()
    {
    	return $this->hasMany('App\ShopBranchTime','branch_id');
    }
}
