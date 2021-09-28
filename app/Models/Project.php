<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * マスアサインメントが可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
        // withDefault()はnullを回避できるようになる
    }

    /**
     * プロジェクトを所有している課題を取得.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
