<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\UserAuthority;
use App\Models\UserJoinProject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test user */
    public function ユーザーのリレーションを返す()
    {
        $user = User::factory()->create(['name' => 'taro']);
        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $project->user);
        $this->assertSame('taro', $project->user->name);
    }

    /** @test tasks */
    public function タスクのリレーションを返す()
    {
        $count = 5;
        $project = Project::factory()->create();

        Task::factory($count)->create(['project_id' => $project->id]);

        $this->assertInstanceOf(Collection::class, $project->tasks);
        $this->assertSame($count, count($project->tasks));
    }

    /** @test joinUsers */
    public function 参加ユーザーのリレーションを返す()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $project = Project::factory()->create(['user_id' => $user1]);

        //　プロジェクトの権限
        $project_viewer = UserAuthority::factory()->create();
        $project_editor = UserAuthority::factory()->create([
            'name' => '編集',
            'display_order' => UserAuthority::PROJECT_EDITOR,
        ]);
        $project_admin = UserAuthority::factory()->create([
            'name' => '管理者',
            'display_order' => UserAuthority::PROJECT_ADMIN,
        ]);

        $members = [[
            "id" => $user1->id,
            "authority" => $project_viewer->id,
        ], [
            "id" => $user2->id,
            "authority" => $project_editor->id,
        ], [
            "id" => $user3->id,
            "authority" => $project_admin->id,
        ]];

        foreach ($members as $member) {
            UserJoinProject::joinProject($member, $project);
        }

        $this->assertInstanceOf(Collection::class, $project->joinUsers);
        $this->assertSame(3, count($project->joinUsers));
    }

    /** @test createProjectWithMembers */
    public function プロジェクトと参加メンバーを登録できる()
    {
        $viewer_user = User::factory()->create();
        $editor_user = User::factory()->create();
        $admin_user = User::factory()->create();

        // プロジェクトでの権限
        $project_viewer = UserAuthority::factory()->create();
        $project_editor = UserAuthority::factory()->create([
            'name' => '編集',
            'display_order' => UserAuthority::PROJECT_EDITOR,
        ]);
        $project_admin = UserAuthority::factory()->create([
            'name' => '管理者',
            'display_order' => UserAuthority::PROJECT_ADMIN,
        ]);

        $title = 'プロジェクトA';

        $members = [
            [
                "id" => $viewer_user->id,
                "authority" => $project_viewer->id,
            ],
            [
                "id" => $editor_user->id,
                "authority" => $project_editor->id,
            ],
            [
                "id" => $admin_user->id,
                "authority" => $project_admin->id,
            ],
        ];

        Project::createProjectWithMembers($admin_user, $title, $members);

        $this
            ->assertDatabaseHas('projects', [
                "title" => 'プロジェクトA',
                "user_id" => $admin_user->id,
            ])
            ->assertDatabaseHas('user_join_projects', [
                "id" => $viewer_user->id,
                "user_authority_id" => UserAuthority::PROJECT_VIEWER,
            ])
            ->assertDatabaseHas('user_join_projects', [
                "id" => $editor_user->id,
                "user_authority_id" => UserAuthority::PROJECT_EDITOR,
            ])
            ->assertDatabaseHas('user_join_projects', [
                "id" => $admin_user->id,
                "user_authority_id" => UserAuthority::PROJECT_ADMIN,
            ]);
    }
}
