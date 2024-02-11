<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KaryawanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('karyawan')->delete();
        
        \DB::table('karyawan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama' => 'Amirul Hidayah',
                'nik' => 'ADcCMQ54l5c=',
                'tempat_lahir' => 'Parigi',
                'tanggal_lahir' => '2024-02-01',
                'pendidikan' => 'SMA',
                'jabatan' => 'Gubernur',
                'master_branch_regulars_id' => 1,
                'no_surat' => '1 Januari 2023',
                'tgl_awal_hubker' => '2024-02-01',
                'tgl_akhir_hubker' => '2024-02-29',
                'jenis_pkwt' => 'PKWT',
                'no_pkwt' => '002',
                'tgl_pkwt' => '2024-02-01',
                'master_branch_franchises_id' => 2,
                'toko_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2024-02-10 14:55:50',
                'updated_at' => '2024-02-11 19:00:54',
            ),
        ));
        
        
    }
}