<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'comment',
        'user_id',
    ];

    /**
     * コメントのユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
