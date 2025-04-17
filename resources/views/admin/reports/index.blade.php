@extends('layouts.dashboard.admin.master')

@section('title', 'Reports')

@section('content')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">All Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Reports</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- <div class="btn-group">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-5">Add Category </a>
            </div> --}}
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>User </th>
                            <th>Course </th>    
                            <th>Report Type </th>
                            <th>Created At </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($course->reports as $index => $report)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->course->title }}</td>
                                <td>{{ $report->report_type }}</td>
                                <td>{{ $report->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.reports.show', [$course->slug, $report->id]) }}" class="btn btn-info px-5">
                                        <i class="bx bx-show"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger px-5" onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{ $report->id }}').submit();">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                    <form id="delete-form-{{ $report->id }}" action="{{ route('admin.courses.reports.destroy', [$course->slug, $report->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')   
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
