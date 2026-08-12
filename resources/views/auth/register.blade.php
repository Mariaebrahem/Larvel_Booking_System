@extends('layouts.user')

@section('title', 'Create New Account')

@section('content')
<div class="container my-5 py-4" dir="ltr">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4 border-0"
                     style="background: linear-gradient(135deg, var(--accent-brown) 0%, var(--primary-rose) 100%);">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm"
                         style="width: 60px; height: 60px; color: var(--primary-rose);">
                        <i class="fa-solid fa-user-plus fs-3"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Create New Account</h4>
                    <p class="text-white-50 mb-0 small">Join us and enjoy the best hotel deals</p>
                </div>
                <div class="card-body p-4 p-md-5" style="background-color: var(--card-bg);">
                    <form action="{{ url('/register') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold small" style="color: var(--text-color);">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0" style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="name" class="form-control border-start-0 py-2" placeholder="Enter full name" required
                                       style="background-color: var(--bg-main); color: var(--text-color);">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small" style="color: var(--text-color);">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0" style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-start-0 py-2" placeholder="Enter email address" required
                                       style="background-color: var(--bg-main); color: var(--text-color);">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small" style="color: var(--text-color);">Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0" style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-start-0 py-2" placeholder="Enter password" required
                                       style="background-color: var(--bg-main); color: var(--text-color);">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small" style="color: var(--text-color);">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0" style="background-color: var(--bg-main); color: var(--primary-rose);">
                                    <i class="fa-solid fa-shield-halved"></i>
                                </span>
                                <input type="password" name="password_confirmation" class="form-control border-start-0 py-2" placeholder="Confirm password" required
                                       style="background-color: var(--bg-main); color: var(--text-color);">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-rose btn-lg w-100 rounded-3 fw-bold mb-3 shadow-sm">
                            <i class="fa-solid fa-user-check me-2"></i> Create Account
                        </button>

                        <div class="text-center pt-2">
                            <span class="text-muted small">Already have an account?</span>
                            <a href="{{ url('/login') }}" class="fw-bold text-decoration-none small ms-1" style="color: var(--primary-rose);">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection