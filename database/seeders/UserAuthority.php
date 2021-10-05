<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserAuthority extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserAuthority::insert([
            ['name' => '閲覧', 'display_order' => 1],
            ['name' => '編集', 'display_order' => 2],
            ['name' => '管理者', 'display_order' => 3],
        ]);
    }
}
