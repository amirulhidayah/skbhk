<?php

namespace App\Http\Requests\Admin;

use App\Models\Karyawan;
use Illuminate\Foundation\Http\FormRequest;

class KaryawanEditRequest extends FormRequest
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
            'nik' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $karyawan = Karyawan::where('nik', rc4_encrypt($value))->first();
                    if ($karyawan) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                },
                'max:8',
            ],
            'nama' => [
                'required',
                'string',
                'max:100'
            ],
            'tempat_lahir' => [
                'required',
                'string',
            ],
            'tanggal_lahir' => [
                'required',
                'date',
            ],
            'pendidikan' => [
                'required',
                'string',
            ],
            'jabatan' => [
                'required',
                'string',
            ],
            'master_branch_regulars_id' => [
                'required',
            ],
            'no_surat' => [
                'required',
                'string',
            ],
            'tgl_awal_hubker' => [
                'required',
                'date'
            ],
            'tgl_akhir_hubker' => [
                'nullable',
                'date',
            ],
            'jenis_pkwt' => [
                'nullable',
                'string',
            ],
            'no_pkwt' => [
                'nullable',
                'string',
            ],
            'tgl_pkwt' => [
                'nullable',
                'date',
            ],
            'master_branch_franchises_id' => [
                'nullable',
            ],
            'toko_id' => [
                'nullable',
            ]
        ];
        return $rules;
    }
}
