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
        widows: 100%;
        height: 65vh;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td, thead th {
        padding: 3px;
        font-size: medium;
        text-align: center;
        box-sizing: border-box;
    }

    thead th:nth-child(2),
    tbody td:nth-child(2),
    thead th:nth-child(3),
    tbody td:nth-child(3) {
        width: 200px;
    }

    thead th:not(:nth-child(2)):not(:nth-child(3)),
    tbody td:not(:nth-child(2)):not(:nth-child(3)) {
        width: 140px;
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

    .student-row {
        cursor: pointer;
    }
</style>

<div id="admin-content">
    @include('message.message')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <input type="text" id="search-bar" class="form-control" placeholder="Search by any field">
            </div>
            <div class="col-md-4 text-end">
                @include('student.create')
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="tbl-body">
                    <table style="width:100%; margin-left: 0px;" Class="ms-0">
                        <h2 class="admin-heading mb-2">All Students</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Admission No</th>
                                <th>Admission Date</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Parent Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="student-table-body">
                            @if ($students != null && count($students) > 0)
                                @foreach ($students as $index => $student)
                                    <tr class="student-row" data-adm-no="{{ $student->admission_no }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->admission_no }}</td>
                                        <td>{{ $student->admission_date }}</td>
                                        <td>{{ $student->class }}</td>
                                        <td>{{ $student->gender }}</td>
                                        <td>{{ $student->parent_phone }}</td>
                                        <td>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="no-data">No students Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('search-bar').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#student-table-body tr');

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });


</script>

@endsection
