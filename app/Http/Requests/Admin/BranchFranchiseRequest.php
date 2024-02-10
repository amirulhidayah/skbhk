<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchFranchiseRequest extends FormRequest
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
    public function rules(): array
    {
        $rules =[
            'nama_pt'=>[
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
            ] 
        ];
        return $rules;
    }
}
