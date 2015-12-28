<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\Node;

class Category extends Node
{

    use SoftDeletes;

    protected $fillable=['name','name_ru','parent_id'];

    protected $dates=['deleted_at'];

    public $timestamps=false;


    public function products(){

        return $this->belongsToMany('App\Product');

    }

    public function validate(){

        $v=\Validator::make($this->attributes,$this->getRules());
        return ($v->fails())?$v->errors():true;

    }


    protected function getRules(){

        $rules=array(
            'name'=>array('required','regex:/^[a-zA-Z-]+$/'),
            'name_ru'=>array('required','regex:/^[а-яА-Я-]+$/u')
        );

        if ($this->exists && ! $this->isRoot())
        {
            $rules['parent_id'] = 'required';
        }

        return $rules;
    }
}
