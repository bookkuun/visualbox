<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    const NOT_PROCESSED = 1;
    const PROCESSING = 2;
    const PROCESSED = 3;
    const CLOSED = 4;
}
