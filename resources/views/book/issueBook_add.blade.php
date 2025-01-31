<!-- Issue Button -->
<button class="btn btn-primary issue-btn" data-book-name="{{ $book->book_name }}" data-book-number="{{ $book->book_number }}" data-book-id="{{ $book->id }}">Issue</button>

<div class="offset-md-7 col-md-2">
    <!-- Issue Book Modal -->
    <div id="add-student-modal" class="modal">
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <h2>Issue Book</h2>
            <form id="add-student-form" action="{{ route('book_issue.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Student Adm No</label>
                        <input type="text" class="form-control" placeholder="Student adm no" name="student_adm_no" value="{{ old('student_adm_no') }}" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Book Name</label>
                        <input readonly  type="text" class="form-control" placeholder="Book name" name="book_name" id="book_name" value="{{ old('book_name') }}" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Book Number</label>
                        <input readonly  type="text" class="form-control" placeholder="Book number" name="book_number" id="book_number" value="{{ old('book_number') }}" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Issue Date</label>
                        <input type="date" class="form-control" name="issue_date" id="issue_date"
                            value="{{ old('issue_date', date('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Return Date</label>
                        <input type="date" class="form-control" name="return_date" id="return_date"
                            value="{{ old('return_date', date('Y-m-d', strtotime('+10 days'))) }}">
                    </div>

                </div>
                <input type="submit" class="btn btn-success mt-3" value="Issue">
            </form>
        </div>
    </div>
</div>

<!-- Styles for Modal -->
<style>
    body {
        overflow: hidden;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 8px;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 20px;
        cursor: pointer;
    }

    input:invalid,
    select:invalid {
        border: 2px solid red;
    }

    input,
    select {
        transition: border 0.3s ease;
    }
</style>

<!-- JavaScript for Modal -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('add-student-modal');
        const closeBtn = document.querySelector('.close-btn');
        const form = document.getElementById('add-student-form');

        // Event delegation for all Issue buttons
        document.addEventListener('click', (e) => {
            if (e.target && e.target.classList.contains('issue-btn')) {
                const bookName = e.target.getAttribute('data-book-name');
                const bookNumber = e.target.getAttribute('data-book-number');
                const bookId = e.target.getAttribute('data-book-id');

                // Populate the modal fields with the selected book details
                document.getElementById('book_name').value = bookName;
                document.getElementById('book_number').value = bookNumber;

                // Create a hidden input for the book ID and append it to the form
                let bookIdInput = document.querySelector('input[name="book_id"]');
                if (!bookIdInput) {
                    bookIdInput = document.createElement('input');
                    bookIdInput.type = 'hidden';
                    bookIdInput.name = 'book_id';
                    form.appendChild(bookIdInput);
                }
                bookIdInput.value = bookId;

                // Show the modal
                modal.style.display = 'block';
            }
        });

        // Close modal
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Form validation
        form.addEventListener('submit', (e) => {
            let isValid = true;
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.border = '2px solid red';
                } else {
                    input.style.border = '';
                }
            });

            if (!isValid) {
                e.preventDefault();
                // alert('Please fill out all required fields.');
            }
        });
    });
</script>
