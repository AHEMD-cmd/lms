@extends('layouts.dashboard.admin.master')

@section('title', 'Add Feature')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        .select2-selection__rendered {
            display: flex;
            align-items: center;
        }

        .select2-selection__rendered svg {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .select2-results__option svg {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Feature</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Feature</h5>

            <form action="{{ route('admin.features.store') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        id="input1" placeholder="Enter slider name" maxlength="100" required value="{{ old('title') }}"
                        aria-describedby="titleHelp">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Icon Picker -->
                <div class="form-group col-md-6 mt-4">
                    <label for="icon">Choose Icon</label>
                    <select id="icon" name="icon" class="form-control icon-picker">
                        <option value="book"
                            data-svg-path="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z">
                            Book</option>

                        <option value="graduation-cap"
                            data-svg-path="M302.5 512c-5.31 0-10.52-2.148-14.31-5.932l-89.31-89.31c-3.78-3.781-5.931-8.945-5.931-14.31s2.148-10.55 5.931-14.33l89.31-89.31c3.781-3.781 8.945-5.93 14.31-5.93s10.52 2.148 14.3 5.93l89.31 89.31c3.781 3.781 5.936 8.949 5.936 14.33s-2.152 10.52-5.931 14.31l-89.31 89.31C313 509.9 307.8 512 302.5 512zM396.6 72c0-39.8-32.2-72-72-72S252.6 32.2 252.6 72s32.2 72 72 72s72-32.2 72-72zM416 144c-17.7 0-32 14.3-32 32v64H288v-32c0-17.7-14.3-32-32-32s-32 14.3-32 32v128c0 17.7 14.3 32 32 32s32-14.3 32-32v-32h96v64c0 17.7 14.3 32 32 32s32-14.3 32-32V176c0-17.7-14.3-32-32-32z">
                            Graduation Cap</option>

                        <option value="chalkboard-teacher"
                            data-svg-path="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47.1 19.4 92 53.4 124.7L112 384v96c0 17.7 14.3 32 32 32h288c17.7 0 32-14.3 32-32V384l-5.4-32.5c34-32.7 53.4-77.6 53.4-124.7V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32H224zm0 512c-35.3 0-64-28.7-64-64V384h128v64c0 35.3-28.7 64-64 64z">
                            Chalkboard Teacher</option>

                        <option value="laptop"
                            data-svg-path="M64 96C28.7 96 0 124.7 0 160V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H64zM512 160V352H64V160H512zM176 304c0-8.8 7.2-16 16-16H384c8.8 0 16 7.2 16 16s-7.2 16-16 16H192c-8.8 0-16-7.2-16-16z">
                            Laptop</option>

                        <option value="lightbulb"
                            data-svg-path="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 400c-17.68 0-31.97-14.25-31.97-32c0-17.63 14.29-32 31.97-32c17.8 0 32.09 14.38 32.09 32C288.1 385.8 273.8 400 256 400zM301.2 264.1c-12.12 9.992-19.21 24.13-19.21 39.99L281.1 304c0 13.25-10.75 24-23.1 24c-13.25 0-24-10.75-24-24l.0385-0.125c0-30.12 13.34-58.48 35.21-75.5C286.1 246.5 304 228.2 304 208c0-32.73-26.09-51.38-48-51.38c-32.88 0-55.98 28.75-55.98 32l-.0221 .0371c-1.208 9.25-9.333 16.44-18.78 16.44c-11.88 0-19.2-10.19-19.2-19.44c0-5.463 10.36-53.03 93.99-53.03c39.5 0 95.99 38.25 95.99 83.38C351.1 224.8 336.4 255.1 301.2 264.1z">
                            Lightbulb</option>

                        <option value="certificate"
                            data-svg-path="M248 0c-13.3 0-24 10.7-24 24V83.9c26.9 5.4 51.2 13.1 73.7 20.8l13.3-26.6c6-12 20.5-16.8 32.5-10.8s16.8 20.5 10.8 32.5l-7.9 15.8C395.1 147.5 437 193 446.6 241.2c1.7 8.2 2.7 16.5 3.2 25H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H449.8c-3.3 38.7-17.9 74.5-40.7 102.7L430 453.3c7.7 10.8 5.3 25.9-5.5 33.6s-25.9 5.3-33.6-5.5l-16.4-22.9C337.9 478.2 297.1 491.8 254 495V552c0 13.3-10.7 24-24 24s-24-10.7-24-24V495.8c-41.9-4.3-81.8-19.1-115.8-42.5L73.5 476.4c-10.8 7.7-25.9 5.3-33.6-5.5s-5.3-25.9 5.5-33.6l20.7-14.9c-24.6-27.9-40.3-63.5-44.5-102.4H0c-13.3 0-24-10.7-24-24s10.7-24 24-24h22c1.4-34.9 13.4-67.3 32.7-93.4c10.1-13.7 21.7-25.9 34.4-36.5l-12.8-25.5c-6-12-1.2-26.5 10.8-32.5s26.5-1.2 32.5 10.8l13 26c29-15.3 60.9-23.8 93.3-24.8V24c0-13.3 10.7-24 24-24z">
                            Certificate</option>

                        <option value="pencil"
                            data-svg-path="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                            Pencil</option>

                        <option value="brain"
                            data-svg-path="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64v80c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-8.8-7.2-16-16-16s-16 7.2-16 16v48c0 8.8-7.2 16-16 16H112c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h48c8.8 0 16-7.2 16-16s-7.2-16-16-16H112zM237.3 7c-9.4-9.4-24.6-9.4-33.9 0l-32 32c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l32-32c9.4-9.4 9.4-24.6 0-33.9zM400 64c26.5 0 48 21.5 48 48v48c0 8.8 7.2 16 16 16s16-7.2 16-16V112c0-44.2-35.8-80-80-80c-8.8 0-16 7.2-16 16s7.2 16 16 16zM64 352v48c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V288c0-8.8-7.2-16-16-16s-16 7.2-16 16v112c0 8.8-7.2 16-16 16H112c-8.8 0-16-7.2-16-16V352H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64zm368 56c0 8.8-7.2 16-16 16H368c-8.8 0-16-7.2-16-16V288c0-8.8 7.2-16 16-16s16 7.2 16 16v112h48c8.8 0 16 7.2 16 16z">
                            Brain</option>

                        <option value="chalkboard"
                            data-svg-path="M80 80V192c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V80c0-17.7-14.3-32-32-32H112c-17.7 0-32 14.3-32 32zm336 112c0-8.8-7.2-16-16-16H240c-8.8 0-16 7.2-16 16s7.2 16 16 16H400c8.8 0 16-7.2 16-16zM240 192h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H240c-8.8 0-16 7.2-16 16s7.2 16 16 16zM400 320c0-8.8-7.2-16-16-16H240c-8.8 0-16 7.2-16 16s7.2 16 16 16H384c8.8 0 16-7.2 16-16zM240 352h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H240c-8.8 0-16 7.2-16 16s7.2 16 16 16zM32 448H544c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H32C14.3 32 0 46.3 0 64V416c0 17.7 14.3 32 32 32zm512-64H32V64H544V384z">
                            Chalkboard</option>

                        <option value="video"
                            data-svg-path="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM213.3 196.7L320 256l-106.7 59.3V196.7z">
                            Video</option>

                        <option value="clock"
                            data-svg-path="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z">
                            Clock</option>

                        <option value="users"
                            data-svg-path="M144 160c-44.2 0-80-35.8-80-80S99.8 0 144 0s80 35.8 80 80s-35.8 80-80 80zm368 0c-44.2 0-80-35.8-80-80s35.8-80 80-80s80 35.8 80 80s-35.8 80-80 80zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224c0 53-43 96-96 96s-96-43-96-96s43-96 96-96s96 43 96 96zm368 0c0 53-43 96-96 96s-96-43-96-96s43-96 96-96s96 43 96 96z">
                            Users</option>

                        <option value="puzzle-piece"
                            data-svg-path="M0 96C0 60.7 28.7 32 64 32h64c12.4 0 23.7 4.1 32.8 11.1c9.1 6.9 15.2 16.3 17.3 26.9L184 96c4.1 21.2 22.8 38.4 45.3 38.3c21.3 0 39.7-16.1 43.9-35.9c.1-.4 .2-.8 .2-1.2c4-20.5 20.1-36.7 42.4-40.3c.4-.1 .9-.1 1.3-.2c11.9-1.5 20.9-11.6 20.9-23.7c0-15.2 10.9-28.7 26.6-31.4C411.5 2.3 442.1 25.4 442 64v41.3c0 11.2 7.4 20.9 18 24.2c13.3 4.2 23.5 15.5 26.1 29.2s-1.6 28.5-12.2 37.8C463.2 205.6 455 219.7 455 235s8.2 29.4 18.9 38.4c10.6 9.3 14.8 23.4 12.2 37.8c-2.6 13.7-12.8 25-26.1 29.2c-10.6 3.3-18 13-18 24.2v29c0 45-36.7 81.6-81.7 81.3c-18.3-.1-35.5-6.1-49-16.8c-13.6-10.7-21.3-25.3-21.3-40.9c0-10.7-6.6-20.8-16.8-24.2c-18.9-6.4-31.4-24.2-31.2-44c.1-21.7 15.5-39.8 36.3-44.7c10.9-2.5 18.7-12.3 18.7-23.5s-7.8-21-18.7-23.5c-20.8-4.8-36.3-23-36.3-44.7c-.2-19.8 12.2-37.6 31.2-44c10.2-3.4 16.8-13.5 16.8-24.2c0-35-34.6-60.2-69.2-48.5C224.9 86.5 207.5 64 183.3 64H176c-12.4 0-23.7 4.1-32.8 11.1c-9.1 6.9-15.2 16.3-17.3 26.9c-5 25.5-27.9 43.4-54 44C30.3 146.3 0 117.1 0 82V96zM64 96c13.3 0 24-10.7 24-24s-10.7-24-24-24s-24 10.7-24 24s10.7 24 24 24z">
                            Puzzle Piece</option>

                        <option value="comments"
                            data-svg-path="M256 32C114.6 32 .0 125.1 .0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4c32.7 12.3 69 19.4 107.4 19.4c141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32s-14.3 32-32 32z">
                            Comments</option>

                        <option value="file-pdf"
                            data-svg-path="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 224H96c8.8 0 16 7.2 16 16s-7.2 16-16 16H64c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64c-8.8 0-16-7.2-16-16s7.2-16 16-16zm192 48H64c-8.8 0-16 7.2-16 16s7.2 16 16 16H256c8.8 0 16-7.2 16-16s-7.2-16-16-16z">
                            File PDF</option>

                        <option value="trophy"
                            data-svg-path="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z">
                            Trophy</option>
                    </select>

                    @error('icon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-group col-md-12">
                    <label for="description" class="form-label">Slider Description <span
                            class="text-danger">*</span></label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="Enter slider description" maxlength="100" required aria-describedby="descriptionHelp" rows="3">{{ old('description') }}</textarea>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 with SVG icon preview
            $('#icon').select2({
                placeholder: "Select an icon",
                theme: 'bootstrap-5',
                allowClear: true,
                templateResult: formatIcon,
                templateSelection: formatIcon,
                width: '100%'
            });

            // Format the dropdown items with SVGs
            function formatIcon(icon) {
                if (!icon.id) {
                    return icon.text;
                }

                var svgPath = $(icon.element).data('svg-path');
                var viewBox = $(icon.element).data('svg-viewbox') || '0 0 512 512'; // Default viewBox
                var $icon = $(
                    '<span>' +
                    '<svg class="me-2" width="16" height="16" viewBox="' + viewBox + '" fill="currentColor">' +
                    '<path d="' + svgPath + '"></path>' +
                    '</svg>' +
                    icon.text +
                    '</span>'
                );
                return $icon;
            }

            // When an icon is selected, put the SVG path in a hidden input
            $('#icon').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var svgPath = selectedOption.data('svg-path');

                // Store the SVG path in the value attribute of the select
                if (svgPath) {
                    // You can choose to update the select value directly
                    // $(this).val(svgPath);

                    // Or create/update a hidden input to store the path
                    if ($('#svg-path-input').length === 0) {
                        $(this).after('<input type="hidden" id="svg-path-input" name="svg_icon" value="' +
                            svgPath + '">');
                    } else {
                        $('#svg-path-input').val(svgPath);
                    }

                    console.log("SVG Path stored:", svgPath);
                }
            });

            // Trigger change on initial load if an option is pre-selected
            if ($('#icon').val()) {
                $('#icon').trigger('change');
            }
        });
    </script>
@endsection
