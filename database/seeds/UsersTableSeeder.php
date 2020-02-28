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
        $data_inserts = $this->insert_datas();

        foreach ($data_inserts as $insert) {
            $user = User::create([
                'name'     => $insert['name'],
                'email'    => $insert['email'],
                'password' => $insert['password']
            ]);

            UserInfo::create([
                'user_id'     => $user->id,
                'last_name'   => $insert["last_name"],
                'first_name'  => $insert["first_name"],
                'school_name' => $insert["school_name"],
                'birthday'    => $insert["birthday"],
                'prefecture'  => $insert["prefecture"],
                'city'        => $insert["city"],
                'street'      => $insert["street"]
            ]);

            UserPortfolio::create([
                'user_id'                => $user->id,
                'masterpiece_storage_id' => $insert["masterpiece_storage_id"],
                'long_comment'           => $insert["long_comment"],
            ]);

            UserProfile::create([
                'user_id'        => $user->id,
                'nick_name'      => $insert["nick_name"],
                'job_name'       => $insert["job_name"],
                'hobby'          => $insert["hobby"],
                'description'    => $insert["description"],
                'icon_image_url' => $insert["icon_image_url"],
                'web_address'    => $insert["web_address"]
            ]);

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $insert["role_id"]
            ]);

            UserSnsAccount::create([
                'user_id' => $user->id,
                'sns_id'  => $insert["sns_id1"],
                'sns_url' => $insert["sns_url1"]
            ]);

            UserSnsAccount::create([
                'user_id' => $user->id,
                'sns_id'  => $insert["sns_id2"],
                'sns_url' => $insert["sns_url2"]
            ]);
        }
    }

    private function insert_datas()
    {
        $faker = Factory::create('ja_JP');

        return [
            [
                'name'                   => 'admin',
                'email'                  => 'admin@example.com',
                'password'               => bcrypt("password"),
                'last_name'              => '山田',
                'first_name'             => '太郎',
                'school_name'            => '東京大学',
                'birthday'               => $faker->dateTimeBetween('-80 years', '-12years')->format('Y-m-d'),
                'prefecture'             => '東京都',
                'city'                   => '千代田区',
                'street'                 => $faker->streetAddress,
                'masterpiece_storage_id' => "1581315433ra05d0",
                'long_comment'           => $this->get_long_comment(),
                'nick_name'              => 'ヤマダマン',
                'job_name'               => '天才Unityエンジニア',
                'hobby'                  => '建築モデルづくり',
                'description'            => $this->description(),
                'icon_image_url'         => "https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.jpg?s=200&d=mm",
                'web_address'            => "https://github.com/u-lab/rebuilt-api",
                'role_id'                => "3",
                'sns_id1'                => "1",
                'sns_url1'               => "https://twitter.com/U_lab0811
    ",
                'sns_id2'                => "2",
                'sns_url2'               => "https://www.instagram.com/ulab_uu/
    "
            ],
            [
                'name'                   => 'aaa',
                'email'                  => 'aaa@example.com',
                'password'               => bcrypt("password"),
                'last_name'              => '佐藤',
                'first_name'             => '健太郎',
                'school_name'            => '宇都宮大学',
                'birthday'               => $faker->dateTimeBetween('-80 years', '-12years')->format('Y-m-d'),
                'prefecture'             => '栃木県',
                'city'                   => '宇都宮市',
                'street'                 => $faker->streetAddress,
                'masterpiece_storage_id' => "1581315433ka05d0",
                'long_comment'           => $this->get_long_comment(),
                'nick_name'              => 'ケンタロウ',
                'job_name'               => 'HENTAI-WEB Enginner',
                'hobby'                  => '読書',
                'description'            => $this->description(),
                'icon_image_url'         => "https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.jpg?s=200&d=mm",
                'web_address'            => "https://github.com/u-lab/rebuilt",
                'role_id'                => "2",
                'sns_id1'                => "1",
                'sns_url1'               => "https://twitter.com/U_lab0811
    ",
                'sns_id2'                => "2",
                'sns_url2'               => "https://www.instagram.com/ulab_uu/
    "
            ],
            [
                'name'                   => 'bbb',
                'email'                  => 'bbb@example.com',
                'password'               => bcrypt("password"),
                'last_name'              => '高橋',
                'first_name'             => '拓哉',
                'school_name'            => '栃木大学',
                'birthday'               => $faker->dateTimeBetween('-80 years', '-12years')->format('Y-m-d'),
                'prefecture'             => '栃木県',
                'city'                   => '栃木市',
                'street'                 => $faker->streetAddress,
                'masterpiece_storage_id' => "1581315433ja05d0",
                'long_comment'           => $this->get_long_comment(),
                'nick_name'              => 'タカタク',
                'job_name'               => '人生の夏休み中',
                'hobby'                  => 'ゲーム',
                'description'            => $this->description(),
                'icon_image_url'         => "https://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61.jpg?s=200&d=mm",
                'web_address'            => "https://github.com/u-lab",
                'role_id'                => "2",
                'sns_id1'                => "1",
                'sns_url1'               => "https://twitter.com/U_lab0811
    ",
                'sns_id2'                => "2",
                'sns_url2'               => "https://www.instagram.com/ulab_uu/
    "
            ]
        ];
    }

    private function description(): string
    {
        return "チューハイよりウイスキー派";
    }

    private function get_long_comment(): string
    {
        return "最近自然の中の曲線や形に興味がある。特にネジバナやサボテンに見られる”螺旋”やバッタの脚を始めとした昆虫の足の曲線が凄く不思議に心が惹かれる。そこで、そういった自然的な形や線をロボットに入れ込むことで、naturalなロボットを作ることができるのかについて考えた。";
    }
}
