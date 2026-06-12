<footer class="footer mt-auto py-3 text-center">
    <div class="container">

        <!-- Mobile -->
        <span class="text-muted d-inline d-md-none">
            Copyright © {{ \Carbon\Carbon::now()->isoFormat('YYYY') }} .
            <a href="javascript:void(0);" class="text-dark fw-medium">Simrsmu</a>
        </span>

        <!-- Tablet & Desktop -->
        <span class="text-muted d-none d-md-inline">
            Copyright © {{ \Carbon\Carbon::now()->isoFormat('YYYY') }}
            <a href="javascript:void(0);" class="text-dark fw-medium">Simrsmu</a>.
            Designed with <span class="bi bi-heart-fill text-danger"></span> by
            <a href="{{ url('https://instagram.com/hiyussuf') }}" target="_blank">
                <span class="fw-medium text-primary">Sakudewa</span>
            </a>
            All rights reserved
        </span>

    </div>
</footer>
