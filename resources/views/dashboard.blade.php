<x-app-layout>

    <x-slot name="sidemenu">
        @include('layouts.sidemenu.project-sidemenu')
    </x-slot>

    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="m-6">
        <div class="flex flex-row">
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center">
                    <span class="bg-red-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>未対応</h3>
                </div>
                <ul>
                    <li>
                        <div class="border border-gray-900 m-3 text-xs">
                            <div class="bg-red-100 p-1">プロジェクト名</div>
                            <div class="p-1">

                                <div>タスク名</div>
                                <div>タスクの種類</div>
                                <div>カテゴリ</div>
                                <div>締め切り日</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center">
                    <span class="bg-blue-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>処理中</h3>
                </div>
                <ul>
                    <li>
                        <div class="border border-gray-900 m-3 text-xs">
                            <div class="bg-blue-100 p-1">プロジェクト名</div>
                            <div class="p-1">
                                <div>タスク名</div>
                                <div>タスクの種類</div>
                                <div>カテゴリ</div>
                                <div>締め切り日</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center">
                    <span class="bg-green-200 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>処理済み</h3>
                </div>
                <ul>
                    <li>
                        <div class="border border-gray-900 m-3 text-xs">
                            <div class="bg-green-100 p-1">プロジェクト名</div>
                            <div class="p-1">

                                <div>タスク名</div>
                                <div>タスクの種類</div>
                                <div>カテゴリ</div>
                                <div>締め切り日</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="flex-1 bg-white mx-2">
                <div class="bg-gray-100 flex flex-row items-center">
                    <span class="bg-green-500 rounded-full h-3 w-3 flex items-center justify-center mr-1"></span>
                    <h3>完了</h3>
                </div>
                <ul>
                    <li>
                        <div class="border border-gray-900 m-3 text-xs">
                            <div class="bg-green-400 p-1">プロジェクト名</div>
                            <div class="p-1">

                                <div>タスク名</div>
                                <div>タスクの種類</div>
                                <div>カテゴリ</div>
                                <div>締め切り日</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</x-app-layout>
