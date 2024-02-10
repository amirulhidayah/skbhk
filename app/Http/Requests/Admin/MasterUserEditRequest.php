<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MasterUserEditRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'master_branch_regulars_id' => [
                'required',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
            ],
            'password' => [
                'sometimes',
                'nullable',
                'string',
                'min:8',
            ],
            'role_as' => [
                'required',
                'string'
            ]
        ];
        return $rules;
    }
}
