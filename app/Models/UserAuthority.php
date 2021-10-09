<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuthority extends Model
{
    use HasFactory;

    const PROJECT_VIEWER = 1;
    const PROJECT_EDITOR = 2;
    const PROJECT_ADMIN = 3;
}
