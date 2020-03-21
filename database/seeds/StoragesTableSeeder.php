<?php

use Faker\Factory;
use Carbon\Carbon;
use App\Models\Storage;
use App\Facades\MyStorage;
use App\Models\Release;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class StoragesTableSeeder extends Seeder
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $_fileDisk;

    public function __construct()
    {
        $this->_fileDisk = FacadesStorage::disk('public');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ja_JP');

        $release_id = Release::whereReleaseName('public')->get()->first()->id;

        $storage = Storage::create([
            'storage_id'         => "1581315433ra05d0",
            'user_id'            => 1,
            'release_id'         => $release_id,
            'title'              => '作品1かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => "9ae0b301-b7d4-4eed-a150-31b0a9e4f870",
            'web_address'        => $faker->url,
            ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('storages/example/bunny.obj'),
            'extension'  => 'obj'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'release_id'         => $release_id,
            'title'              => '作品2かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => "1d5079ac-4f29-4437-8b53-3747edfd4457",
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('storages/example/home_v1.obj'),
            'extension'  => 'obj'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'release_id'         => $release_id,
            'title'              => '作品3かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => "ebf559f5-61c2-43c7-a108-48c5527c4ac8",
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('storages/example/home_v1.fbx'),
            'extension'  => 'fbx'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 2,
            'release_id'         => $release_id,
            'title'              => 'WEBエンジニアの最高傑作',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => "985d085b-0c41-4ee0-b33c-8476bb85d115",
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('storages/example/ウサギ.stl'),
            'extension'  => 'stl'
        ]);


        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 3,
            'release_id'         => $release_id,
            'title'              => 'ニートは頑張れる',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => "faf0aa05-8dad-4691-8409-8618b6c8146c",
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('storages/example/home_v1.stl'),
            'extension'  => 'stl'
        ]);
    }

    private function get_long_comment(): string
    {
        return "最近自然の中の曲線や形に興味がある。特にネジバナやサボテンに見られる”螺旋”やバッタの脚を始めとした昆虫の足の曲線が凄く不思議に心が惹かれる。そこで、そういった自然的な形や線をロボットに入れ込むことで、naturalなロボットを作ることができるのかについて考えた。";
    }
}
