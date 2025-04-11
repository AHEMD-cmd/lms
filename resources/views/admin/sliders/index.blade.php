@extends('layouts.dashboard.admin.master')

@section('title', 'Sliders')

@section('content')

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Sliders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary px-5">Add Slider </a>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sliders as $index => $slider)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td> <img src="{{ asset($slider->image) }}" alt=""
                                        style="width: 70px; height:40px;"> </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ Str::limit($slider->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-info px-5">Edit
                                    </a>

                                    <a href="#" class="btn btn-danger px-5" onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{ $slider->id }}').submit();">
                                        Delete
                                    </a>
                                    <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display: none;">
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
