<?php

use App\Models\SnsAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SnsAccountsTableSeeder extends Seeder
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

    private function create()
    {
        $inserts = $this->insert_datas();
        SnsAccount::insert($inserts); // バルクインサートをしているので注意。
    }

    /**
     * バルクインサート用に戻り地にはcreated_at,updated_atを含む
     *
     * @return array
     */
    private function insert_datas(): array
    {
        $inserts = [
            [
                'sns_name'    => 'twitter',
                'sns_top_url' => 'https://twitter.com'
            ],
            [
                'sns_name'    => 'facebook',
                'sns_top_url' => 'https://facebook.com/'
            ],
            [
                'sns_name'    => 'line',
                'sns_top_url' => 'https://line.me'
            ],
            [
                'sns_name'    => 'instagram',
                'sns_top_url' => 'https://www.instagram.com/'
            ],
            [
                'sns_name'    => 'TickTok',
                'sns_top_url' => 'https://www.tiktok.com/'
            ],
            [
                'sns_name'    => 'YouTube',
                'sns_top_url' => 'https://www.youtube.com/'
            ]
        ];

        // Insert用のデータにcreated_atとupdate_atのキーを追加
        $now_array = $this->get_createAt_update_At();
        $ret_inserts = [];
        foreach ($inserts as $insert) {
            $ret_inserts[] = array_merge($insert, $now_array);
        }

        return $ret_inserts;
    }

    /**
     * @return array
     */
    private function get_createAt_update_At(): array
    {
        $now = Carbon::now();

        return [
            'updated_at' => $now,
            'created_at' => $now
        ];
    }
}
