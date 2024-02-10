<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(MasterBranchRegularsTableSeeder::class);
        $this->call(MasterBranchFranchisesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MasterTtdTableSeeder::class);
        $this->call(TokoTableSeeder::class);
        $this->call(KaryawanTableSeeder::class);
    }
}
