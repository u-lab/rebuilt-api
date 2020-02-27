<?php

use Faker\Factory;
use Carbon\Carbon;
use App\Models\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage as FacadesStorage;

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
                'storage_id'         => $i === 0 ?
                                            "1581315433ra05d0":
                                            $now->timestamp . 'ra'. $i % 10 .'5d' . $i % 10,
                'user_id'            => 1,
                'title'              => '作品' . ($i + 1) . 'かっこいいよ',
                'description'        => $faker->sentence(3),
                'long_comment'       => $this->get_long_comment(),
                'storage_url'        => $faker->url,
                'eyecatch_imgae_url' => FacadesStorage::disk('public')->url('storages/example/work1.jpg'),
                'web_address'        => $faker->url,
            ]);
        }
    }

    private function get_long_comment(): string
    {
        return "最近自然の中の曲線や形に興味がある。特にネジバナやサボテンに見られる”螺旋”やバッタの脚を始めとした昆虫の足の曲線が凄く不思議に心が惹かれる。そこで、そういった自然的な形や線をロボットに入れ込むことで、naturalなロボットを作ることができるのかについて考えた。";
    }
}
