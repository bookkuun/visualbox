<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use App\Models\UserAuthority;
use App\Models\UserJoinProject;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserJoinProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test joinProject */
    function プロジェクトに参加することができる()
    {
        $viewer_user = User::factory()->create();
        $editor_user = User::factory()->create();
        $admin_user = User::factory()->create();

        $project = Project::factory()->create();

        //プロジェクトの権限
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
            "id" => $viewer_user->id,
            "authority" => $project_viewer->id,
        ], [
            "id" => $editor_user->id,
            "authority" => $project_editor->id,
        ], [
            "id" => $admin_user->id,
            "authority" => $project_admin->id,
        ]];

        foreach ($members as $member) {
            UserJoinProject::joinProject($member, $project);
        }

        $this
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
