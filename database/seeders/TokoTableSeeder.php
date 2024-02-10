<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TokoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('toko')->delete();
        
        \DB::table('toko')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_toko' => 'Toko 1-1',
                'alamat' => 'Skrillex',
                'master_branch_franchises_id' => 1,
                'created_at' => '2024-02-10 11:19:44',
                'updated_at' => '2024-02-10 11:23:21',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_toko' => 'Toko 1-2',
                'alamat' => 'Skrillex',
                'master_branch_franchises_id' => 1,
                'created_at' => '2024-02-10 11:23:30',
                'updated_at' => '2024-02-10 11:23:39',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_toko' => 'Toko 2-1',
                'alamat' => 'Skrillex',
                'master_branch_franchises_id' => 2,
                'created_at' => '2024-02-10 11:23:50',
                'updated_at' => '2024-02-10 11:23:50',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_toko' => 'Toko 2-2',
                'alamat' => 'Skrillex',
                'master_branch_franchises_id' => 2,
                'created_at' => '2024-02-10 11:23:58',
                'updated_at' => '2024-02-10 11:23:58',
            ),
        ));
        
        
    }
}