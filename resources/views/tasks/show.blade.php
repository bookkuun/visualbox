<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.task-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>プロジェクト名：{{ $project->title }}</h2>
    </x-slot>

    {{-- メッセージ --}}
    <x-flash-message />

    <div class="m-6">
        @can('projectEditorOrMore', $project)
            <div class="flex justify-end mb-3">
                <x-link-button class="m-2"
                    :href="route('tasks.edit', ['project' => $project->id, 'task' => $task->id])">
                    編集
                </x-link-button>
            </div>
        @endcan

        <div class="rounded-md bg-white p-6">
            <div class="text-xl mb-3">
                <h3>{{ __('Task Edit') }}</h3>
            </div>

            <div class="flex mb-6">
                <div class="w-1/2">
                    <x-label :value="__('Task Kind')" />
                    <x-select :disabled=true :options="$task_kinds" id="task_kind_id" class="block mt-1 w-full"
                        :value="$task->task_kind_id" />
                </div>

                <div class="w-full pl-3">
                    <x-label :value="__('Task Name')" />
                    <x-input :disabled=true class="block mt-1 w-full" type="text" :value="$task->name" />
                </div>
            </div>

            <div class="flex mb-6">
                <div class="w-full">
                    <x-label :value="__('Task Detail')" />
                    <x-textarea :disabled=true id="detail" class="block mt-1 w-full " :value="$task->detail" rows="5" />
                </div>
            </div>

            <div class="flex mb-6">
                <div class="w-1/4">
                    <x-label :value="__('Task Status')" />
                    <x-select :disabled=true :options="$task_statuses" id="task_status_id" class="block mt-1 w-full"
                        type="text" :value=" $task->task_status_id" />
                </div>

                <div class="w-1/4 mx-3">
                    <x-label :value="__('Assigner')" />
                    <x-select :disabled=true :options="$assigners" id="assigner_id" class="block mt-1 w-full "
                        type="text" :value="$task->assigner_id" />
                </div>

                <div class="w-1/4 mx-3">
                    <x-label :value="__('Task Category')" />
                    <x-select :disabled=true :options="$task_categories" id="task_category_id"
                        class="block mt-1 w-full " type="text" :value="$task->task_category_id" />
                </div>

                <div class="w-1/4">
                    <x-label :value="__('Due Date')" />
                    <x-input :disabled=true id="due_date" class="block mt-1 w-full " type="text"
                        :value="$task->due_date ? $task->due_date->format('Y-m-d') : ''" />
                </div>
            </div>
        </div>

        <div class="mt-6">
            {{ __('Task Comment') }}
        </div>
        @foreach ($task_comments as $comment)
            <div class="rounded-md bg-white p-3 my-3">
                <div class="flex flex-row w-full">
                    <div>
                        <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                    </div>

                    <div class="pl-2 w-full">

                        <div>
                            <span class="font-bold text-lg">{{ $comment->user->name }}</span>
                            <br>
                            {{ $comment->created_at }}
                        </div>

                        <div class="my-2 w-full">
                            {!! nl2br(e($comment->comment)) !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <form id="store_task_comment" method="POST"
            action="{{ route('comments.store', ['project' => $project->id, 'task' => $task->id]) }}">
            @csrf
            <div class="flex rounded-md">
                <div class="w-full">
                    <x-textarea id="comment" form="store_task_comment"
                        class="block mt-1 w-full {{ $errors->has('comment') ? 'border-red-600' : '' }}" name="comment"
                        :value="old('comment')" rows="4" placeholder="コメント" />
                </div>
            </div>

            <div class="w-full flex justify-end mt-5">
                <x-button class="px-10">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
