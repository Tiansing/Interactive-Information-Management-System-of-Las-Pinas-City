<?php include "../includes/db.php"; ?>
<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Virtual Tour | The City of Las Piñas</title>
	<link rel="shortcut icon" type="image icon" href="https://res.cloudinary.com/sarabgi/image/upload/v1688669789/Assets/lplogo_bje93b.png">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

	<link rel="stylesheet" href="../Assets/programservicesassets/css/main.css" />
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<noscript>
		<link rel="stylesheet" href="../Assets/programservicesassets/css/noscript.css" />
	</noscript>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="../login/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../login/dist/css/adminlte.min.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&family=Poppins:wght@400;600&display=swap');

		body {
			background: #00180A;
			color: #EFF4ED;
			font-family: 'Poppins', sans-serif
		}

		body p {
			font-size: x-large;
		}

		iframe {
			width: 85% !important;
			height: 33em !important;


		}

		.vt_title,
		.vtpage {
			font-family: 'Poppins', sans-serif;
			background-color: #164A41;
			color: #F1B24A;


		}

		.prev,
		.next {

			margin-top: 50px;
			margin-bottom: 400px;
			z-index: 1000;
		}

		/* =======PARTICLES BACKGROUND========= */

		body .vertical-centered-box {
			position: absolute;
			text-align: center;
			z-index: -1;
		}

		body .vertical-centered-box:after {
			content: "";
			display: inline-block;
			vertical-align: middle;

		}

		body .vertical-centered-box .content {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			vertical-align: middle;
			text-align: left;
			font-size: 0;
			display: -webkit-inline-box;
			display: -ms-inline-flexbox;
			display: inline-flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
		}

		#particles-background,
		#particles-foreground {
			left: -51%;
			top: -51%;
			width: 200%;
			height: 195%;
			-webkit-transform: scale3d(0.5, 0.5, 1);
			-moz-transform: scale3d(0.5, 0.5, 1);
			-ms-transform: scale3d(0.5, 0.5, 1);
			-o-transform: scale3d(0.5, 0.5, 1);
			transform: scale3d(0.5, 0.5, 1);
			z-index: -1;
		}

		#particles-background {
			background: url(https://res.cloudinary.com/sarabgi/image/upload/v1669228481/index/banner_voxu3d.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			opacity: 0.1;
		}
	</style>
</head>

