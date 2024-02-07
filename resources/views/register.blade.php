@extends('layouts.main')

@section('container')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<div
  class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center justify-content-center w-100">
    <div class="row justify-content-center w-100">
      <div class="col-md-8 col-lg-6 col-xxl-3">
        <div class="card mb-0">
          <div class="card-body">
            <h1 class="text-center">Register</h1>
            <form method="POST" action="/register">
              @csrf
              <div class="mb-3">
                <label for="exampleInputtext1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputtext1" aria-describedby="textHelp" value="{{ old('name') }}">
              </div>
              @error('name')
                <p>{{ $message }}</p>
              @enderror
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
              </div>
              @error('email')
                <p>{{ $message }}</p>
              @enderror
              <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="{{ old('password') }}">
              </div>
              @error('password')
                <p>{{ $message }}</p>
              @enderror
              <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
              <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                <a class="text-primary fw-bold ms-2" href="/login">Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection