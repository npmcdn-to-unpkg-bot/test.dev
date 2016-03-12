<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable=['name','slug'];


    public function products(){

        return $this->belongsToMany('App\Product');

    }

}
