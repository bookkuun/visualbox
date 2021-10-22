<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <input type="hidden" id="email"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="email" name="email" value="guest@example.com" required autofocus>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <input id="password"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="hidden" name="password" value="password" required autocomplete="current-password">
            </div>
            <div class="flex items-center justify-center mt-4">
                Welcome to VisualBox!!
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-button class="ml-3">
                    ゲストログイン
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
