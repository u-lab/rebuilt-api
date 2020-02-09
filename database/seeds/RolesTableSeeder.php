<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;

class RolesTableSeeder extends Seeder
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
     * Roleにデータを挿入
     *
     * @return void
     */
    private function create(): void
    {
        $inserts = $this->insert_datas();
        foreach ($inserts as $insert) {
            Role::updateOrCreate($insert);
        }
    }

    /**
     * 挿入データ
     *
     * @return array
     */
    private function insert_datas(): array
    {
        return [
            [
                'role_name' => 'ban',
                'role_level' => 5
            ],
            [
                'role_name' => 'normal',
                'role_level' => 10
            ],
            [
                'role_name' => 'admin',
                'role_level' => 255
            ]
        ];
    }
}
