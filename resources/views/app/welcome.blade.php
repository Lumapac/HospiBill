<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ loginModal: {{ request()->query('login', 'false') }} }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HospiBill - Tenant Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen">
 
            <!-- Hero Section -->
            <div class="relative bg-indigo-800 dark:bg-indigo-900">
                <div class="absolute inset-0">
                    <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1504439468489-c8920d796a29?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Hospital">
                    <div class="absolute inset-0 bg-indigo-800 dark:bg-indigo-900 mix-blend-multiply"></div>
                </div>
                <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">HospiBill Management System</h1>
                    <p class="mt-6 max-w-3xl text-xl text-indigo-100">Streamline your healthcare billing and patient management workflow with our comprehensive solution.</p>
                    @auth
                        <div class="mt-10">
                            <a href="{{ url('/dashboard') }}" class="inline-block bg-white py-3 px-8 border border-transparent rounded-md text-base font-medium text-indigo-700 hover:bg-indigo-50">Go to Dashboard</a>
                        </div>
                    @else
                        <div class="mt-10 flex gap-4">
                            <button @click="loginModal = true" class="inline-block bg-white py-3 px-8 border border-transparent rounded-md text-base font-medium text-indigo-700 hover:bg-indigo-50">Log In</button>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Login Modal -->
            <x-login-modal :show="false" maxWidth="md" />

            <!-- Dashboard Preview Section -->
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    <span class="block">Powerful Dashboard Solutions</span>
                </h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Our platform provides specialized dashboards for different roles in your organization.</p>
                
                <div class="mt-10 grid gap-6 lg:grid-cols-3">
                    <!-- Admin Dashboard Card -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Admin Dashboard</h3>
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Manage all aspects of your healthcare facility, track patient statistics, and monitor service usage.</p>
                                <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Patient statistics tracking
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Service popularity metrics
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        User management
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Dashboard Card -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Doctor Dashboard</h3>
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Access patient records, track appointments, and monitor patient distribution by service.</p>
                                <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Patient management
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Service utilization
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Daily patient tracking
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Cashier Dashboard Card -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Cashier Dashboard</h3>
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Process payments, view pending transactions, and track daily collections.</p>
                                <ul class="mt-4 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Payment processing
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Transaction tracking
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Revenue reporting
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="bg-gray-50 dark:bg-gray-800">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
                    <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                                Key Features
                            </h2>
                            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                                Our platform is designed to streamline healthcare management.
                            </p>
                        </div>
                        <div class="mt-12 lg:mt-0 lg:col-span-2">
                            <dl class="space-y-10">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                            Secure Data Management
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                            All patient and billing data is securely stored and managed with industry-standard encryption.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                            Integrated Billing
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500 dark:text-gray-400">
                                            Seamlessly handle billing and payments with our integrated billing system.
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
