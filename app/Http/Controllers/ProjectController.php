<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        if ($project = Project::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
        ])) {
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
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        if ($project = $project->update($request->all())) {
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
