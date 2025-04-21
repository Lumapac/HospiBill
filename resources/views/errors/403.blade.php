<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Denied - HospiBill</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full p-8 text-center">
            <svg class="h-16 w-16 text-yellow-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Access Denied</h1>
            
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                {{ $exception->getMessage() ?: 'You do not have permission to access this resource.' }}
            </p>
            
            <div class="text-gray-500 dark:text-gray-400 mb-6">
                <p>If you believe this is an error, please contact the system administrator.</p>
            </div>
            
            <a href="https://hospibill.local" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Return to Homepage
            </a>
        </div>
    </div>
</body>

</html> 