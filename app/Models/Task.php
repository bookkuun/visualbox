<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * マスアサインメントが可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'task_kind_id',
        'detail',
        'task_status_id',
        'created_user_id',
        'updated_user_id',
        'assigner_id',
        'task_category_id',
        'due_date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'due_date'
    ];

    /**
     * タスクを所有しているユーザーを取得.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id')->withDefault();
    }

    /**
     * タスクを所有しているプロジェクトを取得.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'created_user_id')->withDefault();
    }

    /**
     * タスクのコメントを取得.
     */
    public function task_comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    /**
     * タスクの種別を取得.
     */
    public function task_kind()
    {
        return $this->belongsTo(TaskKind::class, 'task_kind_id');
    }

    /**
     * タスクの状態を取得.
     */
    public function task_status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    /**
     * タスクのカテゴリーを取得.
     */
    public function task_category()
    {
        return $this->belongsTo(TaskCategory::class, 'task_category_id');
    }

    /**
     * タスクの担当者を取得.
     */
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    /**
     * タスクを作成する
     */
    public static function createTask($project, $request)
    {
        DB::beginTransaction();
        try {
            $task = Task::create([
                'project_id' => $project->id,
                'task_kind_id' => $request->task_kind_id,
                'name' => $request->name,
                'detail' => $request->detail,
                'task_status_id' => $request->task_status_id,
                'assigner_id' => $request->assigner_id,
                'task_category_id' => $request->task_category_id,
                'due_date' => $request->due_date,
                'created_user_id' => $request->user()->id,
            ]);
            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            $task = null;
        }
        return $task;
    }
}
