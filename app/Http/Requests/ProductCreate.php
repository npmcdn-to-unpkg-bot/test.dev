<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductCreate extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'model'=>'required',
            'category'=>'required',
            'description'=>'required'

        ];
    }

    public  function messages()
    {
        return [
            'model.required'=>'необходимо указать модель',
            'category.required'=>'необходимо выбрать по-крайней мере одну категорию',
            'description.required'=>'необходимо что-нибудь указать в описании'
        ];
    }


}
