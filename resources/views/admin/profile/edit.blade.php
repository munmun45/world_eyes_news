@extends('admin.layouts.app')

@section('page_title', 'Staff Profile & Security')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="p-4 rounded bg-white border">
            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-user-gear text-danger me-2"></i> Account Credentials</h5>

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Staff Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Role</label>
                    <input type="text" class="form-control bg-light" value="{{ strtoupper($user->role) }}" readonly>
                </div>

                <hr class="my-4">
                <h6 class="fw-bold text-dark mb-2">Change Password</h6>
                <p class="small text-muted mb-3">Leave blank if you do not wish to alter your current password.</p>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Current Password</label>
                    <input type="password" name="current_password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Minimum 6 characters">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small text-dark">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2">
                    <i class="fa-solid fa-check me-1"></i> Update Profile Credentials
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
