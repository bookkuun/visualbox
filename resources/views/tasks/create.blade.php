<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.task-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>プロジェクト名：{{ $project->title }}</h2>
    </x-slot>

    <div class="m-6">
        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('tasks.store', ['project' => $project->id]) }}">
            @csrf

            <!-- Navigation -->
            <div class="flex justify-end mb-3">
                <x-link-button class="m-2" :href="route('tasks.index', ['project' => $project->id])">
                    {{ __('Create Cancel') }}
                </x-link-button>
                <x-button class="m-2 px-10">
                    {{ __('Create') }}
                </x-button>
            </div>

            <div class="rounded-md bg-white p-6">
                <div class="text-xl mb-3">
                    <h3>{{ __('Task Create') }}</h3>
                </div>

                <div class="flex mb-6">
                    <div class="w-1/2">
                        <x-label for="task_kind_id" :value="__('Task Kind')"
                            class="{{ $errors->has('task_kind_id') ? 'text-red-600' : '' }}" />
                        <x-select :options="$task_kinds" id="task_kind_id"
                            class="block mt-1 w-full {{ $errors->has('task_kind_id') ? 'border-red-600' : '' }}"
                            name="task_kind_id" :value="old('task_kind_id')" autofocus required />
                    </div>

                    <div class="w-full pl-3">
                        <x-label for="name" :value="__('Task Name')"
                            class="{{ $errors->has('name') ? 'text-red-600' : '' }}" />
                        <x-input id="name"
                            class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}" type="text"
                            name="name" :value="old('name')" placeholder="{{ __('Task Name') }}" autofocus required />
                    </div>
                </div>

                <div class="flex mb-6">
                    <div class="w-full">
                        <x-label for="detail" :value="__('Task Detail')"
                            class="{{ $errors->has('detail') ? 'text-red-600' : '' }}" />
                        <x-textarea id="detail"
                            class="block mt-1 w-full {{ $errors->has('detail') ? 'border-red-600' : '' }}"
                            name="detail" :value="old('detail')" rows="5" placeholder="{{ __('Task Detail') }}" />
                    </div>
                </div>

                <div class="flex mb-6">
                    <div class="w-1/4">
                        <x-label for="task_status_id" :value="__('Task Status')"
                            class="{{ $errors->has('task_status_id') ? 'text-red-600' : '' }}" />
                        <x-select :options="$task_statuses" id="task_status_id"
                            class="block mt-1 w-full {{ $errors->has('task_status_id') ? 'border-red-600' : '' }}"
                            type="text" name="task_status_id" :value="old('task_status_id')" required autofocus />
                    </div>

                    <div class="w-1/4 mx-3">
                        <x-label for="assigner_id" :value="__('Assigner')"
                            class="{{ $errors->has('assigner_id') ? 'text-red-600' : '' }}" />
                        <x-select :options="$assigners" id="assigner_id"
                            class="block mt-1 w-full {{ $errors->has('assigner_id') ? 'border-red-600' : '' }}"
                            type="text" name="assigner_id" :value="old('assigner_id')" autofocus />
                    </div>

                    <div class="w-1/4 mx-3">
                        <x-label for="task_category_id" :value="__('Task Category')"
                            class="{{ $errors->has('task_category_id') ? 'text-red-600' : '' }}" />
                        <x-select :options="$task_categories" id="task_category_id"
                            class="block mt-1 w-full {{ $errors->has('task_category_id') ? 'border-red-600' : '' }}"
                            type="text" name="task_category_id" :value="old('task_category_id')" autofocus />
                    </div>

                    <div class="w-1/4">
                        <x-label for="due_date" :value="__('Due Date')"
                            class="{{ $errors->has('due_date') ? 'text-red-600' : '' }}" />
                        <input id="due_date"
                            class="block w-full mt-1 py-2 border border-grey-lighter text-grey-darker  rounded shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            {{ $errors->has('due_date') ? 'border-red-600' : '' }}" type="date" name="due_date"
                            value="{{ $errors->has('due_date') ? null : old('due_date') }}" autofocus />
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
