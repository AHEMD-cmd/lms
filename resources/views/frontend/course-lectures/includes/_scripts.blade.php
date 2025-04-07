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
    // Initialize Plyr
    var player = new Plyr('#player');
</script>

@php
    $lastWatched = \App\Models\LastWatchedLecture::where('user_id', auth()->id())
        ->where('course_id', $course->id)
        ->first();

    $defaultLecture = $course->lectures()->orderBy('course_section_id')->orderBy('number')->first();

    $initialLectureId = $lastWatched->lecture_id ?? $defaultLecture->id;
    $initialTime = $lastWatched->progress_in_seconds ?? 0;
@endphp

<script>
    const initialLectureId = {{ $initialLectureId }};
    const initialTime = {{ $initialTime }};
</script>


<script>
    $(document).ready(function() {
        // ###################### send the lecture id to the hidden input in the form of question ######################

        function loadLecture(lectureId, lectureVideoPath, lectureContent) {
            $('.lecture-id').val(lectureId);
            $('.questions-filter select option:nth-child(2)').val(lectureId);

            if (lectureVideoPath) {
                $('#lecture-viewer').html('<div class="text-center p-4">Loading video...</div>');

                $.ajax({
                    url: '/get-temp-video-url',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        video_path: lectureVideoPath
                    },
                    success: function(response) {
                        if (response.url) {
                            const video = $('#player');
                            video.attr('src', response.url);

                            setTimeout(() => {
                                video[0].currentTime = initialTime;
                                video[0].play();
                            }, 1000);
                        } else {
                            $('#lecture-viewer').html(
                                '<div class="alert alert-danger">Could not load video</div>');
                        }
                    },
                    error: function(xhr) {
                        $('#lecture-viewer').html(
                            '<div class="alert alert-danger">Error loading video</div>');
                    }
                });
            } else if (lectureContent) {
                $('#content-viewer').html(lectureContent);
            }
        }

        function saveWatchedProgress(lectureId, courseId, seconds) {
            $.ajax({
                url: '/save-watched-progress',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    course_id: courseId,
                    lecture_id: lectureId,
                    progress: seconds
                }
            });
        }


        $(document).on('click', '.section-lecture', function(e) {
            let $this = $(this);
            let lectureId = $this.data('id');
            let videoPath = $this.data('video');
            let content = $this.data('content');

            loadLecture(lectureId, videoPath, content);
            saveWatchedProgress(lectureId, '{{ $course->id }}', 0);
        });

        // Auto-load last watched lecture on page load
        $(document).ready(function() {

            let $initialLecture = $(`[data-id="${initialLectureId}"]`);
            $initialLecture.addClass('active');
            let videoPath = $initialLecture.data('video');
            let content = $initialLecture.data('content');


            loadLecture(initialLectureId, videoPath, content);
            saveWatchedProgress(initialLectureId, '{{ $course->id }}', initialTime);
        });

        // Track progress every 15 seconds
        // Track progress every 15 seconds and check for completion
        setInterval(() => {
            const video = document.getElementById('player');
            if (!video || video.paused || video.ended) return;

            let lectureId = $('.lecture-id').val();
            let courseId = '{{ $course->id }}';
            let seconds = Math.floor(video.currentTime);
            let duration = Math.floor(video.duration);

            // Check if we're within the last 20 seconds of the video
            const threshold = 20; // seconds from end
            const nearEnd = (duration - seconds) <= threshold;

            // Get the lecture checkbox element
            const lectureCheckbox = $(`.section-lecture[data-id="${lectureId}"]`).find(
                '.lecture-checkbox');

            // If we're near the end and the lecture isn't already marked as completed
            if (nearEnd && !lectureCheckbox.is(':checked')) {
                // Mark as completed
                lectureCheckbox.prop('checked', true);

                // Trigger the AJAX call to update completion status
                const sectionId = $(`.section-lecture[data-id="${lectureId}"]`).data('section-id');
                const sectionHeader = lectureCheckbox.closest('.card').find('.card-header');
                const countElement = sectionHeader.find('.course-duration span:first-child');

                $.ajax({
                    url: "{{ route('lecture.completed.update') }}",
                    method: 'PATCH',
                    data: {
                        lecture_id: lectureId,
                        section_id: sectionId,
                        course_id: courseId,
                        is_completed: 1
                    },
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Lecture marked as completed (auto)');
                            const currentCount = parseInt(countElement.text().split('/')[
                                0]);
                            const totalCount = parseInt(countElement.text().split('/')[1]);
                            const newCount = currentCount + 1;
                            countElement.text(`${newCount}/${totalCount}`);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error updating lecture status:', xhr.responseText);
                        // Revert checkbox on error
                        lectureCheckbox.prop('checked', false);
                    }
                });
            }

            // Always save progress (your existing code)
            $.ajax({
                url: '/save-watched-progress',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    course_id: courseId,
                    lecture_id: lectureId,
                    progress: seconds
                }
            });
        }, 15000);


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

        // ####################### lecture completed update ##############################
        // Prevent click on checkbox or label from bubbling to parent
        $(document).on('click', '.lecture-checkbox, .custom-control-label, .dropdown-item', function(e) {
            e.stopPropagation(); // Stop click from reaching .section-lecture
        });
        $('.lecture-checkbox').on('click', function() {
            event.stopPropagation();
            const checkbox = $(this);
            const lectureId = $(this).closest('.section-lecture').data('id');
            const sectionId = $(this).closest('.section-lecture').data('section-id');
            const isChecked = $(this).is(':checked');
            const sectionHeader = checkbox.closest('.card').find('.card-header');
            const countElement = sectionHeader.find('.course-duration span:first-child');

            $.ajax({
                url: "{{ route('lecture.completed.update') }}",
                method: 'PATCH',
                data: {
                    lecture_id: lectureId,
                    section_id: sectionId,
                    course_id: {{ $course->id }},
                    is_completed: isChecked ? 1 : 0
                },
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Lecture status updated successfully');
                        const currentCount = parseInt(countElement.text().split('/')[0]);
                        const totalCount = parseInt(countElement.text().split('/')[1]);
                        const newCount = isChecked ? currentCount + 1 : currentCount - 1;
                        countElement.text(`${newCount}/${totalCount}`);
                    }
                },
                error: function(xhr) {
                    // Revert checkbox on error
                    checkbox.prop('checked', !isChecked);
                    console.error('Error updating lecture status:', xhr.responseText);
                    // Optionally show error message to user
                    alert('Failed to update lecture status. Please try again.');
                }
            });
        });


        // {{-- ########### show textarea when rating is selected ########### --}}
        $(document).ready(function() {
            $('input[name="rate"]').on('change', function() {
                console.log('Rating changed');
                $('.course-review').removeClass('d-none').hide().fadeIn(300);
                $('.submit-review').removeClass('d-none').hide().fadeIn(300);
            });
        });

        // ###################### store review ######################
        $("#review-form").submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData = $(this).serialize(); // Serialize form data
            let courseSlug = $(this).find('#course-id').data('course-slug');

            $.ajax({
                url: '{{ route('courses.reviews.store', ':courseSlug') }}'.replace(
                    ':courseSlug', courseSlug),
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    $(".close").click(); // Simulate click on the back button
                    $("#leave-reating").hide();
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert("Something went wrong. Please try again.");
                }
            });
        });


    });
</script>
