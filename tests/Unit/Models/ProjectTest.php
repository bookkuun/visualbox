<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserAuthority;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test user */
    public function ユーザーのリレーションを返す()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->user);
    }

    /** @test tasks */
    public function タスクのリレーションを返す()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(Collection::class, $project->tasks);
    }

    /** @test joinUsers */
    public function 参加ユーザーのリレーションを返す()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(Collection::class, $project->joinUsers);
    }

    /** @test createProjectWithMembers */
    public function プロジェクトと参加メンバーを作成()
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

        Project::createProjectWithMembers($user1, $title, $members);

        $this
            ->assertDatabaseHas('projects', [
                "title" => 'おはようございます。',
                "user_id" => $user1->id,
            ])
            ->assertDatabaseHas('user_join_projects', [
                "id" => 1,
                "user_authority_id" => 3,
            ])
            ->assertDatabaseHas('user_join_projects', [
                "id" => 2,
                "user_authority_id" => 2,
            ]);
    }
}
