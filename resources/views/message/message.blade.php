@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show success-alert" role="alert">
        {{ session('success') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button> --}}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show error-alert" role="alert">
        {{ session('error') }}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">x</button> --}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show error-alert" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Add custom CSS for the alerts -->
<style>
    .success-alert, .error-alert {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1050;
        max-width: 300px; /* Adjust the width as needed */
        width: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Add JavaScript to automatically dismiss the alerts after 5 seconds -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Automatically dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.remove('show'); // Remove 'show' class to hide the alert
                alert.addEventListener('transitionend', () => alert.remove()); // Remove the alert element after the transition
            }, 3000); // 5000 milliseconds = 5 seconds
        });
    });
</script>
