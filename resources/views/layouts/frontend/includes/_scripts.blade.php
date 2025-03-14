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


     $(document).ready(function() {
         // #################### add to cart ####################
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
                         // update cart items number in the header
                         $('.product-count').text(response.cartItemsNumber);

                         $this.attr('href', "{{ route('carts.index') }}")
                             .removeClass('add-to-cart')
                             .addClass('go-to-cart')
                             .html(
                                 '<i class="la la-shopping-cart mr-1 fs-18"></i> Go to Cart'
                             );

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
         // ##################### end add to cart #####################

         // ##################### add to wishlist #####################
         $('.wishlist').on('click', function() {
             var courseId = $(this).data('id'); // Get course ID from data-id
             var $icon = $(this).find('i'); // Target the icon inside

             $.ajax({
                 url: '/wish-list/' + courseId, // Route URL
                 method: $icon.hasClass('la-heart-o') ? 'POST' : 'DELETE',
                 data: {
                     course_id: courseId, // Send course_id in request body
                     _token: '{{ csrf_token() }}' // CSRF token for Laravel
                 },
                 success: function(response) {
                     if (response.status === 'success') {
                         // Toggle icon class based on current state
                         if ($icon.hasClass('la-heart-o')) {
                             $icon.removeClass('la-heart-o').addClass('la-heart');
                         } else {
                             $icon.removeClass('la-heart').addClass('la-heart-o');
                         }
                         $('.header-wishlist').html(response.wishlistedCourses);
                         if (response.wishlistedCoursesNumber === 0) {
                             $('.header-go-to-wishlist').hide();
                             $('.explore-courses').show();
                         }else{
                             $('.explore-courses').hide();
                             $('.header-go-to-wishlist').show();
                         }

                     }
                 },
                 error: function(xhr) {
                     Swal.fire({
                         toast: true,
                         position: 'top-end',
                         icon: 'error',
                         title: xhr.responseJSON.message,
                         showConfirmButton: false,
                         timer: 3000
                     });
                 }
             });
         });
         // ##################### end add to wishlist #####################
     });
 </script>
