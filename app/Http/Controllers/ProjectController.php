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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => 'max:255',
        ]);

        $keyword = $request->input('keyword');

        if ($request->has('keyword') && $keyword != '') {
            $projects = Project::where('title', 'like', '%' . $keyword . '%')->latest()->paginate(20);
        } else {
            $projects = Project::latest()->paginate(20);
        }

        return view('projects.index', compact('projects', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        $user_authorities = UserAuthority::all();

        $admin_id = 3;

        return view('projects.create', compact('users', 'user_authorities', 'admin_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        if ($project = Project::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
        ])) {
            foreach ($request->users as $member) {
                UserJoinProject::create([
                    'user_id' => (int)$member['id'],
                    'project_id' => $project->id,
                    'user_authority_id' => (int)$member['authority'],
                ]);
            }
            $flash = ['success' => __('Project created successfully.')];
        } else {
            $flash = ['error' => __('Failed to create the project.')];
        }

        return redirect()
            ->route('projects.index')
            ->with($flash);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // なし
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $users = User::all();

        $user_authorities = UserAuthority::all();

        $except_author_users = $project->joinUsers()
            ->get()
            ->where('id', '!=', $project->user->id);

        $admin_id = 3;

        return view('projects.edit', compact('project', 'users', 'user_authorities', 'admin_id', 'except_author_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        if (Project::find($project->id)->update([
            'title' => $request->input('title')
        ])) {
            foreach ($request->users as $member) {
                $user = User::find((int)$member['id']);
                if ($user->getAuthorityId($project)) {
                    UserJoinProject::where('user_id', (int)$member['id'])
                        ->where('project_id', $project->id)
                        ->update([
                            'user_authority_id' => (int)$member['authority'],
                        ]);
                } else {
                    UserJoinProject::create([
                        'user_id' => (int)$member['id'],
                        'project_id' => $project->id,
                        'user_authority_id' => (int)$member['authority'],
                    ]);
                }
            }

            $flash = ['success' => __('Project updated successfully.')];
        } else {
            $flash = ['error' => __('Failed to update the project.')];
        }

        return redirect()
            ->route('projects.edit', $project)
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
