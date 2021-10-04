<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\UserAuthority;
use App\Models\UserJoinProject;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
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
        $projects = Project::paginate(20);

        if ($request->has('keyword') && $keyword != '') {
            $projects = Project::where('title', 'like', '%' . $keyword . '%')->paginate(20);
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
            foreach ($request->users as $user) {
                UserJoinProject::create([
                    'user_id' => (int)$user['id'],
                    'project_id' => $project->id,
                    'user_authority_id' => (int)$user['authority'],
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
        $users = $project->joinUsers()->get();

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
        if ($project->update($request->all())) {
            $flash = ['success' => __('Project updated successfully.')];
        } else {
            $flash = ['error' => __('Failed to update the project.')];
        }

        return redirect()
            ->route('projects.index', $project)
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
