@extends('layouts.dashboard.admin.master')

@section('title', 'Add Slider')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Slider</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Slider</h5>

            <form action="{{ route('admin.sliders.store') }}" method="post" class="row g-3"
                enctype="multipart/form-data">
                @csrf

                <!-- Slider Name -->
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Slider Name <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="input1" placeholder="Enter slider name" maxlength="100" required
                        value="{{ old('title') }}" aria-describedby="titleHelp">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                 <!-- Slider Image -->
                 <div class="form-group col-md-6">
                    <label for="image" class="form-label">Slider Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file"
                        id="image" accept="image/*" aria-describedby="imageHelp">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                  <!-- Image Preview -->
                  <div class="col-md-6">
                    <img id="showImage" alt="Category preview" src="{{ asset('assets/dashboard/images/preview.png') }}"
                        class="rounded-circle p-1 bg-primary" width="80" height="80">
                </div>


                <!-- Slider Description -->
                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Slider Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        id="description" placeholder="Enter slider description" maxlength="100" required
                        aria-describedby="descriptionHelp" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4" aria-label="Save category changes">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4" aria-label="Cancel">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Image preview
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]); // Fixed: '0' to 0
            });
        });
    </script>
@endsection