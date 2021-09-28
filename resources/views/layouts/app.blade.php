<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class=" bg-gray-100">
        @include('layouts.navigation')

        <main class="flex">
            <div class="w-1/5 h-auto bg-blue-100">
                {{-- サイドメニュー --}}
                @include('layouts.side-menu')
            </div>
            <div class="w-4/5">
                <!-- メインヘッダー -->
                <header class="bg-green-200 shadow">
                    <div class=" max-w-7xl py-6 px-6">
                        {{ $header }}
                    </div>
                </header>
                {{-- メインコンテンツ --}}
                {{ $slot }}
            </div>
        </main>
        {{-- フッター --}}
        <footer class="bg-green-200 h-screen">
        </footer>
    </div>
</body>

</html>
