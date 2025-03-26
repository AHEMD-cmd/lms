<!-- template js files -->
<script src="{{ asset('assets/frontend') }}/js/jquery-3.4.1.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/isotope.js"></script>
<script src="{{ asset('assets/frontend') }}/js/waypoint.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.counterup.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/fancybox.js"></script>
<script src="{{ asset('assets/frontend') }}/js/plyr.js"></script>
<script src="{{ asset('assets/frontend') }}/js/datedropper.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/emojionearea.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery-te-1.4.0.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/jquery.MultiFile.min.js"></script>
<script src="{{ asset('assets/frontend') }}/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Define our video sources with quality options
        const source = {
            type: 'video',
            title: 'View From A Blue Moon',
            sources: [{
                    src: 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4',
                    type: 'video/mp4',
                    size: 1080,
                },
                {
                    src: 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4',
                    type: 'video/mp4',
                    size: 720,
                },
                {
                    src: 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',
                    type: 'video/mp4',
                    size: 576,
                }
            ],
            tracks: [{
                    kind: 'captions',
                    label: 'English',
                    srclang: 'en',
                    src: 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt',
                    default: true,
                },
                {
                    kind: 'captions',
                    label: 'French',
                    srclang: 'fr',
                    src: 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt',
                }
            ]
        };

        // Get the video element
        const video = document.querySelector('#player');

        // Empty the video element - we'll set sources through JavaScript
        video.innerHTML = '';

        // Initialize Plyr
        const player = new Plyr(video, {
            captions: {
                active: true,
                update: true
            },
            quality: {
                default: 720,
                options: [1080, 720, 576]
            }
        });

        // Set the source after the player is initialized
        player.source = source;
    });
</script>


<script>
    $(document).ready(function() {
        // ###################### send the lecture id to the hidden input in the form of question ######################
        $(document).on('click', '.section-lecture', function(e) {
            let $this = $(this);
            let lectureId = $this.data('id');

            // hidden input in the form of question and form of replay
            $('.lecture-id').val(lectureId);

            // Update the value of the second option in the select dropdown inside .questions-filter
            $('.questions-filter select option:nth-child(2)').val(lectureId);
        });


        // ######################## questions filter ###################   
        function fetchQuestions(isFilter = false) {
            let searchQuery = $('#question-search').val();
            let lectureFilter = $('.questions-filter select').val();
            let onlyMyQuestions = $('#questionsIAsked').is(':checked') ? 1 : 0;
            let noResponses = $('#questionsWithNoResponses').is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('questions.index') }}",
                method: "GET",
                data: {
                    search: searchQuery,
                    course_id: lectureFilter === "{{ $course->id }}" ? lectureFilter : null,
                    lecture_id: lectureFilter === "{{ $course->id }}" ? null : lectureFilter,
                    only_my_questions: onlyMyQuestions,
                    no_responses: noResponses,
                    isFilter: isFilter ? 1 : 0, // Send 1 if filtering, 0 if loading more
                },
                success: function(response) {
                    $(".question-list-item").html(response.questions);
                    if (response.loadedFilteredQuestions == response.allFilteredQuestions) {
                        $('.see-more-questions-btn').hide();
                    }
                },
                error: function() {
                    alert("Error fetching questions");
                }
            });
        }

        // ###################### store question ######################
        $(".question-form").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: "{{ route('questions.store') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    fetchQuestions()
                    $(".back-to-question-btn").click(); // Simulate click on the back button
                    $("#number-of-questions").text(response.questionsNumber +
                        ' questions in this course');
                    $('#no-questions-box').hide();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });

        // ###################### store replay ######################
        $(document).on('submit', '.reply-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('replies.store') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    $('.question-replies').html(response); // Update replies section
                    $('.replay-question-wrap').addClass(
                        'active'); // Show the replies section
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });

        // ################ load the question with its replies ##################
        $(document).on('click', '.question-replay-btn', function() {
            let questionId = $(this).data('id'); // Get question ID

            $.ajax({
                url: "/questions/" + questionId, // Define the route
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $('.question-replies').html(response); // Update replies section
                    $('.replay-question-wrap').addClass(
                        'active'); // Show the replies section
                },
                error: function() {
                    console.error("Error loading replies");
                }
            });
        });

        // ############### upvote questions ##################
        $(document).on("click", ".arrow-up", function() {
            let questionId = $(this).data("id");
            let button = $(this);
            let upvoteElement = button.closest(".number-upvotes").find("span");

            $.ajax({
                url: '{{ route('questions.upvotes.store', ':questionId') }}'.replace(
                    ':questionId', questionId),
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(response) {
                    upvoteElement.text(response.upvotes);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                },
            });
        });


        // ####################### event listeners ##############################
        $('input[name="search"]').on('input', () => fetchQuestions(true));
        $('.questions-filter select').on('change', () => fetchQuestions(true));
        $('#questionsIAsked, #questionsWithNoResponses').on('change', () => fetchQuestions(true));

        // ################ see more questions ##################
        $(document).on('click', '.see-more-questions-btn', function() {
            fetchQuestions(false)
        });

        // ################ back to questions btn from replay ##################
        $(document).on('click', '.back-to-question-btn', function() {
            fetchQuestions(true)
        });

        // ####################### end event listeners ##############################


    });
</script>
