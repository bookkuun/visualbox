<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserAuthority;
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
    public function プロジェクトでの権限を取得できる()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $project_viewer = UserAuthority::factory()->create();
        $project_editor = UserAuthority::factory()->create([
            'name' => '編集',
            'display_order' => 2,
        ]);
        $project_admin = UserAuthority::factory()->create([
            'name' => '管理者',
            'display_order' => 3,
        ]);

        $title = 'おはようございます。';

        $members = [
            [
                "id" => $user1->id,
                "authority" => $project_admin->id,
            ],
            [
                "id" => $user2->id,
                "authority" => $project_editor->id,
            ]
        ];

        $project = Project::createProjectWithMembers($user1, $title, $members);

        $user1_authority_id = $user1->getAuthorityId($project);

        $this->assertSame(3, (int)$user1_authority_id);
    }
}
