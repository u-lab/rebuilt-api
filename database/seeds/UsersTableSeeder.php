<?php

use App\User;
use Faker\Factory;
use App\Models\UserInfo;
use App\Models\UserRole;
use App\Models\UserPortfolio;
use App\Models\UserProfile;
use App\Models\UserSnsAccount;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create();
    }

    /**
     * @return void
     */
    private function create(): void
    {
        $faker = Factory::create('ja_JP');
        $user = User::create(['name' => 'admin', 'email' => 'admin@example.com', 'password' => bcrypt("password")]);
        UserInfo::create([
            'user_id'     => $user->id,
            'last_name'   => $faker->lastName,
            'first_name'  => $faker->firstName,
            'school_name' => $faker->city . '学校',
            'birthday'    => $faker->dateTimeBetween('-80 years', '-12years')->format('Y-m-d'),
            'prefecture'  => '東京都',
            'city'        => $faker->city,
            'street'      => $faker->streetAddress
        ]);
        UserPortfolio::create([
            'user_id'                => $user->id,
            'masterpiece_storage_id' => "1581315433ra05d0",
            'long_comment'           => $faker->sentence(3),
        ]);
        UserProfile::create([
            'user_id'        => $user->id,
            'nick_name'      => $faker->userName,
            'job_name'       => $faker->jobTitle,
            'hobby'          => $faker->words[0],
            'description'    => $faker->sentence(3),
            'icon_image_url' => $faker->url,
            'web_address'    => $faker->url
        ]);
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => '3'
        ]);
        UserSnsAccount::create([
            'user_id' => $user->id,
            'sns_id'  => 2,
            'sns_url' => $faker->url
        ]);
        UserSnsAccount::create([
            'user_id' => $user->id,
            'sns_id'  => 4,
            'sns_url' => $faker->url
        ]);
    }
}
