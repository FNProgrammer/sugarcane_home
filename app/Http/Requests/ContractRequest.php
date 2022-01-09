<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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

            'employee_id'=>'required','exists:employees,id,',
            'home_id'=>'required|exists:homes,id',
            'start_date'=>'required:contract,start_date:format_date:Y-m-d',
            'end_date'=>'required:contract,end_date:format_date:Y-m-d',
            //  'status'=>'on:true,false ',
           // 'description'=>'required:contract,description,',



        ];



    }
}
