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
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter a unique and meaningful name for your project" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Describe your project in detail " name="description" value="{{ old('description') }}">
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
                        <option value="" disabled selected>Select members...</option>
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

        <!-- Task -->
        <div class="mb-3">
          <label for="task" class="form-label">Tasks</label>
          <button class="btn btn-sm btn-success tambah_item" type="button" id="dynamic-ar">Tambah Data</button>
          
          <div class="container-inputTask" id="tasks_append">
            <div class="inputTask d-flex gap-2 mt-3">
              <input type="text" class="form-control @error('task') is-invalid @enderror" id="task" placeholder="Write some task" name="task[]" value="{{ old('task') }}">
              <button type="button" name="add" class="btn btn-danger">Remove</button>
            </div>
          </div>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Create New Project</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function() {
        ++i;
        $("#tasks_append").append(
            `<div class="inputTask d-flex gap-2 mt-3">
              <input type="text" class="form-control @error('task_${i}') is-invalid @enderror" id="task_${i}" placeholder="Write some task" name="task[]" value="{{ old('task_${i}') }}">
              <button type="button" name="add" class="btn btn-danger">Remove</button>
            </div>`
        );
    });

    $(document).ready(function() {
        $(document).on('click', '.btn-danger', function() {
            $(this).closest('.inputTask').remove();
        });
    });
</script>
@endsection