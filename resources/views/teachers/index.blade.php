@extends('layouts.app')
@section('content')
<style>
    table {
        width: 100%;
        border-spacing: 0;
    }

    tbody, thead tr {
        display: block;
    }

    tbody {
        height: 65vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td, thead th {
        padding: 3px;
        font-size: medium;
        text-align: left;
        box-sizing: border-box;
    }

    thead th:nth-child(2), /* Book Name column */
    tbody td:nth-child(2),
    thead th:nth-child(3), /* Book Number column */
    tbody td:nth-child(3) {
        width: 200px; /* Adjust width as needed */
    }

    thead th:not(:nth-child(2)):not(:nth-child(3)),
    tbody td:not(:nth-child(2)):not(:nth-child(3)) {
        width: 140px; /* Default width for other columns */
    }

    tr:nth-child(even) {
        background-color: #daa33e;
    }

    .btn {
        width: max-content;
    }

    .no-data {
        text-align: center;
        color: red;
        font-weight: bold;
    }
</style>


<div id="admin-content">
    @include('message.message')
    <div class="container">
        <div class="row align-items-center">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="search-bar" class="form-control" placeholder="Search by any field">
            </div>
            <div class="col-md-4 text-end">
                @include('teachers.create')
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="message"></div>
                <div class="tbl-body">
                    <table style="width:100%;">
                        <h2 class="admin-heading mb-2">All Teachers</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher Name</th>
                                <th>Tsc No</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-body">
                    <table style="width:100%;">
                        <tbody id="teacher-table-body">
                            @forelse ($teachers as $index => $teacher)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="teacher-name">{{ $teacher->teacher_name }}</td>
                                    <td class="">{{ $teacher->tsc_no }}</td>
                                    <td>{{ $teacher->gender }}</td>
                                    <td>{{ $teacher->position }}</td>
                                    <td class="delete">
                                        <form action="{{ route('teachers.destroy', $teacher) }}" method="post" class="form-hidden">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Teacher?')">Delete</button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;">No Teachers Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Filtering -->
<script>
    document.getElementById('search-bar').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#teacher-table-body tr');

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });


</script>
@endsection
