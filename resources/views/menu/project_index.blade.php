@extends('layouts.main')

@section('content')

@include('layouts.flash-message')
<div class="container-content px-5">
    <a href="/project/project-create" class="btn btn-primary mt-4 mb-4">Add New Project</a>
    <div class="table-container">
        <table id="example" class="table table-striped table-bordered table-hover" style="width: 100%">
            <thead>
                <tr>
                    <th>project Name</th>
                    <th>Description</th>
                    <th>Project Owner</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="content">
                @php
                    use Carbon\Carbon;
                @endphp
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->user->username }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>
                            <div>
                                <a data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $project->id }}" style="cursor: pointer;">
                                    <i data-feather="trash-2" class="icon-action" style="color: #CA4E4E" width=20px></i>
                                </a>
                                <a href="/project/project-edit/{{ encrypt($project->id) }}">
                                    <i data-feather="edit" class="icon-action" style="color: #9A55A3" width=20px></i>
                                </a>
                            </div>
                        </td>


                        <!-- Confirmation Modal -->
                        <div class="modal fade modalDelete" id="deleteModal-{{ $project->id }}"
                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this project?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-wrap">
                                        <p>Project: {{ $project->name }}</p>
                                        The project will automatically deleted from the database
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <form
                                            action="/project/project-destroy/{{ encrypt($project->id) }}"
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
            </tbody>
        </table>
    </div>
</div>
<div class="container">
</div>
@endsection