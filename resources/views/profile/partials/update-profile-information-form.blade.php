<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="input-group input-group-static mb-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning text-white font-weight-bold" role="alert">
                        <span class="alert-text">
                            Your email address is unverified. 
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning ms-2">
                                    Send verification email
                                </button>
                            </form>
                        </span>
                    </div>
                    @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success text-white">
                        <span class="alert-text">
                            A new verification link has been sent to your email address.
                        </span>
                    </div>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn bg-gradient-dark">Save changes</button>
        </div>
        
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success text-white mt-3">
                <span class="alert-text">
                    Your profile has been updated.
                </span>
            </div>
        @endif
    </form>
</section>
