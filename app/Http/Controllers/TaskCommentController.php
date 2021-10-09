<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCommentRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCommentController extends Controller
{
    public function store(TaskCommentRequest $request, Project $project, Task $task)
    {

        $comment = TaskComment::createComment($task, $request->input('comment'), Auth::user());

        if ($comment) {
            $flash = ['success' => __('Comment created successfully.')];
        } else {
            $flash = ['error' => __('Failed to create the comment.')];
        }

        return redirect()->route('tasks.show', ['project' => $project->id, 'task' => $task->id])
            ->with($flash);
    }

    public function update(Request $request, $id)
    {
        // なし
    }

    public function destroy(Project $project, Task $task, TaskComment $comment)
    {
        if ($comment->delete()) {
            $flash = ['success' => __('Comment deleted successfully.')];
        } else {
            $flash = ['error' => __('Failed to delete the comment.')];
        }

        return redirect()
            ->route('tasks.edit', ['project' => $project->id, 'task' => $task->id])
            ->with($flash);
    }
}
