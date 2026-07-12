@extends('layouts.main')

@section('title')
    Eduxamp
@endsection

@section('css_custom')
@endsection

@section('content')
    <div class="main-wrapper">
        <!-- Hero Section -->
        <section class="bg-primary text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h1 class="display-4 fw-bold">Welcome to Eduxamp</h1>
                        <p class="lead mt-3">
                            Your platform for managing college enrollment,
                            majors, and student academic information.
                        </p>
                        <a class="btn btn-light btn-lg mt-3">Login</a>
                    </div>
                    <div class="col-md-5 text-center">
                        <div class="bg-white text-primary rounded p-5 shadow">
                            <h3>Start Your Journey</h3>
                            <p>Choose your major and enroll easily through our system.</p>
                            <i class="bi bi-mortarboard-fill display-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2>Why Choose Eduxamp?</h2>
                    <p class="text-muted">A simple and efficient platform for college enrollment management.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <h3 class="text-primary">🎓</h3>
                                <h5 class="card-title">Easy Enrollment</h5>
                                <p class="card-text">Students can easily register and select their preferred major.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <h3 class="text-primary">📚</h3>
                                <h5 class="card-title">Major Management</h5>
                                <p class="card-text">Manage available majors and academic programs efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <h3 class="text-primary">🔒</h3>
                                <h5 class="card-title">Secure Data</h5>
                                <p class="card-text">Student data is managed securely with authentication and audit
                                    tracking.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-light py-5">
            <div class="container text-center">
                <h2>Ready to Apply?</h2>
                <p>Login now and start your enrollment process.</p>
                <a class="btn btn-primary">Get Started</a>
            </div>
        </section>
    </div>
@endsection


@section('js_custom')
@endsection
