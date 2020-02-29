<?php

use Faker\Factory;
use Carbon\Carbon;
use App\Models\Storage;
use App\Facades\MyStorage;
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

        Storage::create([
            'storage_id'         => "1581315433ra05d0",
            'user_id'            => 1,
            'title'              => '作品1かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'storage_url'        => FacadesStorage::disk('public')->url('storages/example/bunny.obj'),
            'eyecatch_image_url' => FacadesStorage::disk('public')->url('storages/example/bunny_eye_catch.png'),
            'web_address'        => $faker->url,
        ]);

        Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'title'              => '作品2かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'storage_url'        => FacadesStorage::disk('public')->url('storages/example/home_v1.obj'),
            'eyecatch_image_url' => FacadesStorage::disk('public')->url('storages/example/home_v1_obj_eye_catch.png'),
            'web_address'        => $faker->url,
        ]);


        Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'title'              => '作品3かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'storage_url'        => FacadesStorage::disk('public')->url('storages/example/home_v1.fbx'),
            'eyecatch_image_url' => FacadesStorage::disk('public')->url('storages/example/home_v1_fbx_eye_catch.png'),
            'web_address'        => $faker->url,
        ]);

        Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 2,
            'title'              => 'WEBエンジニアの最高傑作',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'storage_url'        => FacadesStorage::disk('public')->url('storages/example/ウサギ.stl'),
            'eyecatch_image_url' => FacadesStorage::disk('public')->url('storages/example/ウサギ_eye_catch.png'),
            'web_address'        => $faker->url,
        ]);

        Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 3,
            'title'              => 'ニートは頑張れる',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'storage_url'        => FacadesStorage::disk('public')->url('storages/example/home_v1.stl'),
            'eyecatch_image_url' => FacadesStorage::disk('public')->url('storages/example/home_v1_stl_eye_catch.png'),
            'web_address'        => $faker->url,
        ]);
    }

    private function get_long_comment(): string
    {
        return "最近自然の中の曲線や形に興味がある。特にネジバナやサボテンに見られる”螺旋”やバッタの脚を始めとした昆虫の足の曲線が凄く不思議に心が惹かれる。そこで、そういった自然的な形や線をロボットに入れ込むことで、naturalなロボットを作ることができるのかについて考えた。";
    }
}
