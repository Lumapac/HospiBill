<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-0">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-md-4">
                <div class="input-group input-group-static mb-4">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    @error('current_password')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="input-group input-group-static mb-4">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="input-group input-group-static mb-4">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn bg-gradient-dark">Update Password</button>
        </div>
        
        @if (session('status') === 'password-updated')
            <div class="alert alert-success text-white mt-3">
                <span class="alert-text">
                    Your password has been updated.
                </span>
            </div>
        @endif
    </form>
</section>
