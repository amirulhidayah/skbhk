<?php

// Buat file baru di App\Rules\UniqueNikRule.php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueNikRule implements rule
{
    private $nik;

    public function __construct($nik)
    {
        $this->nik = $nik;
    }

    public function passes($attribute, $value)
    {
        // Mendekripsi 'nik' sebelum melakukan pengecekan keunikan
        $decryptedNik = rc4_decrypt($this->nik);
        $karyawan = DB::table('karyawan')->where('nik', $decryptedNik)->first();
        return $karyawan === null;
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
