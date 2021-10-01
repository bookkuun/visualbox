<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tasks') }}
                </h3>
            </div>
        </div>
    </div>

    {{-- フラッシュメッセージ --}}
    <x-flash-message />

    @if (0 < $tasks->count())
        <div class="flex flex-col mt-3 mx-6 mb-6 bg-white rounded">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-left">
                            タスク種別
                        </th>
                        <th class="py-3 px-6 text-left">
                            タスク名
                        </th>
                        <th class="py-3 px-6 text-left">
                            担当者
                        </th>
                        <th class="py-3 px-6 text-center">
                            締め切り
                        </th>
                        <th class="py-3 px-6 text-center">
                            作成日
                        </th>
                        <th class="py-3 px-6 text-center">
                            更新日
                        </th>
                        <th class="py-3 px-6 text-center">
                            タスク作成者
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($tasks as $task)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer
                        @if ($loop->even)bg-gray-50 @endif"
                            onclick="location.href='{{ route('tasks.show', ['project' => $project->id, 'task' => $task->id]) }}'">
                            <td class="py-3 px-6 text-left">
                                <span>{{ $task->task_kind->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <a class="underline font-medium text-gray-600 hover:text-gray-900"
                                    href="{{ route('tasks.show', ['project' => $project->id, 'task' => $task->id]) }}">{{ $task->name }}</a>
                            </td>
                            <td class="py-3 px-6 text-left">
                                @if (isset($task->assigner))
                                    <span>{{ $task->assigner->name }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if (isset($task->due_date))
                                    <span>{{ $task->due_date->format('Y/m/d') }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $task->created_at->format('Y/m/d') }}</span>
                            </td>

                            <td class="py-3 px-6 text-center">
                                <span>{{ $task->updated_at->format('Y/m/d') }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span>{{ $task->user->name }}</span>
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
