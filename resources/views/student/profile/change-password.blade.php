@extends('layouts.dashboard.student.master')

@section('title', 'Change Password')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">

        <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
            <div class="setting-body">
                <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password </h3>


                <form method="post" action="{{ route('profile.change-password.update') }}" class="row pt-40px">
                    @csrf
                    @method('patch')


                    <div class="input-box col-lg-12">
                        <label class="label-text"> Current Password</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('current_password') is-invalid @enderror"
                                type="password" name="current_password" id="current_password">
                            <span class="la la-lock input-icon"></span>

                            @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div><!-- end input-box -->


                    <div class="input-box col-lg-12">
                        <label class="label-text"> New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('password') is-invalid @enderror"
                                type="password" name="password" id="password">
                            <span class="la la-lock input-icon"></span>

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div><!-- end input-box -->

                    <div class="input-box col-lg-12">
                        <label class="label-text"> Confirm New Password</label>
                        <div class="form-group">
                            <input class="form-control form--control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation">
                            <span class="la la-lock input-icon"></span>

                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div><!-- end input-box -->



                    <div class="input-box col-lg-12 py-2">
                        <button class="btn theme-btn">Save Changes</button>
                    </div><!-- end input-box -->
                </form>
            </div><!-- end setting-body -->
        </div><!-- end tab-pane -->

    </div>
@endsection
