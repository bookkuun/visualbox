<x-app-layout>

    @include('partial.project-sidemenu')

    <x-slot name="header">
        <h2>
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
            </x-link-button>
            <x-button class="m-2 px-10">
                {{ __('Create') }}
            </x-button>
        </div>

        <div class="flex flex-col mx-3 rounded-md bg-white">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="md:w-full px-3 mb-6">
                    <x-label for="title" :value="__('Project Title')"
                        class="{{ $errors->has('title') ? 'text-red-600' : '' }}" />
                    <x-input id="title" class="block mt-1 w-full {{ $errors->has('title') ? 'border-red-600' : '' }}"
                        type="text" name="title" :value="old('title')" placeholder="{{ __('Project Title') }}"
                        autofocus />
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
