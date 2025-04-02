@extends('layouts.dashboard.instructor.master')

@section('title', 'Courses')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a
                            href="{{ route('instructor.courses.quizzes.index', $quiz->lecture->course->slug) }}">All
                            Quizzes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Questions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary px-2 ms-auto" data-bs-toggle="modal"
                    data-bs-target="#addQuestionModal">
                    Add Question
                </button>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Question</th>
                            <th>Is Multiple</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="quiz-questions">
                        @include('instructor.quiz-questions.includes.questions-body', ['quiz' => $quiz])
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Question Modal -->
    @include('instructor.quiz-questions.modals._add-question-modal')

    <!-- Modals Container -->
    <div id="quiz-modals">
        @include('instructor.quiz-questions.includes.modals', ['quiz' => $quiz])
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // ############## delete quiz ################

        $(document).on('submit', '.delete-question-form', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');

            Swal.fire({
                title: "Are you sure?",
                text: "This question will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted!",
                                text: response.message,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000
                            });

                            $('.quiz-questions').html(response.quizQuestions);

                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Failed to delete the question. Try again!",
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    });
                }
            });
        });

        // ############## end delete quiz ################

        // ############## Toggle multiple correct answers ############### 

        $(document).ready(function() {
            // Function to initialize checkbox behavior for a specific form
            function initializeCheckboxBehavior(formContainer) {
                const isMultipleCheckbox = formContainer.find('input[name="is_multiple"]');
                const correctCheckboxes = formContainer.find('input[name^="is_correct"]');

                // Set initial state
                updateCheckboxState(isMultipleCheckbox, correctCheckboxes);

                // Handle changes to the "is_multiple" checkbox
                isMultipleCheckbox.off('change').on('change', function() {
                    updateCheckboxState($(this), correctCheckboxes);
                });

                // Handle changes to option checkboxes
                correctCheckboxes.off('change').on('change', function() {
                    if (!isMultipleCheckbox.is(':checked')) {
                        // Single answer mode: enforce radio-like behavior
                        correctCheckboxes.not(this).prop('checked', false);
                    }
                });
            }

            // Helper function to update checkbox state based on multiple/single mode
            function updateCheckboxState(isMultipleCheckbox, correctCheckboxes) {
                if (isMultipleCheckbox.is(':checked')) {
                    // Multiple answers allowed, enable all checkboxes
                    correctCheckboxes.prop('disabled', false);
                } else {
                    // Single answer mode: keep current selection but ensure only one is checked
                    const checkedBoxes = correctCheckboxes.filter(':checked');

                    // If more than one is checked, keep only the first one
                    if (checkedBoxes.length > 1) {
                        // checkedBoxes.not(':first').prop('checked', false);
                        checkedBoxes.prop('checked', false);
                    }

                    // If none are checked, we could optionally check the first one
                    // if (checkedBoxes.length === 0) {
                    //     correctCheckboxes.first().prop('checked', true);
                    // }
                }
            }

            // Initialize the Add Question modal
            initializeCheckboxBehavior($('#addQuestionModal'));

            // Initialize Edit Question modals when they're shown
            $(document).on('shown.bs.modal', '[id$="_editQuestionModal"]', function() {
                initializeCheckboxBehavior($(this));
            });
        });

        // ############## end Toggle multiple correct answers ###############


        // ############## Add question ###############

        $('#addQuestionForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        form.trigger("reset"); // Reset form
                        $('.quiz-questions').html(response.quizQuestions);
                        $('#quiz-modals').html(response.quizModals);

                        // Hide the modal
                        $('#addQuestionModal').modal('hide');

                        // Show success toast
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: response.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(err => `- ${err[0]}`)
                        .join('<br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        html: errorMessages,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            });
        });
        // ############## end Add question ###############

        // ############## Edit question #################
        $(document).on('submit', '.edit-question-form', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');

            $.ajax({
                url: url,
                type: 'PUT',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $(`[id$='_editQuestionModal']`).modal('hide');
                    $('.quiz-questions').html(response.quizQuestions);
                    $('#quiz-modals').html(response.quizModals);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).map(err => `- ${err[0]}`)
                        .join('<br>');

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error!',
                        html: errorMessages,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                    });
                }
            });
        });
        // ############## end Edit question ###############

    });
</script>
@endsection
