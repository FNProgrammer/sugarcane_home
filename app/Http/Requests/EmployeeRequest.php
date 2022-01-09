<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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

          'employee_id' =>['required:employee,employee_id,'.$this->employee],
            'name'=>'required:employee,name',
            'family'=>'required:employee,rent',
            'certificate_id'=>'required:employee,id',
            'national_id'=>'required|numeric|digits_between:1,10: employee,id',
            'child'=>'required:employee,id',
            'company_id'=>'required|exists:companies,id',
            'position_id'=>'required|exists:positions,id',



        ];



    }
}
