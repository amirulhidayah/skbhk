<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterBranchFranchisesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('master_branch_franchises')->delete();
        
        \DB::table('master_branch_franchises')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_pt' => 'PT 1',
                'alamat' => 'Skrillex',
                'no_telp' => '081354643573',
                'no_fax' => '21321321321',
                'status' => 1,
                'created_at' => '2024-02-10 11:17:13',
                'updated_at' => '2024-02-10 11:17:13',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_pt' => 'PT 2',
                'alamat' => 'Jack U',
                'no_telp' => '12321312321312',
                'no_fax' => '123213213123',
                'status' => 1,
                'created_at' => '2024-02-10 11:17:23',
                'updated_at' => '2024-02-10 11:17:28',
            ),
        ));
        
        
    }
}