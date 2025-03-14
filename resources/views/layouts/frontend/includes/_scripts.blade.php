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
 <script src="{{ asset('assets/frontend') }}/js/plyr.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/jquery.lazy.min.js"></script>
 <script src="{{ asset('assets/frontend') }}/js/main.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     var player = new Plyr('#player');


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


     // add to cart
     $(document).ready(function() {
         $(document).on('click', '.add-to-cart', function(e) {
             e.preventDefault();

             let $this = $(this);
             let courseId = $this.data('course-id');

             $.ajax({
                 url: "{{ route('carts.store') }}",
                 method: "POST",
                 data: {
                     course_id: courseId,
                     _token: "{{ csrf_token() }}"
                 },
                 success: function(response) {
                     if (response.status === 'success') {
                         $this.attr('href', "{{ route('carts.index') }}")
                             .removeClass('add-to-cart')
                             .addClass('go-to-cart')
                             .html('<i class="la la-shopping-cart mr-1 fs-18"></i> Go to Cart');

                         $('.header-cart').html(response.cartItems);
                     }
                 },
                 error: function(xhr) {
                     alert(xhr.responseJSON.message);
                 }
             });
         });

         // Optional: Handle 'Go to Cart' click
         $(document).on('click', '.go-to-cart', function(e) {
             window.location.href = $(this).attr('href');
         });
     });
 </script>
