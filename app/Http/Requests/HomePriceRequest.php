<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePriceRequest extends FormRequest
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

          'home_kind_id' =>['required:home_kinds,home_kind_id,'.$this->home_kind],
            'price'=>'required:home_prices,price',
           'Compensatory'=>'required:home_prices,Compensatory',
           'from_date'=>'required:home_prices,from_date:format_date:Y-m-d',
            'to_date'=>'required:unique:home_prices,to_date:format_date:Y-m-d',
         //  'status'=>'on:true,false ',

        ];



    }
}
