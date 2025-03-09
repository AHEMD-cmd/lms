@extends('layouts.dashboard.instructor.master')

@section('title', 'Courses')

@section('content')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Courses</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('instructor.courses.create') }}" class="btn btn-primary px-5">Add Course </a>
            </div>
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
                            <th>Image </th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td> <img src="{{ asset($course->image) }}" alt=""
                                        style="width: 70px; height:40px;"> </td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->discount }}</td>
                                <td>
                                    <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-info"
                                        title="Edit"><i class="lni lni-eraser"></i> </a>
                                    <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST"
                                        class="d-inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" id="delete" title="delete"><i
                                                class="lni lni-trash"></i> </button>
                                    </form>
                                    <a href="{{ route('instructor.courses.sections.index',$course->id) }}" class="btn btn-warning" title="Lecture"><i class="lni lni-list"></i> </a>                    
                                </td>
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
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection
