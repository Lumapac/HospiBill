@props(['show' => false, 'maxWidth' => '2xl'])

<div
    x-data="{ show: false }"
    x-init="() => {
        $watch('loginModal', value => {
            show = value
        })
    }"
    x-on:keydown.escape.window="show = false; loginModal = false"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <div 
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth === 'md' ? 'sm:max-w-md' : 'sm:max-w-xl' }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <div class="p-6">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                    {{ __('Login to Your Account') }}
                </h2>
                <button @click="show = false; loginModal = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
        
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="text-center mb-5">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                        <i class="material-symbols-rounded text-2xl">person</i>
                    </div>
                </div>
        
                <!-- Email Address -->
                <div class="input-group input-group-outline mb-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="material-symbols-rounded text-gray-400">mail</i>
                        </div>
                        <x-input-label for="email" :value="__('Email')" class="sr-only" />
                        <x-text-input id="email" 
                            class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            placeholder="Email Address"
                            required 
                            autofocus 
                            autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="input-group input-group-outline mb-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="material-symbols-rounded text-gray-400">lock</i>
                        </div>
                        <x-input-label for="password" :value="__('Password')" class="sr-only" />
                        <x-text-input id="password" 
                            class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required 
                            autocomplete="current-password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out rounded border-gray-300 dark:border-gray-700" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
        
                <div class="flex items-center justify-between mt-5">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
        
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        {{ __('Log in') }}
                        <i class="material-symbols-rounded ml-1">arrow_forward</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 