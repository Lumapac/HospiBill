<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HospiBill - Multi-tenant Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS (Ensure it's included) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">HospiBill</span>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition duration-300">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition duration-300">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 px-4 py-2 text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 rounded-md transition duration-300">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="py-12 bg-indigo-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl">
                        Get Your Own HospiBill Instance
                    </h1>
                    <p
                        class="mt-3 max-w-md mx-auto text-base text-indigo-100 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Apply for a dedicated tenant space to manage your hospital billing system efficiently. All
                        applications are reviewed by our admin team.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column - Benefits -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Why Choose HospiBill?</h2>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">Dedicated Instance</h3>
                                    <p class="mt-1 text-gray-500 dark:text-gray-400">Get your own instance with a custom
                                        subdomain.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">Data Isolation</h3>
                                    <p class="mt-1 text-gray-500 dark:text-gray-400">Your data stays separated from
                                        other tenants.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">Instant Setup</h3>
                                    <p class="mt-1 text-gray-500 dark:text-gray-400">Get up and running in minutes.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">Secure Access</h3>
                                    <p class="mt-1 text-gray-500 dark:text-gray-400">Credentials sent securely to your
                                        email.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Application Form -->
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Apply for Tenancy</h2>

                        <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4">
                            <p>All applications are subject to admin review. Once approved, your login credentials will
                                be sent to your email.</p>
                        </div>

                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tenants.store') }}">
                            @csrf

                            <!-- Company Name -->
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Company Name
                                </label>
                                <input id="name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                    type="text" name="name" value="{{ old('name') }}" required autofocus />
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email
                                </label>
                                <input id="email"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                    type="email" name="email" value="{{ old('email') }}" required />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">We'll send your login
                                    credentials to this email.</p>
                            </div>

                            <!-- Contact Person -->
                            <div class="mb-6">
                                <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Contact Person
                                </label>
                                <input id="contact_person"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                    type="text" name="contact_person" value="{{ old('contact_person') }}" required />
                                @error('contact_person')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-6">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Phone Number
                                </label>
                                <input id="phone_number"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                    type="tel" name="phone_number" value="{{ old('phone_number') }}" required />
                                @error('phone_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Domain Name -->
                            <div class="mb-6">
                                <label for="domain_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Subdomain Name
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input id="domain_name"
                                        class="block w-full px-3 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
                                        type="text" name="domain_name" value="{{ old('domain_name') }}" required />
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-r-md border border-l-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-600 text-gray-500 dark:text-gray-300">
                                        .{{ config('app.domain') }}
                                    </span>
                                </div>
                                @error('domain_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Choose a unique subdomain for
                                    your instance.</p>
                            </div>

                            <!-- Apply Button -->
                            <div>
                                <button type="submit"
                                    class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 rounded-md">
                                    Apply for Tenancy
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>