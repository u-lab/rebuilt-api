<?php

use App\Models\SnsAccount;
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
        foreach ($inserts as $insert) {
            SnsAccount::create($insert);
        }
    }

    private function insert_datas(): array
    {
        return [
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
    }
}
