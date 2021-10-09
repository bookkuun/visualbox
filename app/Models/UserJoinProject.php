<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJoinProject extends Model
{
    use HasFactory;

    /**
     * マスアサインメントが可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'user_authority_id',
    ];

    public static function createJoinGroup($member, $project)
    {
        return self::create([
            'user_id' => (int)$member['id'],
            'project_id' => $project->id,
            'user_authority_id' => (int)$member['authority'],
        ]);
    }
}
