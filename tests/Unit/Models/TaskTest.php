<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskComment;
use App\Models\TaskKind;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test user */
    public function ユーザーのリレーションを返す()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(User::class, $task->user);
    }

    /** @test project */
    public function プロジェクトのリレーションを返す()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }

    /** @test comments */
    public function コメントのリレーションを返す()
    {
        $task = Task::factory()
            ->has(TaskComment::factory()->count(3), 'task_comments')
            ->create();


        $this->assertInstanceOf(Collection::class, $task->task_comments);
    }

    /** @test task_kind */
    public function タスク種別のリレーションを返す()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(TaskKind::class, $task->task_kind);
    }

    /** @test task_kind */
    public function タスク状態のリレーションを返す()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(TaskStatus::class, $task->task_status);
    }

    /** @test task_category */
    public function タスクカテゴリのリレーションを返す()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(TaskCategory::class, $task->task_category);
    }

    /** @test assigner(user) */
    public function タスク担当者のリレーションを返す()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(User::class, $task->assigner);
    }
}
