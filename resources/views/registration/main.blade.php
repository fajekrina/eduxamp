@extends('landing-page.main')

@section('content')
    <div class="main-wrapper">
        <div class="container-fluid bg-light align-content-center min-vh-100">
            <div class="d-flex justify-content-center">
                <div class="card text-center mb-3" style="min-width: 25rem;">
                    <div class="card-body">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
