<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReleaseTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SnsAccountsTableSeeder::class);
        $this->call(StoragesTableSeeder::class);
        $this->call(ImageTableSeeder::class);
    }
}
