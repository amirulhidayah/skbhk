<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchRegulerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules =[
            'branch'=>[
                'required',
                'string',
                'max:100'
            ],
            'alamat'=>[
                'required',
                'string',
                'max:500'
            ],
            'no_telp'=>[
                'required',
                'string',
            ] ,
            'no_fax'=>[
                'nullable',
                'string',
            ] ,
            'kota'=>[
                'required',
                'string',
            ] ,
           
        ];
        return $rules;
    }
}
