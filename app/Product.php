<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps=false;

    protected  $fillable=['model','article','growth','size','description','new'];


    public function seasons(){

        return $this->belongsToMany('App\Season');

    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }


    public function materials(){
        return $this->belongsToMany('App\Material');
    }

}
