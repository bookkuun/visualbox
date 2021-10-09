<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    /**
     * プロジェクトに参加しているユーザー取得.
     */
    public function joinUsers()
    {
        return $this->belongsToMany(User::class, 'user_join_projects', 'project_id', 'user_id');
    }

    public static function createProjectWithMembers($title, $user_id, $users)
    {
        DB::beginTransaction();

        try {
            $project = self::create([
                'title' => $title,
                'user_id' => $user_id,
            ]);

            foreach ($users as $member) {
                UserJoinProject::createJoinGroup($member, $project);
            }

            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            return null;
        }
        return $project;
    }

    public function updateProjectWithMembers($title, $users)
    {
        DB::beginTransaction();

        try {
            $this->update([
                'title' =>  $title
            ]);

            foreach ($users as $member) {
                $user = User::find((int)$member['id']);
                if ($user->getAuthorityId($this)) {
                    UserJoinProject::where('user_id', (int)$member['id'])
                        ->where('project_id', $this->id)
                        ->update([
                            'user_authority_id' => (int)$member['authority'],
                        ]);
                } else {
                    UserJoinProject::createJoinGroup($member, $this);
                }
            }

            DB::commit();
        } catch (\Throwable $error) {
            DB::rollBack();
            return null;
        }
    }
}
