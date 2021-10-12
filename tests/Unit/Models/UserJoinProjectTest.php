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
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $project_viewer = UserAuthority::factory()->create();
        $project_editor = UserAuthority::factory()->create([
            'name' => '編集',
            'display_order' => 2,
        ]);
        $project_admin = UserAuthority::factory()->create([
            'name' => '管理者',
            'display_order' => 3,
        ]);

        $member = [
            "id" => $user->id,
            "authority" => $project_admin->id,
        ];

        UserJoinProject::joinProject($member, $project);

        $this->assertDatabaseHas('user_join_projects', [
            "id" => 1,
            "user_authority_id" => 3,
        ]);
    }
}
