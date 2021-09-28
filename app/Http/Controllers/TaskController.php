<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskKind;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project)
    {

        $tasks = $project->tasks;

        return view('tasks.index', compact('project', 'tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $task_kinds = TaskKind::all();
        $task_statuses = TaskStatus::all();
        $task_categories = TaskCategory::all();
        $assigners = User::all();

        return view('tasks.create', compact('project', 'task_kinds', 'task_statuses', 'task_categories', 'assigners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'task_kind_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string|max:1000',
            'task_status_id' => 'required|integer',
            'assigner_id' => 'nullable|integer',
            'task_category_id' => 'nullable|integer',
            'task_resolution_id' => 'nullable|integer',
            'due_date' => 'nullable|date',
        ]);

        if (Task::create([
            'project_id' => $project->id,
            'task_kind_id' => $request->task_kind_id,
            'name' => $request->name,
            'detail' => $request->detail,
            'task_status_id' => $request->task_status_id,
            'assigner_id' => $request->assigner_id,
            'task_category_id' => $request->task_category_id,
            'due_date' => $request->due_date,
            'created_user_id' => $request->user()->id,
        ])) {
            $flash = ['success' => __('Task created successfully.')];
        } else {
            $flash = ['error' => __('Failed to create the task.')];
        }

        return redirect()
            ->route('tasks.index', compact('project'))
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
