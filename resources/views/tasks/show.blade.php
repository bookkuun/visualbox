<x-app-layout>

    @include('partial.task-sidemenu')

    <x-slot name="header">
        <h2>
            {{ $project->title }}
        </h2>
    </x-slot>

    <!-- Validation Errors -->
    <x-validation-errors :errors="$errors" />

    <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-end">
        <x-link-button class="m-2"
            :href="route('tasks.edit', ['project' => $project->id, 'task' => $task->id])">
            編集
        </x-link-button>
    </div>

    <div class="flex flex-col px-8 pt-6 mx-6 rounded-md bg-white">
        <div class="py-5">
            <h3 ">
                {{ __('Task Edit') }}
            </h3>
        </div>

        <div class="  -mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-6 mb-6">
                    <x-label :value="__('Task Kind')" />
                    <x-select :disabled=true :options="$task_kinds" id="task_kind_id" name="task_kind_id"
                        class="block mt-1 w-full" :value="$task->task_kind_id" />
                </div>

                <div class="md:w-full px-3 mb-6">
                    <x-label :value="__('Task Name')" />
                    <x-input :disabled=true name="name" class="block mt-1 w-full" type="text" :value="$task->name" />
                </div>
        </div>

        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-full px-3 mb-6">
                <x-label :value="__('Task Detail')" />
                <x-textarea :disabled=true id="detail" class="block mt-1 w-full " :value=" $task->detail" rows="8" />
            </div>
        </div>

        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-1/4 px-3 mb-6">
                <x-label :value="__('Task Status')" />
                <x-select :disabled=true :options="$task_statuses" id="task_status_id" class="block mt-1 w-full"
                    type="text" :value=" $task->task_status_id" />
            </div>

            <div class="md:w-1/4 px-3 mb-6">
                <x-label :value="__('Assigner')" />
                <x-select :disabled=true :options="$assigners" id="assigner_id" class="block mt-1 w-full " type="text"
                    :value="$task->assigner_id" />
            </div>

            <div class="md:w-1/4 px-3 mb-6">
                <x-label :value="__('Task Category')" />
                <x-select :disabled=true :options="$task_categories" id="task_category_id" class="block mt-1 w-full "
                    type="text" :value="$task->task_category_id" />
            </div>

            <div class="md:w-1/4 px-3 mb-6">
                <x-label :value="__('Due Date')" />
                <x-input :disabled=true id="due_date" class="block mt-1 w-full " type="text"
                    :value="$task->due_date ? $task->due_date->format('Y-m-d') : ''" />
            </div>
        </div>
    </div>

    <div class="mx-6 mt-6">
        {{ __('Task Comment') }}
    </div>
    @foreach ($task_comments as $comment)
        <div class="flex justify-between p-2 mx-6 mb-6 rounded-md bg-white">
            <div class="flex flex-row w-full">
                <div>
                    <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                </div>

                <div class="pl-2 w-full">
                    <div class="flex justify-between">
                        <div>
                            <span class="font-bold text-lg">{{ $comment->user->name }}</span>
                            <br>
                            {{ $comment->created_at }}
                        </div>
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
        <div class="md:flex rounded-md">
            <div class="md:w-full mx-6">
                <x-textarea id="comment" form="store_task_comment"
                    class="block mt-1 w-full {{ $errors->has('comment') ? 'border-red-600' : '' }}" name="comment"
                    :value="old('comment')" rows="8" placeholder="コメント" />
            </div>
        </div>

        <div class="max-w-full mx-auto p-4 sm:px-6 lg:px-8 flex justify-end">
            <x-button class="m-2 px-10">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>

</x-app-layout>
