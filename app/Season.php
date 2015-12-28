<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable=['name','slug'];


    public function products(){

        $this->belongsToMany('App\Product')->withTimestamps();

    }

}
