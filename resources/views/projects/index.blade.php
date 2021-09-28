<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <div class="mx-auto">
        <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Projects') }}
                </h3>
            </div>
        </div>
    </div>

    {{-- フラッシュメッセージ --}}
    <x-flash-message />

    <div class="flex flex-col mt-3 mx-6 mb-6 bg-white rounded">
        @if (0 < $projects->count())
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">

                        <th class="py-3 px-6 text-left">
                            プロジェクト名
                        </th>
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
                                <div class="flex item-center justify-between">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('tasks.index', ['project' => $project->id]) }}">{{ __('Tasks') }}</a>
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('tasks.create', ['project' => $project->id]) }}">{{ __('Task Create') }}</a>
                                </div>
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
        @endif
    </div>
    </div>
</x-app-layout>
