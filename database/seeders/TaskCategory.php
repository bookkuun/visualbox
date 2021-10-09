<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TaskCategory::insert([
            ['name' => '教科指導', 'display_order' => 1],
            ['name' => '生徒指導', 'display_order' => 2],
            ['name' => '校務分掌', 'display_order' => 3],
            ['name' => 'その他', 'display_order' => 4],
        ]);
    }
}
