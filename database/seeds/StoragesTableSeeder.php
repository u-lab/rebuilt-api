<?php

use Faker\Factory;
use Carbon\Carbon;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class StoragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ja_JP');

        for ($i = 0; $i < 3; $i++) {
            $now = Carbon::now();

            Storage::create([
                        'storage_id' => $i === 0 ?
                            "1581315433ra05d0":
                            $now->timestamp . 'ra'. $i % 10 .'5d' . $i % 10,
                        'user_id' => 1,
                        'title' => '作品' . ($i + 1) . 'かっこいいよ',
                        'description' => $faker->sentence(3),
                        'long_comment' => $faker->sentence(5),
                        'storage_url' => $faker->url,
                        'eyecatch_imgae_url' => $faker->url,
                        'web_address' => $faker->url,
                    ]);
        }
    }
}
