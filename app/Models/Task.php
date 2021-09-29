<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'task_resolution_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'due_date'
    ];

    /**
     * 課題種別を取得.
     */
    public function task_kind()
    {
        return $this->belongsTo(TaskKind::class, 'task_kind_id');
    }

    /**
     * 課題状態を取得.
     */
    public function task_status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    /**
     * 課題を所有しているユーザーを取得.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_user_id')->withDefault();
    }

    /**
     * 課題を所有しているプロジェクトを取得.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'created_user_id')->withDefault();
    }

    /**
     * 課題を更新したユーザーを取得.
     */
    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    /**
     * 課題の担当者を取得.
     */
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }

    /**
     * 課題カテゴリーを取得.
     */
    public function task_category()
    {
        return $this->belongsTo(TaskCategory::class, 'task_category_id');
    }

    /**
     * 課題の完了理由を取得.
     */
    public function task_resolution()
    {
        return $this->belongsTo(TaskResolution::class, 'task_resolution_id');
    }

    /**
     * 課題のコメントを取得.
     */
    public function task_comments()
    {
        return $this->hasMany(TaskComment::class);
    }
}
