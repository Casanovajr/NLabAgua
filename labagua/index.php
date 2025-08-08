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
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<style>
		/* ... existing code ... */

		/* Estilos para a seção da equipe */
		.team-section {
			padding: 50px 0;
			background: #f8f9fa;
		}

		.team-carousel {
			margin: 0 auto;
			max-width: 1200px;
		}

		.team-card {
			text-align: center;
			/* Centraliza o conteúdo horizontalmente */
			padding: 20px;
			background: #fff;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin: 0 15px;
			display: flex;
			flex-direction: column;
			align-items: center;
			/* Centraliza o conteúdo verticalmente */
		}

		.team-card img {
			width: 175px !important;
			height: 210px !important;
			object-fit: cover !important;
			border-radius: 3% !important;
			margin-bottom: 15px !important;
			aspect-ratio: 1/1 !important;
			display: block !important;
			/* Garante que a imagem se comporte como um bloco */
			margin-left: auto !important;
			margin-right: auto !important;
			/* Centraliza a imagem horizontalmente */
		}

		/* Adicionando um hover effect para melhorar a interatividade */
		.team-card:hover {
			transform: translateY(-5px);
			transition: transform 0.3s ease;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}

		.team-card h3 {
			font-size: 1.2em;
			/* Tamanho fixo para o nome */
			white-space: normal;
			/* Permite que o texto quebre em várias linhas */
			overflow: visible;
			/* Mostra todo o texto */
			text-overflow: clip;
			/* Remove o "..." */
			max-width: 100%;
			/* Usa toda a largura disponível */
			margin: 0 auto;
			/* Centraliza o nome */
			padding: 5px 0;
			/* Espaçamento vertical */
			word-wrap: break-word;
			/* Quebra palavras longas */

		}

		.lattes-link {
			color: #007bff !important;
			text-decoration: none;
		}

		.lattes-link:hover {
			text-decoration: underline;
		}
	</style>

	<!-- //custom-theme -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- FlexSlider -->
	<script defer src="js/jquery.flexslider.js"></script>
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
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
	<div class="banner">
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
								<li class="active"><a href="index.php">Início</a></li>
								<li><a href="https://aguasdamazonia.com/plataforma/iqa.html">IQA</a></li>
								<li><a href="portfolio.php">Produções</a></li>
								<li><a href="blog.php">Projetos</a></li>
								<li><a href="contact.php">Solicitar uma análise</a></li>
							</ul>

						</nav>

					</div>
				</nav>
			</div>
			<div class="wthree_banner_info">

				<section class="slider">
					<div class="flexslider">
						<ul class="slides" style="background-color: rgba(0, 0, 0, 0.6);
    box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);">
							<li>
								<h3>LabÁgua</h3>
								<p> O Laboratório de Qualidade da Água da Amazônia (LabÁgua), vinculado a Universidade do Estado do Pará (Uepa), atua em áreas como análises ambientais e monitoramento ambiental, e com serviços de análises de nutrientes e microbiológicas, licenciamento ambiental, monitoramento de corpos hídricos, entre outros. </p>

							</li>
							<li>
								<h3>Sobre o Laboratório</h3>
								<p> Foi criado em 2021, com a vocação de ser referência em análises ambientais de águas e efluentes na região amazônica. Fruto de um projeto apoiado pela Fundação Amazônia de Amparo a Estudos e Pesquisas (Fapespa) e pela Universidade do Estado do Pará (UEPA), surge o LabÁgua, localizado no Parque de Ciência e Tecnologia Guamá (PCT Guamá). Composto por uma equipe interdisciplinar de pesquisadores, tendo como objetivo desenvolver pesquisa, extensão e prestação de serviços com eficiência para a comunidade. </p>

							</li>
							<li>
								<h3>Missão </h3>
								<p> Fornecer serviços de qualidade aos seus clientes, proporcionando segurança, confiabilidade e satisfação nos resultados das análises da qualidade da água. </p>

							</li>
							<li>
								<h3>Visão</h3>
								<p> Tornar-se um laboratório de referência estadual, conceituado entre as instituições públicas e privadas, investindo em qualidade e inovação. </p>

							</li>
							<li>
								<h3>Valores</h3>
								<p> Compromisso com a pesquisa, extensão e qualidade. Respeito, trabalho em equipe e responsabilidade social e ambiental. </i>

							</li>
						</ul>
					</div>
				</section>
				<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
					$(window).on('load', function() {
						$('.flexslider').flexslider({
							animation: "slide",
							start: function(slider) {
								$('body').removeClass('loading');
							}
						});
					});
				</script>
				<!-- //flexSlider -->
			</div>
		</div>
	</div>
	<!-- //banner -->

	<!-- Equipe -->

	<?php
	session_start();
	require 'admin/functions/db.php';

	$sql = "SELECT * FROM membros WHERE status = 'aprovado'";
	$result = $connection->query($sql);
	?>



	<div class="team-section">
		<div class="container">
			<h2 class="w3layouts_head">Nossa Equipe</h2>
			<a href="/create-member.php"><i class="fa fa-pencil-square-o" aria-hidden="true"> Participar da equipe</i></a>
			<br>
			<br>
			<div class="team-carousel owl-carousel owl-theme">
				<?php while ($row = $result->fetch_assoc()): ?>
					<div class="team-card item">
						<img src="data:image/jpeg;base64,<?= base64_encode($row['foto']); ?>" alt="<?= $row['nome']; ?>">
						<h3><?= $row['nome']; ?></h3>
						<p class="text-xl font-bold text-blue-500"><?= $row['cargo']; ?></p>
						<a href="<?= $row['lattes']; ?>" style="color: #007bff" target="_blank" class="lattes-link">Currículo Lattes</a>
					</div>
				<?php endwhile; ?>


				<!-- Adicione mais membros conforme necessário -->
			</div>
		</div>

	</div>



	<!-- //Equipe -->



	<!-- content -->
	<div class="process all_pad agileits">

		<?php
		if (isset($_GET["subscribed"])) {
			echo
			'<div class="alert alert-success" >
                          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                         <strong>Inscrito!! </strong><p> Obrigado pela inscrição. Manteremos você informado sobre o que está acontecendo.</p>
                    </div>';
		} elseif (isset($_GET["fail"])) {
			echo
			'<div class="alert alert-danger" >
                          <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                         <strong>Ooops!! </strong><p> Parece que você já está inscrito em nossa lista de e-mail :) </p>
                    </div>';
		}
		?>

	</div>
	<!-- //process -->




	<!-- footer -->
	<script>
		$(document).ready(function() {
			$('.team-carousel').owlCarousel({
				loop: true,
				margin: 20,
				nav: true,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: true
					},
					600: {
						items: 2,
						nav: true
					},
					1000: {
						items: 3,
						nav: true,
						loop: true
					}
				}
			});
		});
	</script>

	<?php
	include("footer.php");
	?>