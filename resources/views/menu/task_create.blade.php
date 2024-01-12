@extends('layouts.main')

@section('content')
<div class="container-content p-5">
  <form method="POST" action="/task/task_store">
        @csrf

        <h2 class="mb-4">Create Task</h2>

        <!-- Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name the task" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <input type="text" value="{{ $project_id }}" name="project_id">

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Create Task</button>
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
              <input type="text" class="form-control @error('task_${i}') is-invalid @enderror" id="task_${i}" placeholder="johndoe" name="task[]" value="{{ old('task_${i}') }}">
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