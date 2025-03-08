<!-- template js files -->
<script src="{{ asset('assets/frontend') }}/js/jquery-3.4.1.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/isotope.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/fancybox.js"></script>
<script src="{{ asset('assets/frontend') }}/js/chart.js"></script>
<script src="{{ asset('assets/frontend') }}/js/doughnut-chart.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bar-chart.js"></script>
<script src="{{ asset('assets/frontend') }}/js/line-chart.js"></script>
<script src="{{ asset('assets/frontend') }}/js/datedropper.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/emojionearea.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/animated-skills.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.MultiFile.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/main.js"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

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
