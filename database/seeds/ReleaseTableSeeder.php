<?php

use App\Models\Release;
use Illuminate\Database\Seeder;

class ReleaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Release::create([
            'release_name'  => 'public',
            'release_level' => '100'
        ]);

        Release::create([
            'release_name'  => 'drift',
            'release_level' => '40'
        ]);

        Release::create([
            'release_name'  => 'private',
            'release_level' => '20'
        ]);

        Release::create([
            'release_name'  => 'ban',
            'release_level' => '5'
        ]);
    }
}
