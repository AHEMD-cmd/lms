<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{asset('assets/dashboard')}}/images/favicon-32x32.png" type="image/png"/>
	<!--plugins-->
	<link href="{{asset('assets/dashboard')}}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{asset('assets/dashboard')}}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{asset('assets/dashboard')}}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{asset('assets/dashboard')}}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet"/>
	<!-- loader-->
	<link href="{{asset('assets/dashboard')}}/css/pace.min.css" rel="stylesheet"/>
	<script src="{{asset('assets/dashboard')}}/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/dashboard')}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('assets/dashboard')}}/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/dashboard')}}/css/app.css" rel="stylesheet">
	<link href="{{asset('assets/dashboard')}}/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('assets/dashboard')}}/css/dark-theme.css"/>
	<link rel="stylesheet" href="{{asset('assets/dashboard')}}/css/semi-dark.css"/>
	<link rel="stylesheet" href="{{asset('assets/dashboard')}}/css/header-colors.css"/>
	<!-- end inject -->

	{{-- Sweet Alert --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	<!-- Datatable -->
	<link href="{{asset('assets/dashboard')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- End Datatable -->

	<!-- Select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

	@yield('css')
	<title>@yield('title')</title>