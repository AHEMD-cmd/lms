@extends('layouts.frontend.master')

@section('title', 'My Courses')

@section('styles')
@endsection

@section('content')
    <!-- ================================
                                                                                        START BREADCRUMB AREA
                                                                                        ================================= -->
    @include('frontend.user-courses.includes.breadcrumb')
    <!-- ================================
                                                                                            END BREADCRUMB AREA
                                                                                        ================================= -->

    <!-- ================================
                                                                                            START MY COURSES
                                                                                        ================================= -->
    @include('frontend.user-courses.includes.my-courses')
    <!-- ================================
                                                                                            END MY COURSES
                                                                                        ================================= -->

    <!-- ================================
                                                                                            START DELETE COLLECTION
                                                                                        ================================= -->
    @include('frontend.user-courses.modals.delete-collection')
    <!-- ================================
                                                                                            END DELETE COLLECTION
                                                                                        ================================= -->

    <!-- ================================
                                                                                            START EDIT COLLECTION
                                                                                        ================================= -->
    @include('frontend.user-courses.modals.edit-collection')
    <!-- ================================
                                                                                            END EDIT COLLECTION
                                                                                        ================================= -->

    <!-- ================================
                                                                                            START LEAVE RATING
                                                                                        ================================= -->
    @include('frontend.user-courses.modals.leave-rating')
    <!-- ================================
                                                                                            END LEAVE RATING
                                                                                        ================================= -->
@endsection

