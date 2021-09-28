<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('tasks.store', ['project' => $project->id]) }}">
        @csrf
        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />

        <!-- Navigation -->
        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-end">
            <x-link-button class="m-2" :href="route('tasks.index', ['project' => $project->id])">
                {{ __('Create Cancel') }}
                </x-button>
                <x-button class="m-2 px-10">
                    {{ __('Create') }}
                </x-button>
        </div>

        <div class="flex flex-col px-8 pt-6 mx-3 rounded-md bg-white">
            <div class="py-5">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Task Create') }}
                </h3>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6">
                    <x-label for="task_kind_id" :value="__('Task Kind')"
                        class="{{ $errors->has('task_kind_id') ? 'text-red-600' : '' }}" />
                    <x-select :options="$task_kinds" id="task_kind_id"
                        class="block mt-1 w-full {{ $errors->has('task_kind_id') ? 'border-red-600' : '' }}"
                        name="task_kind_id" :value="old('task_kind_id')" required autofocus />
                </div>

                <div class="md:w-full px-3 mb-6">
                    <x-label for="name" :value="__('Task Name')"
                        class="{{ $errors->has('name') ? 'text-red-600' : '' }}" />
                    <x-input id="name" class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-600' : '' }}"
                        type="text" name="name" :value="old('name')" placeholder="{{ __('Task Name') }}" required
                        autofocus />
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3 mb-6">
                    <x-label for="detail" :value="__('Task Detail')"
                        class="{{ $errors->has('detail') ? 'text-red-600' : '' }}" />
                    <x-textarea id="detail"
                        class="block mt-1 w-full {{ $errors->has('detail') ? 'border-red-600' : '' }}" name="detail"
                        :value="old('detail')" rows="8" placeholder="{{ __('Task Detail') }}" />
                </div>
            </div>

            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/4 px-3 mb-6">
                    <x-label for="task_status_id" :value="__('Task Status')"
                        class="{{ $errors->has('task_status_id') ? 'text-red-600' : '' }}" />
                    <x-select :options="$task_statuses" id="task_status_id"
                        class="block mt-1 w-full {{ $errors->has('task_status_id') ? 'border-red-600' : '' }}"
                        type="text" name="task_status_id" :value="old('task_status_id')" required autofocus />
                </div>

                <div class="md:w-1/4 px-3 mb-6">
                    <x-label for="assigner_id" :value="__('Assigner')"
                        class="{{ $errors->has('assigner_id') ? 'text-red-600' : '' }}" />
                    <x-select :options="$assigners" id="assigner_id"
                        class="block mt-1 w-full {{ $errors->has('assigner_id') ? 'border-red-600' : '' }}"
                        type="text" name="assigner_id" :value="old('assigner_id')" autofocus />
                </div>

                <div class="md:w-1/4 px-3 mb-6">
                    <x-label for="task_category_id" :value="__('Task Category')"
                        class="{{ $errors->has('task_category_id') ? 'text-red-600' : '' }}" />
                    <x-select :options="$task_categories" id="task_category_id"
                        class="block mt-1 w-full {{ $errors->has('task_category_id') ? 'border-red-600' : '' }}"
                        type="text" name="task_category_id" :value="old('task_category_id')" autofocus />
                </div>

                <div class="md:w-1/4 px-3 mb-6">
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
</x-app-layout>
