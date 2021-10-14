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
        $count = 5;
        $user = User::factory()->create();
        Project::factory($count)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->projects);
        $this->assertSame($count, count($user->projects));
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
        $count = 5;
        $user = User::factory()->create();
        Task::factory($count)->create(['created_user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->tasks);
        $this->assertSame($count, count($user->tasks));
    }

    /** @test myTasks */
    public function 担当タスクのリレーションを返す()
    {
        $count = 5;

        $user = User::factory()->create();

        Task::factory($count)->create(['assigner_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->myTasks);
        $this->assertSame($count, count($user->myTasks));
    }

    /** @test getAuthorityId */
    public function プロジェクトでの権限を取得できる()
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

        $project = Project::createProjectWithMembers($admin_user, $title, $members);

        $authority1_id = $viewer_user->getAuthorityId($project);
        $authority2_id = $editor_user->getAuthorityId($project);
        $authority3_id = $admin_user->getAuthorityId($project);

        $this->assertSame(UserAuthority::PROJECT_VIEWER, $authority1_id);
        $this->assertSame(UserAuthority::PROJECT_EDITOR, $authority2_id);
        $this->assertSame(UserAuthority::PROJECT_ADMIN, $authority3_id);
    }
}
