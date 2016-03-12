<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 29.02.2016
 * Time: 9:35
 */

namespace App\Http\Requests;


class FilterRequest extends Request
{


    public function authorize(){

        return true;

    }


    public function rules(){

        return [
            'sort'=>'in:created_at,model',
            'order'=>'in:asc,desc',
            'on'=>'in:12,24,48'
        ];

    }
}