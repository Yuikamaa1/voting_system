<div class="offset-md-7 col-md-2">
    <!-- Add Student Button -->
    <button class="btn btn-primary add-new btn-add" id="add-teacher-btn">Add Teachers</button>
    <!-- Add Student Modal -->
    <div id="add-teacher-modal" class="modal">
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <h2>Add Teacher</h2>
            <form id="add-teacher-form" action="{{ route('teachers.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Teacher Name</label>
                        <input type="text" class="form-control" placeholder="Teacher Name" name="teacher_name" value="{{ old('teacher_name') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Tsc No</label>
                        <input type="text" class="form-control" placeholder="tsc no" name="tsc_no" value="{{ old('tsc_no') }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            {{-- <option selected disabled>select gender</option> --}}
                            <option value="" selected disabled>Select gender ..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Position</label>
                        <select name="position" class="form-control">
                            <option value="" selected disabled>select position</option>
                            <option value=" Senior Teacher"> Senior Teacher</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Teacher on Practice">Teacher on Practice</option>
                        </select>
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
        h2{
            color: rgb(153, 12, 12);
        }
        .btn-add{
            width: 30vh;
            height: 7vh;

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
            const modal = document.getElementById('add-teacher-modal');
            const btn = document.getElementById('add-teacher-btn');
            const closeBtn = document.querySelector('.close-btn');
            const form = document.getElementById('add-teacher-form');

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
    <script>
        const modal = document.getElementById('add-student-modal');
        const btn = document.getElementById('add-student-btn');
        const closeBtn = document.querySelector('.close-btn');

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
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</div>
