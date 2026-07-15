@extends('landing-page.main')

@section('title', '403 Forbidden')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="text-center">

        <h1 class="display-1 fw-bold text-danger">
            403
        </h1>

        <h2 class="fw-semibold mb-3">
            Access Forbidden
        </h2>

        <p class="text-secondary mb-4">
            Sorry, you don't have permission to access this page.
            <br>
            Please contact the administrator if you believe this is a mistake.
        </p>

        <div class="d-flex justify-content-center gap-2">

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    <i class="bi bi-house-door-fill me-1"></i>
                    Back to Dashboard
                </a>
            @else
                <a href="{{ route('registration.sign-in') }}" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Sign In
                </a>
            @endauth

            <button class="btn btn-outline-secondary" onclick="history.back()">
                <i class="bi bi-arrow-left me-1"></i>
                Go Back
            </button>

        </div>

    </div>

</div>
@endsection