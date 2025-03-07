 <!-- template js files -->
 <script src="{{ asset('assets/frontend') }}/js/jquery-3.4.1.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/bootstrap.bundle.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/bootstrap-select.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/isotope.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/waypoint.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/jquery.counterup.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/fancybox.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/datedropper.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/emojionearea.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/tooltipster.bundle.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/jquery.lazy.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/main.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 @section('scripts')
     <script>
         @if (session('message'))
             Swal.fire({
                 toast: true,
                 position: 'top-end', 
                 icon: 'success',
                 title: "{{ session('message') }}",
                 showConfirmButton: false,
                 timer: 3000 
             });
         @endif

        //  @if ($errors->any())
        //      Swal.fire({
        //          toast: true,
        //          position: 'top-end', 
        //          icon: 'error',
        //          title: "{{ $errors->first() }}",
        //          showConfirmButton: false,
        //          timer: 3000 
        //      });
        //  @endif
     </script>
 @endsection
