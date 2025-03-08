@extends('layouts.dashboard.student.master')

@section('title', 'Student Profile')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>


            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row pt-40px">
                @method('PATCH')
                @csrf

                <div class="media media-card align-items-center">
                    <div class="media-img media-img-lg mr-4 bg-gray">
                        <img class="mr-3" src="{{ asset(Auth::user()->photo) }}" alt="avatar image">
                    </div>

                    <div class="media-body">
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" name="photo" class="multi file-upload-input with-preview">
                            <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                        </div><!-- file-upload-wrap -->
                        <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are
                            .jpeg,.png,.jpg,.gif</p>
                    </div>
                </div><!-- end media -->

                <div class="input-box col-lg-6">
                    <label class="label-text"> Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name"
                            value="{{ Auth::user()->name }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-box col-lg-6">
                    <label class="label-text">Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email"
                            value="{{ Auth::user()->email }}">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-box col-lg-6">
                    <label class="label-text">Phone</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="phone"
                            value="{{ Auth::user()->phone }}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="input-box col-lg-6">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address"
                            value="{{ Auth::user()->address }}">
                        <span class="la la-home input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror



                <div class="input-box col-lg-12 py-2">
                    <button class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->

@endsection
