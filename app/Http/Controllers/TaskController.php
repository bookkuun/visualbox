<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskKind;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function progress(Request $request, Project $project)
    {
        $this->authorize('viewAny', [Task::class, $project]);

        $not_processed_tasks  = $project->tasks->where('task_status_id', TaskStatus::NOT_PROCESSED)->sortBy('due_date');
        $processing_tasks  = $project->tasks->where('task_status_id', TaskStatus::PROCESSING)->sortBy('due_date');
        $processed_tasks  = $project->tasks->where('task_status_id', TaskStatus::PROCESSED)->sortBy('due_date');
        $closed_tasks  = $project->tasks->where('task_status_id', TaskStatus::CLOSED)->sortBy('due_date');

        return view('tasks.progress', compact('project', 'not_processed_tasks', 'processing_tasks', 'processed_tasks', 'closed_tasks'));
    }

    public function index(Request $request, Project $project)
    {
        $this->authorize('viewAny', [Task::class, $project]);

        $request->validate([
            'keyword' => 'max:255',
        ]);

        $keyword = $request->input('keyword');

        $tasks = Task::select('tasks.*')
            ->join('projects', 'tasks.project_id', 'projects.id')
            ->where('project_id', '=', $project->id)
            ->distinct();

        if ($request->has('keyword') && $keyword != '') {
            $tasks = $tasks->where('name', 'like', '%' . $keyword . '%');
        }

        $tasks = $tasks->orderBy('task_status_id', 'asc')->latest()->paginate();

        return view('tasks.index', compact('project', 'tasks', 'keyword'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $task_kinds = TaskKind::all();
        $task_statuses = TaskStatus::all();
        $task_categories = TaskCategory::all();
        $assigners = $project->joinUsers;

        return view('tasks.create', compact('project', 'task_kinds', 'task_statuses', 'task_categories', 'assigners'));
    }

    public function store(TaskRequest $request, Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        if (Task::create([
            'project_id' => $project->id,
            'task_kind_id' => $request->task_kind_id,
            'name' => $request->name,
            'detail' => $request->detail,
            'task_status_id' => $request->task_status_id,
            'assigner_id' => $request->assigner_id,
            'task_category_id' => $request->task_category_id,
            'due_date' => $request->due_date,
            'created_user_id' => $request->user()->id
        ])) {
            $flash = ['success' => __('Task created successfully.')];
        } else {
            $flash = ['error' => __('Failed to create the task.')];
        }

        return redirect()
            ->route('tasks.index', compact('project'))
            ->with($flash);
    }

    public function show(Project $project, Task $task)
    {
        $this->authorize('view', [Task::class, $project]);

        $task_kinds = TaskKind::all();
        $task_statuses = TaskStatus::all();
        $task_categories = TaskCategory::all();
        $assigners = $project->joinUsers;
        $task_comments = $task->task_comments;

        return view('tasks.show',  compact('project', 'task', 'task_kinds', 'task_statuses', 'task_categories', 'assigners', 'task_comments'));
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', [Task::class, $project]);

        $task_kinds = TaskKind::all();
        $task_statuses = TaskStatus::all();
        $task_categories = TaskCategory::all();
        $assigners = $project->joinUsers;
        $task_comments = $task->task_comments;

        return view('tasks.edit', compact('project', 'task', 'task_kinds', 'task_statuses', 'task_categories', 'assigners', 'task_comments'));
    }

    public function update(TaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', [Task::class, $project]);

        if ($task->update($request->all())) {
            $flash = ['success' => __('Task updated successfully.')];
        } else {
            $flash = ['error' => __('Failed to update the task.')];
        }

        return redirect()
            ->route('tasks.show', compact('project', 'task'))
            ->with($flash);
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', [Task::class, $project]);

        if ($task->delete()) {
            $flash = ['success' => __('Task deleted successfully.')];
        } else {
            $flash = ['error' => __('Failed to delete the task.')];
        }

        return redirect()
            ->route('tasks.index', ['project' => $project->id])
            ->with($flash);
    }
}
