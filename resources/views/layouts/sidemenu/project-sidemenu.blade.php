<div class="flex items-center space-x-4 p-2 mb-5">
    {{-- アイコン導入予定 --}}
    {{-- <img class="h-12 rounded-full" src="" alt=""> --}}
    <div>
        <h4 class="font-semibold text-2xl capitalize font-poppins tracking-wide">Select Menu</h4>
    </div>
</div>
<ul class="space-y-2 text-lg font-semibold">
    <li>
        <a href="{{ route('projects.index') }}"
            class="flex items-center space-x-3 p-2 rounded-md  hover:bg-gray-200 hover:text-gray-800 focus:bg-gray-200 focus:shadow-outline">
            {{-- アイコン導入予定 --}}
            {{-- <span class="text-gray-600">
                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </span> --}}
            <span>プロジェクト一覧</span>
        </a>
    </li>
    <li>
        <a href="{{ route('projects.create') }}"
            class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-200 hover:text-gray-800 focus:bg-gray-200 focus:shadow-outline">
            <span>プロジェクト作成</span>
        </a>
    </li>
</ul>
