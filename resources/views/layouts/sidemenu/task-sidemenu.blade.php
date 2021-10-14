    <div class="flex items-center space-x-4 p-2 mb-5">
        {{-- アイコン導入予定 --}}
        {{-- <img class="h-12 rounded-full" src="" alt=""> --}}
        <div>
            <h4 class="font-semibold text-2xl capitalize font-poppins tracking-wide">Select Menu</h4>
        </div>
    </div>
    <ul class="space-y-2 text-base font-semibold">

        <li>
            <a href="{{ route('tasks.progress', ['project' => $project->id]) }}"
                class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-200 hover:text-gray-800 focus:bg-gray-200 focus:shadow-outline">
                <span>{{ __('Task Progress') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('tasks.index', ['project' => $project->id]) }}"
                class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-200 hover:text-gray-800 focus:bg-gray-200 focus:shadow-outline">
                <span>タスク一覧</span>
            </a>
        </li>
        @can('projectEditorOrMore', $project)
            <li>
                <a href="{{ route('tasks.create', ['project' => $project->id]) }}"
                    class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-200 hover:text-gray-800 focus:bg-gray-200 focus:shadow-outline">
                    <span>タスク作成</span>
                </a>
            </li>
        @endcan
    </ul>
