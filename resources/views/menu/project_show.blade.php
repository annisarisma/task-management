@extends('layouts.main')

@section('content')
<div class="container-content p-5">
    <a href="/project/project-create" class="btn btn-primary mt-4 mb-4">Add New Project</a>
    <div class="table-container">
    <div class="btn-group">
        <select class="form-control js-example-basic-multiple" id="mySelect" name="area"
            style="width: 12rem">
            @if (isset($status))
                <option {{ $status == 'Semua' ? 'selected' : ' ' }} value="all-reviews">Semua</option>
                <option {{ $status == 'Menunggu Kontributor' ? 'selected' : ' ' }}
                    value="Menunggu Kontributor">Menunggu Kontributor</option>
                <option {{ $status == 'Dalam Review' ? 'selected' : ' ' }} value="Dalam Review">Dalam Review
                </option>
                <option {{ $status == 'Selesai' ? 'selected' : ' ' }} value="Selesai">Selesai</option>
                <option {{ $status == 'Proses Superadmin' ? 'selected' : ' ' }} value="Proses Superadmin">
                    Proses Superadmin</option>
                <option {{ $status == 'Ditolak' ? 'selected' : ' ' }} value="Ditolak">Ditolak</option>
            @endif
        </select>
    </div>

    <table id="example" class="table table-striped table-bordered hover" style="width: 100%">
        <thead>
            <tr>
                <th>project Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="content">
            @php
                use Carbon\Carbon;
            @endphp
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
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
        </tbody>
    </table>
  </div>
</div>
<div class="container">
</div>
@endsection