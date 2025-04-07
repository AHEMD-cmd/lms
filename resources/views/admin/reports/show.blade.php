@extends('layouts.dashboard.admin.master')

@section('title', 'Show Report')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Courses</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.reports.index', $course->slug) }}">Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show Report</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Report Details</h5>

            <div class="row g-3">
                <!-- User -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">User:</label>
                    <p>{{ $report->user->name }}</p>
                </div>

                <!-- Course -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Course:</label>
                    <p>{{ $report->course->title }}</p>
                </div>

                <!-- Review -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Review:</label>
                    <p>{{ $report->review?->comment ?? 'No review' }}</p>
                </div>

                <!-- Report Type -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Report Type:</label>
                    <p>{{ $report->report_type }}</p>
                </div>

                <!-- Report Comment -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Report Comment:</label>
                    <p>{{ $report->message }}</p>
                </div>

                <!-- Created At -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Created At:</label>
                    <p>{{ $report->created_at->format('M d, Y') }}</p>
                </div>

                <!-- Back Button -->
                <div class="col-12 mt-4">
                    <a href="{{ route('admin.courses.reports.index', $course->slug) }}" class="btn btn-secondary px-4">Back to Reports</a>
                </div>
            </div>
        </div>
    </div>
@endsection