<body class="is-preload">
	<?php
	if (isset($_GET['vt'])) {
		$vt_id = $_GET['vt'];
	}
	$query = "SELECT * FROM virtualtour WHERE vt_id = $vt_id";
	$all_vt_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($all_vt_query)) {
		$vt_id = $row['vt_id'];
		$vt_title = $row['vt_title'];
		$vt_desc = $row['vt_desc'];
		$vt_date = $row['vt_date'];
		$vt_image = $row['vt_image'];
		$vt_tags = $row['vt_tags'];
		$vt_status = $row['vt_status'];
	}


	// $query1 = "SELECT * FROM virtualspots WHERE vs_vt_id = $vt_id";

	// $all_vs_query = mysqli_query($connection, $query1);

	// while ($row = mysqli_fetch_array($all_vs_query)) {

	// 	$vs_id = $row['vs_id'];
	// 	$vs_spot = html_entity_decode($row['vs_spot']);

	// }
	$num_per_page = 01;

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$start_from = ($page - 1) * 1;

	$query = "SELECT * FROM virtualspots WHERE vs_vt_id=$vt_id LIMIT $start_from,$num_per_page";
	$allFeat_query = mysqli_query($connection, $query);

	?>


	<!-- ---------------- -->
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header -->
		<header id="header" style="padding: 0 !important;">
			<div class="inner">

				<!-- Logo -->
				<a href="index.html" class="logo">

				</a>

				<!-- Nav -->
				<nav>
					<ul>
						<li><a href="#menu">Menu</a></li>
					</ul>
				</nav>

			</div>
		</header>

		<!-- Menu -->
		<nav id="menu">
			<h2>Menu</h2>
			<ul>
				<li><a href="virtualtour.php">Virtual Tour Home</a></li>
				<li><a href="../index.php">Home</a></li>
				<li><a href="../lifestyles/lifestyle.php">Lifestyle</a></li>



			</ul>
		</nav>

		<!-- Main -->
		<div id="main">

			<div class="loader-container">


				<div id="particles-background" class="vertical-centered-box"></div>
				<div id="particles-foreground" class="vertical-centered-box"></div>
				<div class="vertical-centered-box">


					<div class="content">
					</div>

				</div>

			</div>

			<div class="inner" style=" width: 100%;  max-width: 100%; margin: 0 auto;padding: 0;">

				<div style="text-align:center;margin:0px;padding:0px;overflow:hidden">
					<div class="vt_title">
						<h1><?php echo $vt_title; ?></h1>
					</div>

					<!-- ./wrapper -->

					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">

						<div class="carousel-inner">
							<?php

							while ($row = mysqli_fetch_array($allFeat_query)) {

								$vs_id = $row['vs_id'];
								$vs_spot = html_entity_decode($row['vs_spot']);
							}

							?>
							<div class="carousel-item active">

								<?php if (empty($vs_spot)) {
									echo "<h1>No Virtual Tour available :(</h1>";
								} else {
									echo $vs_spot;
								} ?>
								<div class="carousel-caption d-none d-md-block">
								</div>
							</div>




						</div>
					</div>
					<div class="row vtpage pt-3">
						<div class="col-12">
							<nav aria-label="Page navigation" id="myDIV">
								<ul class="pagination justify-content-center">
									<?php
									$pr_query = "SELECT * FROM virtualspots WHERE vs_vt_id = $vt_id ";
									$pr_feature = mysqli_query($connection, $pr_query);
									$total_records = mysqli_num_rows($pr_feature);

									$total_page = ceil($total_records / $num_per_page);


									if ($page > 1) {
									?>
										<li class="page-item">
											<?php echo " <a class='page-link text-dark' href='singleVirtual.php?vt=$vt_id&page=" . ($page - 1) . "' aria-label='Previous'><span class='fa fa-angle-double-left'aria-hidden='true'></span><spanclass='sr-only'><strong>Previous</strong></spanclass=></a>"; ?>
										</li>

									<?php }
									for ($i = 1; $i < $total_page; $i++) {
									?>
										<li class=""><?php echo "<a class='page-link btn text-dark' href='singleVirtual.php?vt=$vt_id&page=" . $i . "' ><strong>$i</strong></a>" ?></li>

									<?php }
									if ($i > $page) {
									?>

										<li class='page-item'>
											<?php
											echo "<a class='page-link text-dark' href='singleVirtual.php?vt=$vt_id&page=" . ($page + 1) . "' aria-label='Next'>
                                        <span class='fa fa-angle-double-right' aria-hidden='true'></span>
                                        <span class='sr-only'><strong>Next</strong></span>
                                    </a>";
											?>
										</li>
									<?php
									}
									?>

								</ul>
							</nav>
						</div>
					</div>
					<!-- <div style=" width: 100%; border: 2px solid #ccc;">
						
					</div> -->
					<br>

				</div>


			</div>
			<div class="container">
				<p style="text-align:justify;"><?php echo $vt_desc; ?></p>
			</div>

		</div>

		<!-- Footer -->


	</div>
	<script src="particles.js"></script>
	<script>
		$('.carousel').carousel({
			interval: false,
		});
	</script>
	<!-- Scripts -->
	<script src="../Assets/singleVirtual/jquery.min.js"></script>
	<script src="../Assets/singleVirtual/breakpoints.min.js"></script>
	<script src="../Assets/singleVirtual/browser.min.js"></script>
	<script src="../Assets/singleVirtual/main.js"></script>
	<script src="../Assets/singleVirtual/util.js"></script>

	<!-- jQuery -->
	<script src="../login/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../login/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../login/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../login/dist/js/demo.js"></script>


</body>

</html>