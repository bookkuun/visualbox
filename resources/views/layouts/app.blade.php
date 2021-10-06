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
    <div>
        @include('layouts.navigation')

        <main>
            {{-- サイドメニュー --}}
            <div class="flex flex-wrap w-full h-full bg-gray-100">
                <div class="w-1/6 bg-gray-800 text-white p-3 shadow-lg">
                    {{ $sidemenu }}
                </div>
                <div class="w-5/6">
                    <!-- メインヘッダー -->
                    <header class="bg-gray-800 text-white font-semibold text-xl shadow">
                        <div class="max-w-7xl py-6 px-6">
                            {{ $header }}
                        </div>
                    </header>
                    {{-- メインコンテンツ --}}
                    {{ $slot }}
                </div>
            </div>
        </main>
        {{-- フッター --}}
        <footer class="h-64 text-white bg-gray-800 flex justify-center items-center">
            <small>&copy; VusualBox 2021</small>
        </footer>
        {{-- JS --}}
    </div>
    @yield('script')
</body>

</html>
