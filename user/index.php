<?php
include '../koneksi.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Peminjaman Barang dan Ruangan</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['../assets/css/fonts.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/azzara.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="purple">
			<!-- Logo Header -->
			<style>
				.logo-header {
					display: flex;
					align-items: center;
					padding: 0 25px;
					height: 60px;
				}

				.logo {
					text-decoration: none;
					padding: 0;
				}

				.logo-text {
					display: flex;
					flex-direction: column;
					align-items: center;
					text-align: center;
					margin-right: 15px;
					line-height: 1.3;
				}

				.logo-text .top-text {
					font-size: 16px;
					font-weight: 800;
					color: #1a2035;
					letter-spacing: 0.5px;
					margin-bottom: 2px;
				}

				.logo-text .bottom-text {
					font-size: 14px;
					font-weight: 600;
					color: #1a2035;
					letter-spacing: 0.3px;
				}

				.navbar-toggler,
				.topbar-toggler,
				.btn-minimize {
					padding: 10px;
					margin-left: 10px;
					border: none;
					background: transparent;
					cursor: pointer;
				}

				.navbar-toggler:hover,
				.topbar-toggler:hover,
				.btn-minimize:hover {
					background: rgba(0, 0, 0, 0.05);
					border-radius: 4px;
				}

				.navbar-minimize {
					margin-left: auto;
				}

				.logo-image {
					height: 40px;
					margin-right: 15px;
				}

				.logo-header {
					display: flex;
					align-items: center;
					justify-content: center;
					width: 100%;
				}

				.sidebar {
					background-color: #1a2035;
					/* Warna biru gelap yang formal */
					color: #ffffff;
					/* Warna teks putih agar kontras */
					width: 250px;
					height: 100vh;
				}

				.sidebar-wrapper {
					overflow-y: auto;
				}

				.sidebar-content {
					padding: 15px;
				}

				.nav {
					list-style-type: none;
					padding: 0;
				}

				.nav-item a {
					display: flex;
					align-items: center;
					color: #ffffff;
					text-decoration: none;
					padding: 12px 15px;
					border-radius: 5px;
					transition: background 0.3s ease;
				}

				.nav-item a:hover {
					background-color: #2d3a5d;
					/* Warna hover yang lebih terang */
				}

				.nav-item i {
					margin-right: 10px;
					font-size: 18px;
				}

				.nav-section {
					border-bottom: 1px solid #ffffff2e;
					margin: 10px 0;
				}

				.nav-item:last-child {
					margin-top: auto;
				}
			</style>

			<div class="logo-header">
				<a href="#" class="logo">
					<img src="../Kota Lhokseumawe.png" alt="Logo Kota Lhokseumawe" class="logo-image">
				</a>

				<button class="navbar-toggler sidenav-toggler" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more">
					<i class="fa fa-ellipsis-v"></i>
				</button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar">
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav">
						<li class="nav-item">
							<a href="?view=dashboard">
								<i class="fas fa-home"></i>
								<p>Halaman Utama</p>
							</a>
						</li>
		
						<li class="nav-item">
							<a href="?view=datapinjambarang">
								<i class="fas fa-briefcase"></i>
								<p>Pinjam Barang</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="?view=datapinjamruangan">
								<i class="fas fa-briefcase"></i>
								<p>Pinjam Ruangan</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="../logout.php">
								<i class="fas fa-lock"></i>
								<p>Keluar</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<?php
		// Dashboard
		if (@$_GET['view'] == '')
			include 'dashboard.php';
		elseif ($_GET['view'] == 'dashboard')
			include 'dashboard.php';

		// Data Pinjam Barang
		elseif ($_GET['view'] == 'datapinjambarang')
			include 'peminjaman/barang/datapinjambarang.php';
		elseif ($_GET['view'] == 'createpinjambarang')
			include 'peminjaman/barang/createpinjambarang.php';
		elseif ($_GET['view'] == 'detailpinjambarang')
			include 'peminjaman/barang/detailpinjambarang.php';

		// Data Pinjam Ruangan
		elseif ($_GET['view'] == 'datapinjamruangan')
			include 'peminjaman/ruangan/datapinjamruangan.php';

		elseif ($_GET['view'] == 'createpinjamruangan')
			include 'peminjaman/ruangan/createpinjamruangan.php';

		elseif ($_GET['view'] == 'detailpinjamruangan')
			include 'peminjaman/ruangan/detailpinjamruangan.php';

		?>

		<!-- Custom template | don't include it in your project! -->
		<!-- End Custom template -->

	</div>

	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Azzara JS -->
	<script src="../assets/js/ready.min.js"></script>
	<!-- Azzara DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<script>
		$(document).ready(function() {
			$('#add-row').DataTable({});
		});
	</script>

</body>

</html>