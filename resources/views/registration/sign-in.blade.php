@extends('registration.main')

@section('title')
    Eduxamp | Sign in
@endsection

@section('form')
<div class="d-grid gap-3 justify-content-center">
  <h5 class="card-title">Login</h5>
  <form action="{{ url('sign-in/auth') }}" method="POST">
      @csrf
      <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <span>Don't have an account? <a href="{{ url('sign-up') }}">Sign Up</a> here.</span>
</div>
@endsection
