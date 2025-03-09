<script src="{{ asset('assets/dashboard') }}/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{ asset('assets/dashboard') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/chartjs/js/chart.js"></script>
<script src="{{ asset('assets/dashboard') }}/js/index.js"></script>
<!--app JS-->
<script src="{{ asset('assets/dashboard') }}/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>

<!--Datatable-->
<script src="{{ asset('assets/dashboard') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<!--End Datatable-->


<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<!-- End Sweet Alert -->


<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<!-- End CKEditor CDN -->

<!-- Show Success Message -->
<script>
    @if (session('message'))

        Swal.fire({
            toast: true,
            position: 'top-end', // Position at top-right corner
            icon: 'success',
            title: '{{ session('message') }}',
            showConfirmButton: false,
            timer: 3000, // Auto-close after 3 seconds
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    @endif
</script>
