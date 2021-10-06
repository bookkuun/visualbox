@section('script')
    <script src="{{ asset('js/toggle_member.js') }}" defer></script>
    <script src="{{ asset('js/exit_project.js') }}" defer></script>
@endsection

<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.project-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>{{ __('Project Edit') }}</h2>
    </x-slot>

    <div class="m-6">


        {{-- メッセージ --}}
        <x-flash-message />
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

                    <h3 class="mb-2">プロジェクトメンバー</h3>

                    {{-- コピー元 --}}
                    <div class="hidden mb-6" data="member_form">
                        <div class="w-1/4">
                            <x-label :value="__('Member')"
                                class="{{ $errors->has('user_id') ? 'text-red-600' : '' }}" />
                            <x-select :options="$users"
                                class="block mt-1 w-full {{ $errors->has('user_id') ? 'border-red-600' : '' }}"
                                data="member_id" type="text" :value="old('user_id')" autofocus />
                        </div>
                        <div class="w-1/4 ml-3">
                            <x-label :value="__('User Authority')"
                                class="{{ $errors->has('user_authority_id') ? 'text-red-600' : '' }}" />
                            <x-select :options="$user_authorities"
                                class="block mt-1 w-full {{ $errors->has('user_authority_id') ? 'border-red-600' : '' }}"
                                data="member_authority_id" type="text" :value="old('user_authority_id')" autofocus />
                        </div>
                    </div>
                    {{-- コピー元 --}}

                    <div class="flex mb-6">
                        <div class="w-1/4">
                            <x-label for="user_id" :value="__('Member')" />
                            <x-select id="user_id" :disabled=true :options="$users" class="block mt-1 w-full"
                                name="users[0][id]" :value="$project->user->id" />
                        </div>

                        <div class="w-1/4 mx-3">
                            <x-label for="user_authority_id" :value="__('User Authority')" />
                            <x-select :disabled=true :options="$user_authorities"
                                class="user_authority_id block mt-1 w-full {{ $errors->has('user_authority_id') ? 'border-red-600' : '' }}"
                                name="users[0][authority]" :value=$admin_id />
                        </div>

                        <input class="hidden" type="text" name="users[0][id]"
                            value="{{ $project->user->id }}">
                        <input class="hidden" type="text" name="users[0][authority]"
                            value="{{ $admin_id }}">
                    </div>

                    <div id="project_members">
                        @foreach ($except_author_users as $key => $user)
                            <div id="join_member_{{ $user->id }}" class="flex mb-6">
                                <div class="w-1/4">
                                    <x-label :value="__('Member')"
                                        class="{{ $errors->has('user_id') ? 'text-red-600' : '' }}" />
                                    <x-select :disabled="true" :options="$users"
                                        class="block mt-1 w-full {{ $errors->has('user_id') ? 'border-red-600' : '' }}"
                                        name="users[{{ $key }}][id]" type="text" :value="$user->id"
                                        autofocus />
                                </div>

                                <input class="hidden" type="text" name="users[{{ $key }}][id]"
                                    value="{{ $user->id }}">
                                <div class="w-1/4 mx-3">
                                    <x-label :value="__('User Authority')"
                                        class="{{ $errors->has('user_authority_id') ? 'text-red-600' : '' }}" />
                                    <x-select :options="$user_authorities"
                                        class="block mt-1 w-full {{ $errors->has('user_role_id') ? 'border-red-600' : '' }}"
                                        name="users[{{ $key }}][authority]" type="text"
                                        :value="$user->getAuthorityId($project)" autofocus />
                                </div>

                                <div class="w-1/4 mx-3 flex mt-6">
                                    <div id="{{ $user->id }}" data="project_join_member"
                                        class="rounded-full flex items-center shadow bg-red-500 px-4 py-2 text-white hover:bg-red-400 cursor-pointer">
                                        削除
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-row">
                        <div>
                            <button id='add_member'
                                class="bg-blue-500  hover:bg-blue-700  focus:outline-none text-white font-bold py-2 px-4 rounded mb-5">
                                メンバーフォームを追加する
                            </button>
                        </div>
                        <div>
                            <button id='delete_member'
                                class="bg-red-500 hover:bg-red-700 focus:outline-none text-white font-bold py-2 px-4 rounded ml-5 mb-5">
                                メンバーフォームを削除する
                            </button>
                        </div>
                    </div>
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
