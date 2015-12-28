<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    public $timestamps=false;

    protected $fillable=['name','name_ru'];


    public function products(){
        return $this->belongsToMany('App\Product');
    }
}
