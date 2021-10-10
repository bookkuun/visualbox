<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\UserAuthority;
use App\Models\UserJoinProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $not_processed_tasks  = $user->myTasks->where('task_status_id', TaskStatus::NOT_PROCESSED)->sortBy('due_date');
        $processing_tasks  = $user->myTasks->where('task_status_id', TaskStatus::PROCESSING)->sortBy('due_date');
        $processed_tasks  = $user->myTasks->where('task_status_id', TaskStatus::PROCESSED)->sortBy('due_date');
        $closed_tasks  = $user->myTasks->where('task_status_id', TaskStatus::CLOSED)->sortBy('due_date');

        return view('dashboard', compact('not_processed_tasks', 'processing_tasks', 'processed_tasks', 'closed_tasks'));
    }

    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'max:255',
        ]);

        $keyword = $request->input('keyword');

        $projects = Project::select('projects.*')
            ->join('user_join_projects', 'projects.id', 'user_join_projects.project_id')
            ->where('user_join_projects.user_id', Auth::id())
            ->distinct();

        if ($request->has('keyword') && $keyword != '') {
            $projects = $projects
                ->where('title', 'like', '%' . $keyword . '%');
        }

        $projects = $projects->latest()->paginate(20);

        return view('projects.index', compact('projects', 'keyword'));
    }

    public function create()
    {
        $users = User::all();
        $user_authorities = UserAuthority::all();
        $project_admin_id = UserAuthority::PROJECT_ADMIN;

        return view('projects.create', compact('users', 'user_authorities', 'project_admin_id'));
    }

    public function store(ProjectRequest $request)
    {
        $owner = Auth::user();
        $project = Project::createProjectWithMembers($owner, $request->input('title'), $request->input('users'));

        if ($project) {
            $flash = ['success' => __('Project created successfully.')];
        } else {
            $flash = ['error' => __('Failed to create the project.')];
        }

        return redirect()
            ->route('projects.index')
            ->with($flash);
    }

    public function show($id)
    {
        // なし
    }

    public function edit(Project $project)
    {
        $users = User::all();
        $user_authorities = UserAuthority::all();
        $project_admin_id = UserAuthority::PROJECT_ADMIN;
        $project_join_members = $project->joinUsers->where('id', '!=', $project->user->id);

        return view('projects.edit', compact('project', 'users', 'user_authorities', 'project_admin_id', 'project_join_members'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->updateProjectWithMembers($request->input('title'), $request->input('users'));

        if ($project) {
            $flash = ['success' => __('Project updated successfully.')];
        } else {
            $flash = ['error' => __('Failed to update the project.')];
        }

        return redirect()
            ->route('projects.edit', $project)
            ->with($flash);
    }

    public function destroy(Project $project)
    {
        if ($project->delete()) {
            $flash = ['success' => __('Project deleted successfully.')];
        } else {
            $flash = ['error' => __('Failed to delete the project.')];
        }

        return redirect()
            ->route('projects.index')
            ->with($flash);
    }
}
