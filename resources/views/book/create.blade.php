<div class="offset-md-7 col-md-2">
    <!-- Add Book Button -->
    <button class="btn btn-primary add-new btn-add" id="add-book-btn" >Add Book</button>

    <!-- Add Book Modal -->
    <div id="add-book-modal" class="modal">
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <h2>Add Book</h2>
            <form id="add-book-form" action="{{ route('books.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Book Name</label>
                        <input type="text" class="form-control" placeholder="Book Name" name="book_name" value="{{ old('book_name') }}"  >
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Book Number</label>
                        <input type="text" class="form-control" placeholder="Book Number" name="book_number" value="{{ old('book_number') }}" >
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Subject</label>
                        <select name="subject" class="form-control" >
                            <option value="" selected disabled>Select subject ..</option>
                            <option value="Math">Math</option>
                            <option value="Physics">Physics</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Edition</label>
                        <input type="text" class="form-control" placeholder="Edition" name="edition" value="{{ old('edition') }}" >
                    </div>
                </div>
                <input type="submit" class="btn btn-success mt-3" value="Save">
            </form>
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

        h2 {
            color: rgb(153, 12, 12);
        }

        /* Highlight invalid fields */
        input:invalid,
        select:invalid {
            border: 2px solid red;
        }

        input,
        select {
            transition: border 0.3s ease;
        }
        .btn-add{
            width: 30vh;
            height: 7vh;

        }
    </style>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('add-book-modal');
            const btn = document.getElementById('add-book-btn');
            const closeBtn = document.querySelector('.close-btn');
            const form = document.getElementById('add-book-form');

            // Open modal
            btn.addEventListener('click', () => {
                modal.style.display = 'block';
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

                // Check each input and select field
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.border = '2px solid red'; // Highlight invalid field
                    } else {
                        input.style.border = ''; // Reset border if valid
                    }
                });

                if (!isValid) {
                    e.preventDefault(); // Prevent form submission
                    // alert('Please fill out all required fields.'); // Optional user alert
                }
            });
        });
    </script>
</div>
