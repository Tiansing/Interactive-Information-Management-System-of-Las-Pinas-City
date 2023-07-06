<?php include "includes/db.php"; ?>


<!DOCTYPE HTML>
<!--
	Lens by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<link rel="shortcut icon" type="image icon" href="https://res.cloudinary.com/sarabgi/image/upload/v1669190604/index/lplogo_rjgtai.png">
	<title>Gallery | The City of Las Piñas</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="./Assets/galleryassets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="./Assets/galleryassets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload-0 is-preload-1 is-preload-2">
	<audio id="galleryspeech">
		<source src="gaellry.mp3">
	</audio>


	<script>
		window.addEventListener('DOMContentLoaded', function() {
			var audio = document.getElementById("galleryspeech");
			var playLink = document.getElementById("playLinkG");

			playLink.addEventListener('click', function(event) {
				event.preventDefault();
				audio.play();
			});
		});
	</script>
	<!-- Main -->
	<div id="main">

		<!-- Header -->
		<header id="header">
			<a href="#" id="playLinkG">
				<h1>Gallery</h1>
			</a>
			<p>this is the gallery of Las Pinas</p>
			<ul class="icons">
				<li>
					<h2><a href="index.php" class="fa fa-home"><span class="label">Home</span></a></h2>
				</li>
			</ul>
		</header>

		<!-- Thumbnail -->
		<section id="thumbnails">
			<?php
			$query = "SELECT * FROM gallery";
			$all_gal_query = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_assoc($all_gal_query)) {

				$img_title = $row['img_title'];
				$img_image = $row['img_image'];
				$img_status = $row['img_status'];

				$img_desc = $row['img_desc'];
				$img_date = date("F j, Y, g:i a", strtotime($row["img_date"]));
			?>
				<article>
					<a class="thumbnail" href="<?php echo $img_image; ?>" data-position="left center"><img style="height: 150px;" src="<?php echo $img_image; ?>" alt="gallery img" /></a>
					<h2><?php echo $img_title; ?></h2>
					<p><?php echo $img_desc; ?></p>
					<span><?php echo $img_date; ?></span>
				</article>
			<?php
			} ?>

		</section>


	</div>

	<!-- Scripts -->
	<script src="./Assets/galleryassets/js/jquery.min.js"></script>
	<script src="./Assets/galleryassets/js/browser.min.js"></script>
	<script src="./Assets/galleryassets/js/breakpoints.min.js"></script>
	<script src="./Assets/galleryassets/js/main.js"></script>

</body>

</html>