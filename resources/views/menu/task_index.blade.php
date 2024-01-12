@extends('layouts.main')

@section('content')
<div class="container-content p-5">
    <div class="table-container">
    <div class="btn-group mb-5 gap-4">
        <select class="form-control js-example-basic-multiple" id="mySelect" name="area"
            style="width: 12rem">
            @if ($project_selected == null)
                <option selected>No Project Choose</option>
            @endif
            @foreach ($projects as $project)
                <option {{ $project_selected == $project->id ? 'selected' : ' '}} value="{{ base64_encode($project->id) }}">{{ $project->name }}</option>
            @endforeach
        </select>

        <a href="{{ $project_selected ? '/task/task_create/encrypt($project_selected)' : '#' }}" class="btn {{ $project_selected ? 'btn-success' : 'btn-secondary' }}" {{ $project_selected ? '' : 'disabled' }}>Add New Task</a>
    </div>

    <table id="tableSort" class="table table-bordered table-hover" style="width: 100%">
        <thead>
            <tr>
                <th>Taks Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBodyContents">
            @if ($tasks !== null)
                @foreach ($tasks as $task)
                    <tr class="tableRow" data-id="{{ $task->id }}">
                        <td>{{ $task->name }}</td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $task->id }}" style="cursor: pointer;">
                                <i data-feather="trash-2" class="icon-action" style="color: #CA4E4E" width=20px></i>
                            </a>
                            <a href="/task/task_edit/{{ encrypt($task->id) }}">
                                <i data-feather="edit" class="icon-action" style="color: #9A55A3" width=20px></i>
                            </a>
                        </td>


                        <!-- Confirmation Modal -->
                        <div class="modal fade modalDelete" id="deleteModal-{{ $task->id }}"
                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this task?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-wrap">
                                        <p>Task: {{ $task->name }}</p>
                                        The task will automatically deleted from the database
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <form
                                            action="/task/task_project/{{ encrypt($task->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mySelect').on('change', function() {
            var valProject = $('#mySelect').val();
            window.location.href = '/task/task_project/' + valProject;
        });
    });
</script>

<script type="text/javascript">
        $(function () {
            $("#tableBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var valProject = $('#mySelect').val();
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.tableRow').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('/task/task_reorder') }}",
                    data: {
                        order: order,
                        project_id: valProject,
                        _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.reload();
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
    </script>

@endsection