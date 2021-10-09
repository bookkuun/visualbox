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

    /**
     * コメントを作成する
     */
    public static function createComment($owner, $task, $comment)
    {
        DB::beginTransaction();
        try {
            $comment = TaskComment::create([
                'task_id' => $task->id,
                'comment' => $comment,
                'user_id' => $owner->id
            ]);

            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            return null;
        }
        return $comment;
    }
}
