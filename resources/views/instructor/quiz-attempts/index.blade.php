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
                {{-- <button type="button" class="btn btn-primary px-2 ms-auto" data-bs-toggle="modal"
                    data-bs-target="#addQuestionModal">
                    Add Question
                </button> --}}
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
                            <th>User</th>
                            <th>Score</th>
                            <th>Started At</th>
                            <th>Ended At</th>
                        </tr>
                    </thead>
                    <tbody class="quiz-questions">
                        @foreach ($quiz->attempts as $index => $attempt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $attempt->user->name }}</td>
                                <td>{{ $attempt->score }}</td>
                                <td>{{ $attempt->started_at }}</td>
                                <td>{{ $attempt->ended_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
