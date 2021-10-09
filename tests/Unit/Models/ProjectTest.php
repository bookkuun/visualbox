<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
}
