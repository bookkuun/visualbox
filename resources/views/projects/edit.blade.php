@section('script')
    <script src="{{ asset('js/toggle_member.js') }}" defer></script>
@endsection

<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.project-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>{{ __('Project Edit') }}</h2>
    </x-slot>

    <div class="m-6">
        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('projects.update', ['project' => $project]) }}">
            @csrf
            @method('PUT')
            <!-- Navigation -->
            <div class="flex justify-end mb-3">
                <x-link-button class="m-2" :href="route('projects.index')">
                    {{ __('Create Cancel') }}
                </x-link-button>
                <x-button class="m-2 px-10">
                    {{ __('Update') }}
                </x-button>
            </div>

            <div class="rounded-md bg-white">
                <div class="p-6">
                    <x-label for="title" :value="__('Project Title')"
                        class="{{ $errors->has('title') ? 'text-red-600' : '' }}" />
                    <x-input id="title" class="block mb-6 w-full {{ $errors->has('title') ? 'border-red-600' : '' }}"
                        type="text" name="title" :value="old('title', $project->title)"
                        placeholder="{{ __('Project Title') }}" autofocus />
                </div>
            </div>
        </form>

        <form name="deleteform" method="POST" action="{{ route('projects.destroy', ['project' => $project]) }}">
            @csrf
            @method('DELETE')
            <!-- Navigation -->
            <div class="w-full py-6 flex justify-start">
                <x-button
                    class="bg-red-600 text-white hover:bg-red-700 active:bg-red-900 focus:border-red-900 ring-red-300"
                    onclick="return confirm('本当に削除してもよいですか？')">
                    {{ __('Project Delete') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
