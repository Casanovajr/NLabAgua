

<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="icon" href="images/icon.png">
	<title>Company</title>
	<!-- custom-theme -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Coalition Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //custom-theme -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- //js -->
	<!-- font-awesome-icons -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome-icons -->
	<link href="//fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

	<!-- CSS da Barra de Acessibilidade -->
	<link href="css/acessibilidade.css" rel="stylesheet" type="text/css" media="all" />
	<!-- JavaScript da Barra de Acessibilidade -->
	<script src="js/acessibilidade.js"></script>
</head>

<body>

	<!-- Barra de Acessibilidade -->
	<div class="accessibility-bar">
		<button class="accessibility-toggle" onclick="toggleAccessibilityBar()">
			<i class="fa fa-universal-access"></i>
		</button>
		<div class="accessibility-tools">
			<button onclick="increaseFontSize()" title="Aumentar fonte">
				<i class="fa fa-font"></i> A+
			</button>

			<button onclick="toggleContrast()" title="Alto contraste">
				<i class="fa fa-adjust"></i>
			</button>

			<button onclick="speakPageContent()" title="Ler página">
				<i class="fa fa-volume-up"></i>
			</button>
			<button onclick="stopSpeaking()" title="Parar leitura">
				<i class="fa fa-stop"></i>
			</button>
		</div>
	</div>

	<!-- /Barra de Acessibilidade -->

	<!-- banner -->
	<div class="banner1">
		<div class="container">
			<div class="w3_agile_banner_top">
				<div class="agile_phone_mail">
					<ul>
						<li><i class="fa fa-phone" aria-hidden="true"></i>+(55) 91 9 9918-3243 </li>
						<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:contato@labagua.com"> contato@labagua.com</a></li>
					</ul>
				</div>
			</div>
			<div class="agileits_w3layouts_banner_nav">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><img src="images/LabAguaLogo.png" style="width: 200px; height: 150px; " class="img-responsive"></a></h1>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="cl-effect-13" id="cl-effect-13">
							<ul class="nav navbar-nav">
								<li><a href="index.php">Início</a></li>
								<li><a href="https://aguasdamazonia.com/plataforma/iqa.html">IQA</a></li>
								<li class="active"><a href="portfolio.php">Produções</a></li>
								<li><a href="blog.php">Projetos</a></li>
								<li><a href="contact.php">Solicitar uma análise</a></li>
							</ul>

						</nav>

					</div>
				</nav>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- gallery -->
	<div class="gallery">
		<div class="container">
			<h2 class="w3l_head w3l_head1">Produções</h2>
			<div class="wthree_gallery_grids">


			</div>
			<script src="js/jzBox.js"></script>
		</div>
	</div>
	<!-- //gallery -->
	<!-- footer -->

	<?php
	include("footer.php");
	?>