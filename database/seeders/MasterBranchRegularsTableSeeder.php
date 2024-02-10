<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterBranchRegularsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('master_branch_regulars')->delete();

        \DB::table('master_branch_regulars')->insert(array(
            0 =>
            array(
                'id' => 1,
                'branch' => 'Head Office',
                'alamat' => 'Alfa Tower- Jl.Jalur Sutera Barat kav.9 Alam Sutera, Tanggerang, 15143
',
                'no_telp' => '021-808 21 555
',
                'no_fax' => '021-808 21 555
',
                'kota' => 'Tangerang',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
