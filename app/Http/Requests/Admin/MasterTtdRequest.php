<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MasterTtdRequest extends FormRequest
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
        $rules = [
            'master_branch_regulars_id' => [
                'required',
                'string',
            ],
            'nama' => [
                'required',
                'string',
            ],
            'jabatan' => [
                'required',
                'string',
            ],
        ];
        return $rules;
    }
}
