@extends('layouts.app')
@section('content')

<style>body {
    overflow: hidden; /* Remove scrollbars from the page */
}

table {
    width: 100%;
    border-spacing: 0;
}

tbody, thead tr {
    display: block;
}

tbody {
    height: 65vh;
    overflow-y: auto; /* Enable scrolling for the table body */
    overflow-x: hidden;
    scrollbar-width: thin; /* Firefox: Thin scrollbar */
    scrollbar-color: #ccc transparent; /* Firefox: Custom scrollbar color */
}

tbody::-webkit-scrollbar {
    width: 8px; /* Adjust scrollbar width */
}

tbody::-webkit-scrollbar-thumb {
    background-color: #ccc; /* Scrollbar thumb color */
    border-radius: 4px;
}

tbody::-webkit-scrollbar-track {
    background-color: transparent; /* Scrollbar track color */
}

tbody td, thead th {
    padding: 3px;
    font-size: medium;
    text-align: left;
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
                    <table>
                        <h2 class="admin-heading mb-2">Issued Books</h2>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Adm No</th>
                                <th>Book Name</th>
                                <th>Book Number</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                                <th>Return</th>
                            </tr>
                        </thead>
                        <tbody id="issued-table-body">
                            @if ($issueBooks != null && count($issueBooks) > 0)
                                @foreach ($issueBooks as $index => $book)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- Display the row number -->
                                        <td>{{ $book->student_adm_no }}</td>
                                        <td>{{ $book->book_name }}</td>
                                        <td>{{ $book->book_number }}</td>
                                        <td>{{ $book->issue_date }}</td>
                                        <td>{{ $book->return_date }}</td>
                                        <td>
                                            <form action="{{ route('book_issue.destroy', $book->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning delete-book" onclick="return confirm('Do you want to return the book?')">
                                                    Return
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="no-data">No Books Found</td>
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
        const rows = document.querySelectorAll('#issued-table-body tr');

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
        });
    });


</script>
@endsection
