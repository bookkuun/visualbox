<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test projects */
    public function プロジェクトのリレーションを返す()
    {
        $user = User::factory()
            ->has(Project::factory()->count(3))
            ->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test joinProjects */
    public function 参加プロジェクトのリレーションを返す()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->joinProjects);
    }

    /** @test tasks */
    public function タスクのリレーションを返す()
    {
        $user = User::factory()
            ->has(Task::factory()->count(3))
            ->create();

        $this->assertInstanceOf(Collection::class, $user->tasks);
    }

    /** @test myTasks */

    /** @test own */

    /** @test getAuthorityId */
}
