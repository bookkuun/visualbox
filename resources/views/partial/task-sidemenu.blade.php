<x-slot name="sidemenu">
    <div class="text-center">
        <div class=" p-5 mt-20 ">
            <a href="{{ route('projects.index') }}">プロジェクト一覧</a><br>
        </div>
        <hr>
        <div class="p-5">
            <a href="{{ route('projects.create') }}">プロジェクト作成</a>
        </div>
        <hr>
        <div class="p-5">
            <a href="{{ route('tasks.index', ['project' => $project]) }}">タスク一覧</a><br>
        </div>
        <hr>
        <div class="p-5">
            <a href="{{ route('tasks.create', ['project' => $project]) }}">タスク作成</a>
        </div>
    </div>
</x-slot>
