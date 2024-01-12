@extends('layouts.main')

@section('content')
<div class="container-content p-5">
    <div class="table-container">
    <div class="btn-group mb-5">
        <select class="form-control js-example-basic-multiple" id="mySelect" name="area"
            style="width: 12rem">
            @if ($project_selected == null)
                <option selected>No Project Choose</option>
            @endif
            @foreach ($projects as $project)
                <option {{ $project_selected == '$project->id' ? 'selected' : ' '}} value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>

    <table id="example" class="table table-striped table-bordered hover" style="width: 100%">
        <thead>
            <tr>
                <th>Taks Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="content">
            @php
                use Carbon\Carbon;
            @endphp
            @if ($tasks !== null)
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>
                            <a href="">
                                <i data-feather="eye" class="icon-action" style="color: #434D56" width=20px></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal" style="cursor: pointer;">
                                <i data-feather="trash-2" class="icon-action" style="color: #CA4E4E" width=20px></i>
                            </a>
                            <a href="">
                                <i data-feather="edit" class="icon-action" style="color: #9A55A3" width=20px></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mySelect').on('change', function() {
            var valProject = $('#mySelect').val();
            window.location.href = '/task/task_project/' + valProject;
        });
    });
</script>
@endsection