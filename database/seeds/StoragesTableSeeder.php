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
            'eyecatch_image_id'  => 1,
            'web_address'        => $faker->url,
            ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('example/bunny.obj'),
            'extension'  => 'obj'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'release_id'         => $release_id,
            'title'              => '作品2かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => 2,
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('example/home_v1.obj'),
            'extension'  => 'obj'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 1,
            'release_id'         => $release_id,
            'title'              => '作品3かっこいいよ',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => 3,
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('example/home_v1.obj'),
            'extension'  => 'fbx'
        ]);

        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 2,
            'release_id'         => $release_id,
            'title'              => 'WEBエンジニアの最高傑作',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => 3,
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('example/home_v1.obj'),
            'extension'  => 'stl'
        ]);


        $storage = Storage::create([
            'storage_id'         => MyStorage::generateID(),
            'user_id'            => 3,
            'release_id'         => $release_id,
            'title'              => 'ニートは頑張れる',
            'description'        => $faker->sentence(3),
            'long_comment'       => $this->get_long_comment(),
            'eyecatch_image_id'  => 4,
            'web_address'        => $faker->url,
        ]);

        StorageFile::create([
            'storage_id' => $storage->id,
            'url'        => $this->_fileDisk->url('example/home_v1.obj'),
            'extension'  => 'stl'
        ]);
    }

    private function get_long_comment(): string
    {
        return "最近自然の中の曲線や形に興味がある。特にネジバナやサボテンに見られる”螺旋”やバッタの脚を始めとした昆虫の足の曲線が凄く不思議に心が惹かれる。そこで、そういった自然的な形や線をロボットに入れ込むことで、naturalなロボットを作ることができるのかについて考えた。";
    }
}
