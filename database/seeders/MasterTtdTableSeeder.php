<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterTtdTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('master_ttd')->delete();

        \DB::table('master_ttd')->insert(array(
            0 =>
            array(
                'id' => 1,
                'master_branch_regulars_id' => 1,
                'nama' => 'Skrillex',
                'jabatan' => 'Biasa',
                'created_at' => '2024-02-10 11:32:39',
                'updated_at' => '2024-02-10 11:32:39',
            ),
            1 =>
            array(
                'id' => 2,
                'master_branch_regulars_id' => 1,
                'nama' => 'Jack U',
                'jabatan' => 'Dekan',
                'created_at' => '2024-02-10 11:37:59',
                'updated_at' => '2024-02-10 11:39:20',
            ),
        ));
    }
}
