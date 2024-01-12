@extends('layouts.main')

@section('content')
<div class="container-content p-5">
  <form method="POST" action="/project/project-store">
        @csrf
        @php
            $i = 1;
        @endphp

        <h2 class="mb-4">Create New Project</h2>

        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name the project" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="johndoe" name="description" value="{{ old('description') }}">
          @error('description')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Member -->
        <div class="row mb-3">
            <label for="member" class="form-label">Member</label>
            <div>
                <div>
                    <select
                        class="form-control js-example-basic-multiple @error('member') is-invalid @enderror"
                        multiple="multiple"
                        name="{{ 'newitem[' . $i . '][member][]' }}">
                        @foreach ($users as $user)
                            <option
                                {{ old('member') == $user->username ? 'selected' : ' ' }}
                                value="{{ $user->username }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('member')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
          <label for="start_date" class="form-label">Start Date</label>
          <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="johndoe" name="start_date" value="{{ old('start_date') }}">
          @error('start_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- End Date -->
        <div class="mb-3">
          <label for="end_date" class="form-label">End Date</label>
          <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="johndoe" name="end_date" value="{{ old('end_date') }}">
          @error('end_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Create New Project</button>
        </div>
    </form>
</div>
@endsection