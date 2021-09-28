<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskKind extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TaskKind::insert([
            ['name' => 'タスク', 'display_order' => 1],
            ['name' => '連絡', 'display_order' => 2],
            ['name' => '要望', 'display_order' => 3],
            ['name' => 'その他', 'display_order' => 4],
        ]);
    }
}
