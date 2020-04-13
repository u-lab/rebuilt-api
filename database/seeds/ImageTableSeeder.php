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
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('example/bunny_eye_catch.png')
        ]);

        Image::create([
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('example/home_v1_obj_eye_catch.png')
        ]);

        Image::create([
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('example/home_v1_fbx_eye_catch.png')
        ]);

        Image::create([
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('example/ウサギ_eye_catch.png')
        ]);

        Image::create([
            'title' => "eyecatch_image",
            'url'   => Storage::disk('public')->url('example/home_v1_stl_eye_catch.png')
        ]);

        Image::create([
            'title' => "icon_image",
            'url'   => "https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.jpg?s=200&d=mm"
        ]);
    }
}
