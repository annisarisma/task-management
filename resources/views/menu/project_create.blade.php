@extends('layouts.main')

@section('content')
<div class="container-content p-5">
  <a href="/project/project-create" class="btn btn-primary mt-4 mb-4">Add Project</a>
  <form method="POST" action="/register/store">
        @csrf
        <h2 class="mb-4">Create New Project</h2>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name the project" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="johndoe" name="description" value="{{ old('description') }}">
          @error('description')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="member" class="form-label">Add Member</label>
          <input type="member" class="form-control @error('member') is-invalid @enderror" id="member" placeholder="name@example.com" name="member" value="{{ old('member') }}">
          @error('member')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Type your password here" name="password" value="{{ old('password') }}">
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Re-type your password here" name="confirm_password" value="{{ old('confirm_password') }}">
          @error('confirm_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
    
        <p class="mt-4">Have an account? <a href="/login">Login</a></p>
    </form>
</div>
<div class="container">
</div>
@endsection