@push('scripts')
    <script>
        // ######################## Create new collection ########################
        $(document).ready(function() {
            // Handle form submission for creating a new collection
            $(document).on('submit', '.createCollectionForm', function(e) {
                e.preventDefault(); // Prevent default form submission

                var form = $(this);
                var url = form.attr('action');
                var courseId = form.data('course-id');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        if (response.success) {
                            // Close the modal
                            $('#createNewCollectionModal' + courseId).modal('hide');

                            $('#collection-content').replaceWith(response.collections);

                            // Update all collection dropdowns for all courses
                            $('.collection-dropdown').each(function() {
                                var dropdownMenu = $(this).find('.dropdown-menu');
                                var currentCourseId = $(this).data('course-id');

                                // Create new dropdown item
                                var newDropdownItem = `
                                    <a href="javascript:void(0)" class="dropdown-item collection-link d-flex align-items-center justify-content-between" data-collection-id="${response.collection.id}">
                                        <span>${response.collection.name}</span>
                                        <span class="collection-icon ${currentCourseId == courseId ? 'la la-check' : ''}"></span>
                                    </a>
                                `;

                                // Append new dropdown item before the section-block
                                dropdownMenu.find('.section-block').before(
                                    newDropdownItem);
                            });

                            // Reset the form
                            form[0].reset();
                        }
                    },
                    error: function(xhr) {
                        // Handle errors (e.g., validation errors)
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            alert('Validation errors: ' + Object.values(errors).join(', '));
                        } else {
                            alert('An error occurred while creating the collection.');
                        }
                    }
                });
            });

            // Handle collection link clicks to toggle course inclusion in all courses tab and collection tab
            $(document).on('click', '.collection-link', function() {
                var collectionId = $(this).data('collection-id');
                var courseId = $(this).closest('.dropdown-menu').data('course-id');
                var $icon = $(this).find('.collection-icon');

                $.ajax({
                    url: '/collections-toggle/' + collectionId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        collection_id: collectionId,
                        course_id: courseId
                    },
                    success: function(response) {
                        if (response.attached) {
                            $icon.addClass('la la-check').show();
                            $('#collection-content').replaceWith(response.collections);
                            $('#all-courses').replaceWith(response.courses);
                        } else {
                            $icon.removeClass('la la-check').hide();
                            $('#collection-content').replaceWith(response.collections);
                            $('#all-courses').replaceWith(response.courses);
                        }
                    },
                    error: function() {
                        alert('Error toggling course in collection.');
                    }
                });
            });
        });

        // ######################## Favorite and unfavorite course ########################
        $(document).on('click', '.favorite-btn', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let courseId = $btn.data('course-id');

            $.ajax({
                url: '/courses/' + courseId + '/favorite',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Course favorited');
                    }
                },
                error: function() {
                    alert('Something went wrong');
                }
            });
        });

        // ######################## Archive and unarchive course ########################
        $(document).on('click', '.archive-btn', function(e) {
            e.preventDefault();

            let $btn = $(this);
            let courseId = $btn.data('course-id');

            $.ajax({
                url: '/courses/' + courseId + '/archive',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        $('#archived').replaceWith(response.archivedCourses);
                    }
                },
                error: function() {
                    alert('Something went wrong');
                }
            });
        });

        // ######################## Edit collection ########################
        $(document).ready(function() {
            // When edit button is clicked
            $(document).on('click', '.edit-collection-btn', function() {
                let collectionId = $(this).data('id');
                let name = $(this).data('name');
                let description = $(this).data('description');

                // Set modal fields
                $('#editCollectionId').val(collectionId);
                $('#editCollectionName').val(name);
                $('#editCollectionDescription').val(description);
            });

            // On form submission
            $('#editCollectionForm').on('submit', function(e) {
                e.preventDefault();

                let id = $('#editCollectionId').val();
                let name = $('#editCollectionName').val();
                let description = $('#editCollectionDescription').val();

                $.ajax({
                    url: `/collections/${id}`,
                    method: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        name: name,
                        description: description
                    },
                    success: function(response) {
                        $('#editCollectionModal').modal('hide');
                        $('#collection-content').replaceWith(response.collections);
                        // Update collection name in dropdowns
                        $('[data-collection-id="' + id + '"] span:first-child').text(name);
                    },
                    error: function(xhr) {
                        alert('Failed to update collection');
                    }
                });
            });
        });

        // ######################## Delete collection ########################
        // When clicking the trash icon, store the collection ID in the hidden input
        $(document).on('click', '.delete-collection-btn', function() {
            const collectionId = $(this).data('id');
            $('#deleteCollectionId').val(collectionId);
        });

        // ######################### When confirming the delete #########################
        $(document).on('click', '#confirmDeleteBtn', function() {
            const collectionId = $('#deleteCollectionId').val();

            $.ajax({
                url: '/collections/' + collectionId, // Adjust the route if needed
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Required for Laravel
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    $('#collection-content').replaceWith(response.collections);

                    // Remove all entries for this collection from dropdowns
                    $('[data-collection-id="' + collectionId + '"]').remove();

                },
                error: function(xhr) {
                    toastr.error('Something went wrong');
                }
            });
        });

        // ################## Restore the active tab from localStorage ##################
        $(document).ready(function() {
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                // Remove active class from default tab
                $('#myTab .nav-link').removeClass('active');
                $('#myTabContent .tab-pane').removeClass('show active');

                // Activate the stored tab
                $('#myTab a[href="' + activeTab + '"]').addClass('active');
                $(activeTab).addClass('show active');
            }

            // Save the active tab to localStorage when a tab is clicked
            $('#myTab a').on('click', function() {
                var tabId = $(this).attr('href');
                localStorage.setItem('activeTab', tabId);
            });
        });

        // ##################### User Courses Filter - AJAX Implementation #####################
        $(document).ready(function() {
            // Function to load filtered courses
            function loadFilteredCourses() {
                $.ajax({
                    url: '/user/courses/filter',
                    type: 'GET',
                    data: {
                        sort: $('.my-course-sort-by-content select').val(),
                        category: $('.my-course-filter-by-content-inner select').eq(0).val(),
                        instructor: $('.my-course-filter-by-content-inner select').eq(1).val(),
                        search: $('.my-course-search-content input').val()
                    },
                    beforeSend: function() {
                        // Show loading indicator
                        $('#all-courses').html(
                            '<div class="text-center py-5"><i class="la la-spinner la-spin la-3x"></i></div>'
                            );
                    },
                    success: function(response) {
                        // Update the courses list with the filtered results
                        $('#all-courses').html(response);
                    },
                    error: function(xhr) {
                        console.error('Error loading courses:', xhr.responseText);
                        $('#all-courses').html(
                            '<div class="alert alert-danger">Error loading courses. Please try again.</div>'
                            );
                    }
                });
            }

            // Handle sort by change
            $('.my-course-sort-by-content select').on('change', function() {
                loadFilteredCourses();
            });

            // Handle category filter change
            $('.my-course-filter-by-content-inner select').eq(0).on('change', function() {
                loadFilteredCourses();
            });

            // Handle instructor filter change
            $('.my-course-filter-by-content-inner select').eq(1).on('change', function() {
                loadFilteredCourses();
            });

            // Handle search input with debounce
            let searchTimer;
            $('.my-course-search-content input').on('keyup', function() {
                clearTimeout(searchTimer);

                searchTimer = setTimeout(function() {
                    loadFilteredCourses();
                }, 500); // Delay search to avoid too many requests
            });

            // Handle search form submission
            $('.my-course-search-content form').on('submit', function(e) {
                e.preventDefault();
                loadFilteredCourses();
            });

            // Handle reset button
            $('.reset-btn-box button').on('click', function() {
                // Reset all select elements to first option
                $('.my-course-sort-by-content select').val('0');
                $('.my-course-filter-by-content-inner select').eq(0).val('0');
                $('.my-course-filter-by-content-inner select').eq(1).val('0');
                $('.my-course-filter-by-content-inner select').eq(2).val('0');
                $('.my-course-search-content input').val('');

                // Load courses with reset filters
                loadFilteredCourses();
            });
        });
    </script>
@endpush
