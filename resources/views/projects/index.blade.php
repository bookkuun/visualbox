<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.project-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>{{ __('Projects') }}</h2>
    </x-slot>

    {{-- メッセージ --}}
    <x-flash-message />
    <x-validation-errors :errors="$errors" />

    <div class="m-6">
        <!-- 検索フォーム -->
        <form method="GET" action="{{ route('projects.index') }}">
            <div class="flex">
                <div class="w-1/3 px-3 mb-6 mr-3">
                    <x-label for="keyword" :value="__('Keyword')"
                        class="{{ $errors->has('keyword') ? 'text-red-600' : '' }}" />
                    <x-input id="keyword"
                        class="block mt-1 w-full {{ $errors->has('keyword') ? 'border-red-600' : '' }}" type="text"
                        name="keyword" :value="$keyword" :placeholder="__('Keyword')" autofocus />
                </div>
                <div class="flex flex-wrap content-center">
                    <x-button class="px-10">
                        {{ __('Search') }}
                    </x-button>
                </div>
            </div>
        </form>

        <div class="flex justify-start my-6">
            {{ $projects->links() }}
        </div>

        @if (0 < $projects->count())
            <div class="bg-white rounded">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 leading-normal">
                            <th class="py-3 px-6 text-left">プロジェクト名</th>
                            <th class="py-3 px-6 text-center"></th>
                            <th class="py-3 px-6 text-center"></th>
                            <th class="py-3 px-6 text-center">作成日</th>
                            <th class="py-3 px-6 text-center">更新日</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 font-light">
                        @foreach ($projects as $project)
                            <tr class="border-b border-gray-200 @if ($loop->even)bg-gray-50 @endif">
                                <td class="py-3 px-6 text-left">
                                    <a class="underline text-gray-600 hover:text-gray-900"
                                        href="{{ route('projects.edit', ['project' => $project->id]) }}">{{ $project->title }}</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a class="underline text-gray-600 hover:text-gray-900"
                                        href="{{ route('tasks.index', ['project' => $project->id]) }}">{{ __('Tasks') }}</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a class="underline text-gray-600 hover:text-gray-900"
                                        href="{{ route('tasks.create', ['project' => $project->id]) }}">{{ __('Task Create') }}</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>{{ $project->created_at->format('Y/m/d') }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span>{{ $project->updated_at->format('Y/m/d') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ml-10">
                プロジェクトの登録はありません。
            </div>
        @endif
        <div class="flex justify-start my-6">
            {{ $projects->links() }}
        </div>
    </div>

</x-app-layout>
