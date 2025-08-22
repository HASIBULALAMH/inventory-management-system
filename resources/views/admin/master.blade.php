<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inventory Management Admin</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap Icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- Custom CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="light-mode">

	<!-- Sidebar -->
	@include('admin.partial.sidebar')

	<!-- Main Content -->
	<div class="main-content" id="main-content">

		<!-- Top Navbar -->
		
            @include('admin.partial.navbar')
		<div class="container-fluid mt-4">
			<!-- Dashboard Cards -->
			@yield('content')
				
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>
</body>

</html>