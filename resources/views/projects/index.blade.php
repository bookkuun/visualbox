<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <form method="GET" action="{{ route('projects.index') }}">

        <!-- Validation Errors -->
        <x-flash-message />
        <x-validation-errors :errors="$errors" />

        <!-- Navigation -->
        <div class="flex max-w-full mx-auto px-4 py-6 sm:px-6 lg:px-6">
            <div class="md:w-1/3 px-3 mb-6 mr-6">
                <x-label for="keyword" :value="__('Keyword')"
                    class="{{ $errors->has('keyword') ? 'text-red-600' : '' }}" />
                <x-input id="keyword" class="block mt-1 w-full {{ $errors->has('keyword') ? 'border-red-600' : '' }}"
                    type="text" name="keyword" :value="$keyword" :placeholder="__('Keyword')" autofocus />
            </div>
            <div class="flex flex-wrap content-center">
                <x-button class="px-10">
                    {{ __('Search') }}
                </x-button>
            </div>
        </div>
    </form>

    <div class="flex flex-col mx-6 mb-6 bg-white rounded">
        @if (0 < $projects->count())
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">

                        <th class="py-3 px-6 text-left">
                            プロジェクト名
                        </th>
                        <th class="py-3 px-6 text-center"></th>
                        <th class="py-3 px-6 text-center"></th>
                        <th class="py-3 px-6 text-center">
                            作成日
                        </th>
                        <th class="py-3 px-6 text-center">
                            更新日
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($projects as $project)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer
                                        @if ($loop->even)bg-gray-50 @endif"
                            onclick="location.href='{{ route('projects.edit', ['project' => $project->id]) }}'">

                            <td class="py-3 px-6 text-left">
                                <a class="underline font-medium text-gray-600 hover:text-gray-900"
                                    href="{{ route('projects.edit', ['project' => $project->id]) }}">{{ $project->title }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('tasks.index', ['project' => $project->id]) }}">{{ __('Tasks') }}</a>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
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
        @else
            プロジェクトの登録はありません。
        @endif
    </div>
    <div class="flex justify-center mb-6">
        {{ $projects->links() }}
    </div>

</x-app-layout>
