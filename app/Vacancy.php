<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{

    public $timestamps=true;
    protected $fillable=array('position','description','salary','hot');

}
