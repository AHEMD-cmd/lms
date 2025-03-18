@extends('layouts.dashboard.admin.master')

@section('title', 'Instructors')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Smtp Setting </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Smtp Setting</h5>

                <form id="myForm" action="{{ route('admin.smtp-settings.update', 1) }}" method="post"
                    class="row g-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Mailer</label>
                        <input type="text" name="mailer" class="form-control" id="input1"
                            value="{{ old('mailer', $smtp->mailer ?? '') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Host</label>
                        <input type="text" name="host" class="form-control" id="input1"
                            value="{{ old('host', $smtp->host ?? '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Port</label>
                        <input type="text" name="port" class="form-control" id="input1"
                            value="{{ old('port', $smtp->port ?? '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Username</label>
                        <input type="text" name="username" class="form-control" id="input1"
                            value="{{ old('username', $smtp->username ?? '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Password</label>
                        <input type="text" name="password" class="form-control" id="input1"
                            value="{{ old('password', $smtp->password ?? '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> Encryption</label>
                        <input type="text" name="encryption" class="form-control" id="input1"
                            value="{{ old('encryption', $smtp->encryption ?? '') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label"> From Address</label>
                        <input type="text" name="from_address" class="form-control" id="input1"
                            value="{{ old('from_address', $smtp->from_address ?? '') }}">
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
