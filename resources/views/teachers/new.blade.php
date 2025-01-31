@extends('layouts.app')
@section('content')
<style>
      thead{
        /* padding-left: 0px; */
      }
    th, td {
        padding: 10px;
        font-size: medium;
        /* text-align: left; */
        box-sizing: border-box;
    }
    tr:nth-child(even) {
        background-color: #daa33e;
    }

    /* Fixed Header Styles */
    .tbl-header {
        width: calc(100% - 17px); /* Accounts for scrollbar width */
        width: -webkit-calc(100% - 17px);
        width: -moz-calc(100% - 17px);
        background-color: #df9b0a;
        z-index: 1;
    }
    .tbl-body {
        width: 100%;
        overflow-y: auto;
        max-height: 70vh; /* Adjust as needed */
    }
    .btn{
        width: fit-content;
    }
</style>

<div id="admin-content">
    @include('message.message')
    <div class="row">
        <div class="col-md-4">
            <!-- Search Bar -->
            <input type="text" id="search-bar" class="form-control" placeholder="Search by Student Name">
        </div>
        <div class="col-md-4 text-end">
            @include('teachers.create')
        </div>
    </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="message"></div>

                <!-- Table with Fixed Header -->
                <div class="tbl-header">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
    // Filter table rows based on search input
    document.getElementById('search-bar').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#teacher-table-body tr');

        rows.forEach(row => {
            const studentName = row.querySelector('.student-name').textContent.toLowerCase();
            if (studentName.includes(filter)) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    });

    // Hide modal box
    $(document).on("click", "#close-btn, #modal-overlay", function() {
        $("#modal, #modal-overlay").hide();
        $("#modal-form table").empty();
    });
</script>

@endsection
