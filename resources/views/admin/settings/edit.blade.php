@extends('layouts.dashboard.admin.master')

@section('title', 'Edit Settings')

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Settings</h5>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Phone -->
                <div class="form-group col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           id="phone" placeholder="Enter phone number" maxlength="20"
                           value="{{ old('phone', $settings->phone ?? '') }}" aria-describedby="phoneHelp">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" placeholder="Enter email address" maxlength="255"
                           value="{{ old('email', $settings->email ?? '') }}" aria-describedby="emailHelp">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logo -->
                <div class="form-group col-md-6">
                    <label for="logo" class="form-label">Logo</label>
                    <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file"
                           id="logo" accept="image/*" aria-describedby="logoHelp">
                    @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Logo Preview -->
                <div class="col-md-6">
                    <img id="logoPreview" alt="Logo preview"
                         src="{{ $settings->logo ? asset($settings->logo) : 'https://via.placeholder.com/80' }}"
                         class="rounded-circle p-1 bg-primary" width="80" height="80">
                </div>

                 <!-- Footer Logo -->
                 <div class="form-group col-md-6">
                    <label for="footer_logo" class="form-label">Footer Logo</label>
                    <input class="form-control @error('footer_logo') is-invalid @enderror" name="footer_logo" type="file"
                           id="footer_logo" accept="image/*" aria-describedby="footerLogoHelp">
                    @error('footer_logo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                  <!-- Footer Logo Preview -->
                  <div class="col-md-6">
                    <img id="footerLogoPreview" alt="Footer logo preview"
                         src="{{ $settings->footer_logo ? asset($settings->footer_logo) : 'https://via.placeholder.com/80' }}"
                         class="rounded-circle p-1 bg-primary" width="80" height="80">
                </div>

                <!-- About Us Big Image -->
                <div class="form-group col-md-6">
                    <label for="about_us_big_image" class="form-label">About Us Big Image</label>
                    <input class="form-control @error('about_us_big_image') is-invalid @enderror" name="about_us_big_image" type="file"
                           id="about_us_big_image" accept="image/*" aria-describedby="aboutUsBigImageHelp">
                    @error('about_us_big_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- About Us Big Image Preview -->
                <div class="col-md-6">
                    <img id="aboutUsBigImagePreview" alt="About us big image preview"
                         src="{{ $settings->about_us_big_image ? asset($settings->about_us_big_image) : 'https://via.placeholder.com/510x340' }}"
                         class="rounded p-1 bg-primary" width="100" height="100">
                </div>

                <!-- About Us Small Image -->
                <div class="form-group col-md-6">
                    <label for="about_us_small_image" class="form-label">About Us Small Image</label>
                    <input class="form-control @error('about_us_small_image') is-invalid @enderror" name="about_us_small_image" type="file"
                           id="about_us_small_image" accept="image/*" aria-describedby="aboutUsSmallImageHelp">
                    @error('about_us_small_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- About Us Small Image Preview -->
                <div class="col-md-6">
                    <img id="aboutUsSmallImagePreview" alt="About us small image preview"
                         src="{{ $settings->about_us_small_image ? asset($settings->about_us_small_image) : 'https://via.placeholder.com/100x100' }}"
                         class="rounded p-1 bg-primary" width="100" height="100">
                </div>

                <!-- Address -->
                <div class="form-group col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           id="address" placeholder="Enter address" maxlength="500"
                           value="{{ old('address', $settings->address ?? '') }}" aria-describedby="addressHelp">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

              

                <!-- Social Media -->
                <div class="form-group col-md-12">
                    <label class="form-label">Social Media Links</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" name="facebook"
                                   class="form-control @error('facebook') is-invalid @enderror"
                                   id="facebook" placeholder="Enter Facebook URL"
                                   value="{{ old('facebook', $settings->facebook ?? '') }}"
                                   aria-describedby="facebookHelp">
                            @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" name="twitter"
                                   class="form-control @error('twitter') is-invalid @enderror"
                                   id="twitter" placeholder="Enter Twitter URL"
                                   value="{{ old('twitter', $settings->twitter ?? '') }}"
                                   aria-describedby="twitterHelp">
                            @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" name="instagram"
                                   class="form-control @error('instagram') is-invalid @enderror"
                                   id="instagram" placeholder="Enter Instagram URL"
                                   value="{{ old('instagram', $settings->instagram ?? '') }}"
                                   aria-describedby="instagramHelp">
                            @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="url" name="linkedin"
                                   class="form-control @error('linkedin') is-invalid @enderror"
                                   id="linkedin" placeholder="Enter LinkedIn URL"
                                   value="{{ old('linkedin', $settings->linkedin ?? '') }}"
                                   aria-describedby="linkedinHelp">
                            @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- About Us Title -->
                <div class="form-group col-md-6">
                    <label for="about_us_title" class="form-label">About Us Title</label>
                    <input type="text" name="about_us_title" class="form-control @error('about_us_title') is-invalid @enderror"
                           id="about_us_title" placeholder="Enter About Us title" maxlength="255"
                           value="{{ old('about_us_title', $settings->about_us_title ?? '') }}"
                           aria-describedby="aboutUdTitleHelp">
                    @error('about_us_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- About Us Description -->
                <div class="form-group col-md-12">
                    <label for="about_us_description" class="form-label">About Us Description</label>
                    <textarea name="about_us_description" class="form-control @error('about_us_description') is-invalid @enderror"
                              id="about_us_description" placeholder="Enter About Us description"
                              aria-describedby="aboutUsDescriptionHelp" rows="5">{{ old('about_us_description', $settings->about_us_description ?? '') }}</textarea>
                    @error('about_us_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4" aria-label="Update settings">
                            Update Settings
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4" aria-label="Cancel">
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
            // Logo preview
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#logoPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            // Footer logo preview
            $('#footer_logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#footerLogoPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection 