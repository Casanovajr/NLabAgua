<!--
author: Ethredah
author URL: http://ethredah.github.io
-->

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="images/agua.png">
<title>LabÁgua</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Coalition Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
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
							<li><a href="portfolio.php">Produções</a></li>
							<li><a href="blog.php">Projetos</a></li>
							<li class="active"><a href="contact.php">Solicitar uma análise</a></li>
						</ul>

					</nav>

					</div>
				</nav>
			</div>
		</div>
	</div>
<!-- //banner -->
<!-- mail -->
	<div class="mail">
		<div class="container">
			<h2 class="w3l_head w3l_head1">Contate-nos</h2>

			<?php
				if (isset($_GET["sent"])) {
					echo
					'<div class="alert alert-success" >
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>SENT!! </strong><p> Thank you for your message. We will get back to you as soon as possible.</p>
                    </div>'
					;
				}
			?>
				<div class="agileits_mail_grids">
				<div class="agileits_mail_grid_left">
					<form action="functions/contact.php" method="post">
						<h4>Seu Nome*</h4>
						<input type="text" name="names" placeholder="Nome..." required="">
						<h4>Seu Email*</h4>
						<input type="email" name="email" placeholder="Email..." required="">
						<h4>Sua Mensagem*</h4>
						<textarea placeholder="Mensagem..." name="messagem"></textarea>
						<input type="submit" name="submit" value="Enviar">
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- //mail -->
<!-- map -->
	<div class="w3l-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.5154548684955!2d-48.447852825033955!3d-1.4642750985219526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x92a48c2a11fc7081%3A0xfc8f380776e8b79b!2sScience%20and%20Technology%20Park%20Guama!5e0!3m2!1sen!2sbr!4v1738861954928!5m2!1sen!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
<!-- map -->

<!-- footer -->
	
	<?php 
		include("footer.php");
	?>

