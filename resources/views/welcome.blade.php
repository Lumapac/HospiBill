<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS (Ensure it's included) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased dark:bg-gray-900 dark:text-white">
    <div class="bg-gray-50 text-black/70 dark:bg-gray-900 dark:text-white/70">
        <div class="relative min-h-screen flex flex-col items-center justify-center py-12 px-6">
            <!-- Navbar -->
            @if (Route::has('login'))
                <nav class="absolute top-0 right-0 p-6">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-4 py-2 text-black dark:text-white rounded-lg hover:bg-gray-500 hover:text-white transition duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-black dark:text-white rounded-lg hover:bg-gray-500 hover:text-white transition duration-300">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 px-4 py-2 text-black dark:text-white rounded-lg hover:bg-gray-500 hover:text-white transition duration-300">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif


            <!-- Form Container -->
            <div class="p-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-lg w-full">
                <h2 class="text-2xl font-bold text-center text-black dark:text-white mb-8">Tenant Application</h2>
                <form method="POST" action="{{ route('tenants.store') }}">
                    @csrf

                    <!-- Company Name -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Company Name')"
                            class="text-lg font-semibold text-black dark:text-white" />
                        <x-text-input id="name"
                            class="block mt-2 w-full px-4 py-2 rounded-md border-2 border-gray-300 dark:border-gray-600 text-black dark:text-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:border-[#FF2D20]"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')"
                            class="text-lg font-semibold text-black dark:text-white" />
                        <x-text-input id="email"
                            class="block mt-2 w-full px-4 py-2 rounded-md border-2 border-gray-300 dark:border-gray-600 text-black dark:text-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:border-[#FF2D20]"
                            type="email" name="email" :value="old('email')" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Domain Name -->
                    <div class="mb-6">
                        <x-input-label for="domain_name" :value="__('Domain Name')"
                            class="text-lg font-semibold text-black dark:text-white" />
                        <x-text-input id="domain_name"
                            class="block mt-2 w-full px-4 py-2 rounded-md border-2 border-gray-300 dark:border-gray-600 text-black dark:text-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] focus:border-[#FF2D20]"
                            type="text" name="domain_name" :value="old('domain_name')" required autofocus
                            autocomplete="domain_name" />
                        <x-input-error :messages="$errors->get('domain_name')" class="mt-2 text-red-500" />
                    </div>

                    <!-- Apply Button -->
                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button
                            class="px-6 py-3 bg-[#FF2D20] text-white rounded-lg hover:bg-[#e02a1a] transition duration-200">
                            {{ __('Apply') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>