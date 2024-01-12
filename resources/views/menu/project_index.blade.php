@extends('layouts.main')

@section('content')
<div class="container-content p-5">
  <a href="/project/project-create" class="btn btn-primary mt-4 mb-4">Add New Project</a>
  <div class="table-container">
    <table id="example" class="table table-striped table-bordered hover" style="width: 100%">
        <thead>
            <tr>
                <th>Time</th>
                <th>Filename</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="content">
            @php
                use Carbon\Carbon;
            @endphp
              <tr>
                  <td>Nama Project</td>
                  <td>Nama Project</td>
                  <td>Nama Project</td>
              </tr>
        </tbody>
    </table>
  </div>
</div>
<div class="container">
</div>
@endsection