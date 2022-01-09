<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
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

          'district' =>['required:homes,district,'.$this->home],
            'unit'=>'required:home,unit',
        //   'rent'=>'required:homes,rent',
            'home_kind_id'=>'required|exists:home_kinds,id',


        ];



    }
}
