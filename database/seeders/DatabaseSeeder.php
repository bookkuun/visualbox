<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TaskCategory::class);
        $this->call(TaskKind::class);
        $this->call(TaskStatus::class);
        $this->call(UserAuthority::class);
        $this->call(User::class);

        // User::factory(10)->create()->each(function ($user) {
        //     Project::factory(5)->create(['user_id' => $user->id]);
        //     // ↑$user->idの->id部分は省略可能
        // });
    }
}
