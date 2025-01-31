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
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="message"></div>
                <div class="tbl-body">
                    <table style="width:100%;">
                        <h2 class="admin-heading mb-2">Available Books</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Book Name</th>
                                <th>Book Number</th>
                                <th>Subject</th>
                                <th>Edition</th>
                                <th>Issue</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-body">
                    <table style="width:100%;">
                        <tbody id="book-issue-table-body">
                            @if ($availableBooks != null)
                                @foreach ($availableBooks as $index => $book)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $book->book_name }}</td>
                                        <td>{{ $book->book_number }}</td>
                                        <td>{{ $book->subject }}</td>
                                        <td>{{ $book->edition }}</td>
                                        <td>

                                            @include('book.issueBook_add')
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No Books Found</td>
                                </tr>
                            @endif
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
        const rows = document.querySelectorAll('#book-issue-table-body tr');

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });


</script>
@endsection
