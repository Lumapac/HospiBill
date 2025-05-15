@extends('app.layouts.sidebar')
@section('title', 'Admin Dashboard')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    @include('layouts.navbar', ['title' => 'Profile'])
    <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Profile Settings</h3>
                <p class="mb-4">
                    Manage your account information and password
                </p>
            </div>
        </div>

        <!-- Profile Information Card -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h5 class="mb-0">Profile Information</h5>
                        <p class="text-sm mb-0">Update your account's profile information and email address</p>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Update Password Card -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h5 class="mb-0">Change Password</h5>
                        <p class="text-sm mb-0">Update your password to keep your account secure</p>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection