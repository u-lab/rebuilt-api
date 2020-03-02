<?php

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::create([
            'id'    => "9ae0b301-b7d4-4eed-a150-31b0a9e4f870",
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('storages/example/bunny.png')
        ]);

        Image::create([
            'id'    => "1d5079ac-4f29-4437-8b53-3747edfd4457",
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('storages/example/home_v1_obj_eye_catch.png')
        ]);

        Image::create([
            'id'    => "ebf559f5-61c2-43c7-a108-48c5527c4ac8",
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('storages/example/home_v1_fbx_eye_catch.png')
        ]);

        Image::create([
            'id'    => "985d085b-0c41-4ee0-b33c-8476bb85d115",
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('storages/example/ウサギ_eye_catch.png')
        ]);

        Image::create([
            'id'    => "faf0aa05-8dad-4691-8409-8618b6c8146c",
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('storages/example/home_v1_stl_eye_catch.png')
        ]);

        Image::create([
            'id'    => "868de826-9d9f-45f5-9a29-94dee6d3be96",
            'title' => "icon_image",
            'url'   => "https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.jpg?s=200&d=mm"
        ]);
    }
}
