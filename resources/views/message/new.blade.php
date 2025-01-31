@extends('layouts.app')
@section('content')
<style>
        table {
        width: 100%;
        /* height: 70%; */
        border-collapse: collapse;
    }
    thead {
        display: block;
        position: sticky;
        top: 0;
        background-color: #fff;
        z-index: 1;
    }
    tbody {
        display: block;
        max-height: 80vh;
        overflow-y: auto;
        width: 100%;
    }
    tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }
    th, td {
        padding: 10px;
        font-size: medium;
        text-align: left;
        border: 1px solid #000000;
    }
    tr:nth-child(even) {
        background-color: #daa33e;
    }
    #modal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }
    #modal-form {
        max-height: 400px;
        overflow-y: auto;
    }
    #close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 16px;
        color: #000;
    }
    #modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    button {
        width: fit-content;
    }
</style>
<div id="admin-content">
    @include('message.message')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h2 class="admin-heading">All Books</h2>
            </div>
            <div class="col-md-4 text-center">
                <!-- Search Bar -->
                <input type="text" id="search-bar" class="form-control" placeholder="Search by any field">
            </div>
            <div class="col-md-4 text-end">
                @include('book.create')
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="message"></div>
                <table class="content-table">
                    <thead>
                        <th>#</th>
                        <th>Book Name</th>
                        <th>Book Number</th>
                        <th>Subject</th>
                        <th>Edition</th>
                        <th>Status</th>
                        <th>issue</th>
                        <th>Delete</th>
                    </thead>
                    <tbody id="book-table-body">
                        @forelse ($books as $book)
                            <tr>
                                <td class="id">{{ $book->id }}</td>
                                <td class="book-name">{{ $book->book_name }}</td>
                                <td>{{ $book->book_number }}</td>
                                <td>{{ $book->subject }}</td>
                                <td>{{ $book->edition }}</td>
                                <td>
                                    @if ($book->status == 'Available')
                                        <span class='badge badge-success'>Available</span>
                                    @else
                                        <span class='badge badge-danger'>Issued</span>
                                    @endif
                                </td>
                                <td class="delete">
                                    <form action="{{ route('book.destroy', $book) }}" method="post" >
                                        @csrf
                                        <button type="button" class="btn btn-danger delete-book" >Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Books Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Filtering -->
<script>
    document.getElementById('search-bar').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#book-table-body tr');

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            if (match) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    });
</script>

@endsection
