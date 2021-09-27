<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <x-flash-message />

                <div class="flex flex-col m-6 bg-white rounded">
                    @if (0 < $projects->count())

                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">

                                    <th class="py-3 px-6 text-left">
                                        プロジェクト名
                                    </th>
                                    <th class="py-3 px-6 text-center">
                                        作った日
                                    </th>
                                    <th class="py-3 px-6 text-center">
                                        更新した日
                                    </th>
                                    <th class="py-3 px-6 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach ($projects as $project)

                                    <tr class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer @if ($loop->even)bg-gray-50 @endif"
                                        onclick="location.href='{{ route('projects.edit', ['project' => $project->id]) }}'">

                                        <td class="py-3 px-6 text-left">
                                            <a class="underline font-medium text-gray-600 hover:text-gray-900"
                                                href="{{ route('projects.edit', ['project' => $project->id]) }}">{{ $project->name }}</a>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $project->created_at->format('Y/m/d') }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $project->updated_at->format('Y/m/d') }}</span>
                                        </td>
                                        {{-- <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-between">
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('tasks.index', ['project' => $project->id]) }}">{{ __('Tasks') }}</a>
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('tasks.create', ['project' => $project->id]) }}">{{ __('Task Create') }}</a>
                                            </div>
                                        </td> --}}
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>






            </div>
        </div>
    </div>
</x-app-layout>
