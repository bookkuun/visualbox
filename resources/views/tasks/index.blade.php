<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.task-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>{{ $project->title }}</h2>
    </x-slot>

    {{-- メッセージ --}}
    <x-flash-message />
    <x-validation-errors :errors="$errors" />

    <div class="m-6">
        <div class="text-xl mb-6">
            <h3>{{ __('Tasks') }}</h3>
        </div>

        {{-- 検索フォーム予定 --}}

        @if (0 < $tasks->count())
            <div class="bg-white rounded">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 leading-normal">
                            <th class="py-3 px-6 text-left">タスク種別</th>
                            <th class="py-3 px-6 text-left">タスク名</th>
                            <th class="py-3 px-6 text-left">担当者</th>
                            <th class="py-3 px-6 text-center">締め切り</th>
                            <th class="py-3 px-6 text-center">作成日</th>
                            <th class="py-3 px-6 text-center">更新日</th>
                            <th class="py-3 px-6 text-center">タスク作成者</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-light">
                        @foreach ($tasks as $task)
                            <tr class="border-b border-gray-200 @if ($loop->even)bg-gray-50 @endif">
                                <td class="py-3 px-6 text-left">
                                    {{ $task->task_kind->name }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <a class="underline font-medium text-gray-600 hover:text-gray-900"
                                        href="{{ route('tasks.show', ['project' => $project->id, 'task' => $task->id]) }}">{{ $task->name }}</a>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    @if (isset($task->assigner))
                                        {{ $task->assigner->name }}
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if (isset($task->due_date))
                                        {{ $task->due_date->format('Y/m/d') }}
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $task->created_at->format('Y/m/d') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $task->updated_at->format('Y/m/d') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $task->user->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ml-6 mb-6">
                タスクの登録はありません。
            </div>
        @endif

</x-app-layout>
