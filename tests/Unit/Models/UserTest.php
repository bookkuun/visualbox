<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserJoinProject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test projects */
    public function プロジェクトのリレーションを返す()
    {
        $user = User::factory()->create();

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
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->tasks);
    }

    /** @test myTasks */
    public function 担当タスクのリレーションを返す()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->myTasks);
    }

    /** @test getAuthorityId */
    // public function プロジェクトでの権限を取得できる()
    // {
    //     $user1 = User::factory()->create();
    //     $user2 = User::factory()->create();
    //     $project = Project::factory()->create();

    //     UserJoinProject::factory()->create([
    //         'user_id' => $user1,
    //         'project_id' => $project,
    //     ]);

    //     $this->assertSame(1, $user1->getAuthorityId($project));
    //     $this->assertFalse($user2->getAuthorityId($project));}
}
