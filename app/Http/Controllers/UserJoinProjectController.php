<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\UserJoinProject;
use Illuminate\Http\Request;

class UserJoinProjectController extends Controller
{
    public function destroy(Project $project, User $user)
    {
        UserJoinProject::where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->delete();

        return [];
    }
}
