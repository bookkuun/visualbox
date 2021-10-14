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
        $user = User::factory()->create(['name' => 'taro']);
        $task = Task::factory()->create(['created_user_id' => $user->id,]);

        $this->assertInstanceOf(User::class, $task->user);
        $this->assertSame('taro', $task->user->name);
    }

    /** @test project */
    public function プロジェクトのリレーションを返す()
    {
        $project = Project::factory()->create(['title' => 'プロジェクトA']);
        $task = Task::factory()->create(['project_id' => $project->id,]);

        $this->assertInstanceOf(Project::class, $task->project);
        $this->assertSame('プロジェクトA', $task->project->title);
    }

    /** @test comments */
    public function コメントのリレーションを返す()
    {
        $count = 5;
        $task = Task::factory()->create();
        TaskComment::factory($count)->create(['task_id' => $task->id]);

        $this->assertInstanceOf(Collection::class, $task->task_comments);
        $this->assertSame($count, count($task->task_comments));
    }

    /** @test task_kind */
    public function タスク種別のリレーションを返す()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(TaskKind::class, $task->task_kind);
        $this->assertSame('タスク', $task->task_kind->name);
    }


    /** @test task_kind */
    public function タスク状態のリレーションを返す()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(TaskStatus::class, $task->task_status);
        $this->assertSame('未対応', $task->task_status->name);
    }

    /** @test task_category */
    public function タスクカテゴリのリレーションを返す()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(TaskCategory::class, $task->task_category);
        $this->assertSame('教科指導', $task->task_category->name);
    }

    /** @test assigner(user) */
    public function タスク担当者のリレーションを返す()
    {
        $user = User::factory()->create(['name' => 'taro']);
        $task = Task::factory()->create(['assigner_id' => $user->id]);

        $this->assertInstanceOf(User::class, $task->assigner);
        $this->assertSame('taro', $task->assigner->name);
    }
}
