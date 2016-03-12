<?php

namespace App\Helpers;
use App\Category;
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: yura
 * Date: 18.01.2016
 * Time: 11:05
 */
class Helper
{


    /**
     * @param array $data
     * @return string
     */
    public static function treeToArray(\Kalnoy\Nestedset\Collection $tree){


        if(!$tree->count()){
            return null;
        }
        else {
            return array_map(function ($item){
                $data=array();
                $data['name']=$item->name;
                $data['name_ru']=$item->name_ru;
                $data['level']=$item->depth;
                if($item->descendants()->count()>0) {
                    $data['children'] = self::treeToArray($item->descendants()->withdepth()->get());
                }

                return $data;

            }, $tree->all());
        }
    }


    public static function hasParam($params,$value){

        if(is_array($params)&& !empty($params)){
             return in_array($value,$params)?'checked':null;
        }
        else{
            return $params==$value?'checked':null;
        }
        return null;

    }


}