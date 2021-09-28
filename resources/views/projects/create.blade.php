<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Create') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />


        <!-- Navigation -->
        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-end">
            <x-link-button class="m-2" :href="route('projects.index')">
                {{ __('Create Cancel') }}
                </x-button>
                <x-button class="m-2 px-10">
                    {{ __('Create') }}
                </x-button>
        </div>

        <div class="flex flex-col mx-3 rounded-md bg-white">
            <div class="p-6 bg-white border-b border-gray-200">
                @csrf
                <div class="md:w-full px-3 mb-6">
                    <x-label for="project_name" :value="__('Project Name')"
                        class="{{ $errors->has('project_name') ? 'text-red-600' : '' }}" />
                    <x-input id="project_name"
                        class="block mt-1 w-full {{ $errors->has('project_name') ? 'border-red-600' : '' }}"
                        type="text" name="project_name" :value="old('project_name')"
                        placeholder="{{ __('Project Name') }}" required autofocus />
                </div>


            </div>
        </div>
    </form>

</x-app-layout>
