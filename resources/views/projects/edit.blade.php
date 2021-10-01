<x-app-layout>

    @include('partial.project-sidemenu')

    <x-slot name="header">
        <h2 ">
            {{ __('Project Edit') }}
        </h2>
    </x-slot>

    <form method=" POST" action="{{ route('projects.update', ['project' => $project]) }}">
            @csrf
            @method('PUT')
            <!-- Validation Errors -->
            <x-validation-errors :errors="$errors" />

            <!-- Navigation -->
            <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-end">
                <x-link-button class="m-2" :href="route('projects.index')">
                    {{ __('Create Cancel') }}
                    </x-button>
                    <x-button class="m-2 px-10">
                        {{ __('Update') }}
                    </x-button>
            </div>

            <div class="flex flex-col mx-3 rounded-md bg-white">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-full px-3 mb-6">
                            <x-label for="title" :value="__('Project Title')"
                                class="{{ $errors->has('title') ? 'text-red-600' : '' }}" />
                            <x-input id="name"
                                class="block mt-1 w-full {{ $errors->has('title') ? 'border-red-600' : '' }}"
                                type="text" name="title" :value="old('title', $project->title)" placeholder="プロジェクト名"
                                required autofocus />
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <form name="deleteform" method="POST" action="{{ route('projects.destroy', ['project' => $project]) }}">
                @csrf
                @method('DELETE')
                <!-- Navigation -->
                <div class="w-full py-6 ml-6 flex justify-start">
                    <x-button
                        class="modal-open m-2 px-10 bg-red-600 text-white hover:bg-red-700 active:bg-red-900 focus:border-red-900 ring-red-300"
                        onclick="return confirm('本当に削除してもよいですか？')">
                        {{ __('Project Delete') }}
                    </x-button>
                </div>
            </form>
</x-app-layout>
