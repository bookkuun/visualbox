<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

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
}
