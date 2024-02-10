<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SuratRequest extends FormRequest
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
            'nik'=>[
                'required',
                'string',
                'max:8'
            ],
            'nama'=>[
                'required',
                'string',
                'max:100'
            ],
            'tempat_lahir'=>[
                'required',
                'string',
            ],
            'tanggal_lahir'=>[
                'required',
                'date',
            ],
            'pendidikan'=>[
                'required',
                'string',
            ],
            'jabatan'=>[
                'required',
                'string',
            ],
            'group_employee'=>[
                'required',
                'string',
            ],
            'alamat'=>[
                'required',
                'string',
            ],
            'no_surat'=>[
                'required',
                'string',
            ],
            'tgl_awal_hubker'=>[
                'required',
                'date'
            ],
            'tgl_akhir_hubker'=>[
                'required',
                'date',
            ], 
            'alasan'=>[
                'required',
                'string',
            ],   
            'kota_pembuat'=>[
                'required',
                'string',
            ], 
            'jabatan_ttd'=>[
                'required',
                'string',
            ],  
            'nama_ttd'=>[
                'required',
                'string',
            ], 
            'jenis_surat'=>[
                'required',
                'string',
            ], 
            '' 
        ];
        return $rules;
    }
}
