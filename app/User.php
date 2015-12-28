<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    /**
     * @param $role string
     * @return bool return true if user has a role
     */

    public function hasRole($role){
        return $this->roles->contains('name',$role);
    }




}
