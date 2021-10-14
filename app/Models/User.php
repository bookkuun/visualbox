<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーがを所有しているプロジェクトを取得.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * ユーザーがを参加しているプロジェクトを取得.
     */
    public function joinProjects()
    {
        return $this->belongsToMany(Project::class, 'user_join_projects', 'user_id', 'project_id');
    }

    /**
     * ユーザーが作成したタスクを取得.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'created_user_id');
    }

    /**
     * ユーザーの担当タスクを取得.
     */
    public function myTasks()
    {
        return $this->hasMany(Task::class, 'assigner_id');
    }

    /**
     * ユーザーがプロジェクトにどのような権限があるかを取得
     */
    public function getAuthorityId($project)
    {
        $record = UserJoinProject::where('user_id', '=', $this->id)->where('project_id', '=', $project->id)->first();

        return $record ? (int) $record->user_authority_id : null;
    }
}
