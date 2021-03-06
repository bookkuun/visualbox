<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.project-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="m-6">
        <div class="flex flex-row">
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center border-b-2">
                    <span class="bg-red-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>未対応</h3>
                </div>
                <ul>
                    @foreach ($not_processed_tasks as $task)
                        <li>
                            <a
                                href="{{ route('tasks.edit', ['project' => $task->project->id, 'task' => $task->id]) }}">
                                <div class="rounded border-2 border-gray-400 m-3 text-xs hover:bg-blue-50">
                                    <div class="border-b-2 border-gray-200 bg-red-100 p-1">{{ $task->project->title }}
                                    </div>
                                    <div class="p-1">
                                        <div>タスク名：{{ $task->name }}</div>
                                        <div>種類：{{ $task->task_kind->name }}</div>
                                        <div>
                                            カテゴリ：{{ $task->task_category ? $task->task_category->name : '' }}
                                        </div>
                                        <div>
                                            締め切り：{{ $task->due_date ? $task->due_date->format('Y/m/d') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center border-b-2">
                    <span class="bg-blue-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>対応中</h3>
                </div>
                <ul>
                    @foreach ($processing_tasks as $task)
                        <li>
                            <a
                                href="{{ route('tasks.edit', ['project' => $task->project->id, 'task' => $task->id]) }}">
                                <div class="rounded border-2 border-gray-400 m-3 text-xs hover:bg-blue-50">
                                    <div class="border-b-2 border-gray-200 bg-blue-100 p-1">
                                        {{ $task->project->title }}
                                    </div>
                                    <div class="p-1">
                                        <div>タスク名：{{ $task->name }}</div>
                                        <div>種類：{{ $task->task_kind->name }}</div>
                                        <div>
                                            カテゴリ：{{ $task->task_category ? $task->task_category->name : '' }}
                                        </div>
                                        <div>
                                            締め切り：{{ $task->due_date ? $task->due_date->format('Y/m/d') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center border-b-2">
                    <span class="bg-green-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>対応済み</h3>
                </div>
                <ul>
                    @foreach ($processed_tasks as $task)
                        <li>
                            <a
                                href="{{ route('tasks.edit', ['project' => $task->project->id, 'task' => $task->id]) }}">
                                <div class="rounded border-2 border-gray-400 m-3 text-xs hover:bg-blue-50">
                                    <div class="border-b-2 border-gray-200 bg-green-100 p-1">
                                        {{ $task->project->title }}
                                    </div>
                                    <div class="p-1">
                                        <div>タスク名：{{ $task->name }}</div>
                                        <div>種類：{{ $task->task_kind->name }}</div>
                                        <div>
                                            カテゴリ：{{ $task->task_category ? $task->task_category->name : '' }}
                                        </div>
                                        <div>
                                            締め切り：{{ $task->due_date ? $task->due_date->format('Y/m/d') : '' }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
