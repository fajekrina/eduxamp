@extends('registration.main')

@section('title')
    Eduxamp | Sign in
@endsection

@section('form')
<div class="d-grid gap-3 justify-content-center">
  <h5 class="card-title">Regiter</h5>
  <form>
      <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password">
      </div>
      <div class="mb-3">
          <label for="confirm-password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm-password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <span>Do have an account? <a href="{{ url('sign-in') }}">Sign In</a> here.</span>
</div>
@endsection
