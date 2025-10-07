<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Quản trị - {{ $setting['company_title'] ?? '' }}</title>
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
	<link rel="icon" href="{{ asset($setting['company_favicon']) }}" type="image/x-icon" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Fonts and icons -->
	<script src="{{ asset('backend/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: { families: ["Public Sans:300,400,500,600,700"] },
			custom: {
				families: [
					"Font Awesome 5 Solid",
					"Font Awesome 5 Regular",
					"Font Awesome 5 Brands",
					"simple-line-icons",
				],
				urls: ["{{ asset('backend/assets/css/fonts.min.css') }}"],
			},
			active: function () {
				sessionStorage.fonts = true;
			},
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('backend/assets/css/plugins.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('backend/assets/css/kaiadmin.min.css') }}" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar -->
        @include('admin.partials.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			@include('admin.partials.header')

			@yield('admin_content')

			@include('admin.partials.footer')
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="{{ asset('backend/assets/js/core/jquery-3.7.1.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
	{{-- <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script> --}}
	<script src="{{ asset('backend/assets/js/core/bootstrap.bundle.min.js') }}"></script>
	<!-- jQuery Scrollbar -->
	<script src="{{ asset('backend/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Chart JS -->
	<script src="{{ asset('backend/assets/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('backend/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('backend/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('backend/assets/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('backend/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	{{-- <script src="{{ asset('backend/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
	<script src="{{ asset('backend/assets/js/plugin/jsvectormap/world.js') }}"></script> --}}

	<!-- Sweet Alert -->
	<script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Kaiadmin JS -->
	<script src="{{ asset('backend/assets/js/kaiadmin.min.js') }}"></script>
	<script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>

	@yield('custom-scripts')
</body>

</html>