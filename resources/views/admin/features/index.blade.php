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
                    <li class="breadcrumb-item active" aria-current="page">All Features</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.features.create') }}" class="btn btn-primary px-5">Add Feature </a>
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
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($features as $index => $feature)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 512 512">
                                        <path d="{{ $feature->svg_icon }}" />
                                    </svg>
                                </td>
                                <td>{{ Str::limit($feature->title, 20) }}</td>
                                <td>{{ Str::limit($feature->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.features.edit', $feature->id) }}"
                                        class="btn btn-info px-5">
                                        <i class="bx bx-edit"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger px-5"
                                        onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{ $feature->id }}').submit();">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                    <form id="delete-form-{{ $feature->id }}"
                                        action="{{ route('admin.features.destroy', $feature->id) }}" method="POST"
                                        style="display: none;">
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
