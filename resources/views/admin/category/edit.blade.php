@extends('layouts.dashboard.admin.master')

@section('title', 'Edit Category')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Category: {{ $category->name }}</h5>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="row g-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Laravel method spoofing for PUT -->

                <!-- Category Name -->
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        id="input1" placeholder="Enter category name" maxlength="100" required
                        value="{{ old('name', $category->name) }}" aria-describedby="nameHelp">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Parent Category with Select2 -->
                <div class="form-group col-md-6 mt-4">
                    <label for="parent_id">Parent Category (Optional)</label>
                    <select name="parent_id" id="parent_id"
                        class="form-control select2 @error('parent_id') is-invalid @enderror" aria-describedby="parentHelp">
                        <option value="">-- Select parent category --</option>
                        @foreach ($categories as $categoryOption)
                            <option value="{{ $categoryOption->id }}"
                                {{ old('parent_id', $category->parent_id) == $categoryOption->id ? 'selected' : '' }}>
                                {{ str_repeat('—', $categoryOption->depth) }}{{ $categoryOption->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category Image -->
                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Category Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" name="image" type="file"
                        id="image" accept="image/*" aria-describedby="imageHelp">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div class="col-md-6">
                    <img id="showImage" alt="Category preview"
                        src="{{ $category->image ? asset($category->image) : asset('assets/dashboard/images/preview.png') }}"
                        class="rounded-circle p-1 bg-primary" width="80" height="80">
                </div>

                <!-- Buttons -->
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4" aria-label="Update category">
                            Update Category
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
            // Initialize Select2 for parent_id
            $('#parent_id').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Select Parent Category --',
                allowClear: true,
                width: '100%'
            });

            // Image preview
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
