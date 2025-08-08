<?php
session_start();
require 'admin/functions/db.php';

function convertPngToJpg($pngFilePath)
{
  if (!file_exists($pngFilePath)) {
    throw new Exception("O arquivo PNG não foi encontrado: " . $pngFilePath);
  }

  $image = imagecreatefrompng($pngFilePath);
  if (!$image) {
    throw new Exception("Erro ao carregar a imagem PNG.");
  }

  $width = imagesx($image);
  $height = imagesy($image);

  $jpgImage = imagecreatetruecolor($width, $height);
  $white = imagecolorallocate($jpgImage, 255, 255, 255);
  imagefill($jpgImage, 0, 0, $white);
  imagecopy($jpgImage, $image, 0, 0, 0, 0, $width, $height);

  // Diretório na Hostinger
  $tempDir = $_SERVER['DOCUMENT_ROOT'] . '/temp_images/';
  if (!file_exists($tempDir)) {
    mkdir($tempDir, 0777, true);
  }

  if (!is_writable($tempDir)) {
    throw new Exception("A pasta de destino não tem permissão de escrita: " . $tempDir);
  }

  // Criar arquivo temporário
  $tempJpgFile = $tempDir . uniqid('converted_', true) . '.jpg';

  if (!imagejpeg($jpgImage, $tempJpgFile, 90)) {
    throw new Exception("Erro ao salvar a imagem JPG.");
  }

  imagedestroy($image);
  imagedestroy($jpgImage);

  return $tempJpgFile;
}




// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $lattes = $_POST['lattes'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      $foto_temp = $_FILES['foto']['tmp_name'];
      $foto_type = $_FILES['foto']['type'];

      // Debug: Tipo de imagem
      error_log("Tipo da imagem enviada: " . $foto_type);

      // Se for PNG, converte para JPG
      if ($foto_type == 'image/png') {
        $foto_temp = convertPngToJpg($foto_temp);
      }

      // Lê o conteúdo da imagem convertida
      $foto_data = file_get_contents($foto_temp);
      if (!$foto_data) {
        throw new Exception("Erro ao ler o conteúdo da imagem.");
      }

      // Prepara a query para inserir no banco de dados
      $sql = "INSERT INTO membros (nome, cargo, lattes, foto) VALUES (?, ?, ?, ?)";
      $stmt = $connection->prepare($sql);
      if (!$stmt) {
        throw new Exception("Erro ao preparar a query: " . $connection->error);
      }

      // Usa 'b' para indicar que o quarto parâmetro é um BLOB
      $null = NULL;
      $stmt->bind_param("sssb", $nome, $cargo, $lattes, $null);
      $stmt->send_long_data(3, $foto_data);

      if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Aguarde a aprovação.";
      } else {
        throw new Exception("Erro ao cadastrar membro: " . $stmt->error);
      }

      // Remove o arquivo temporário, se foi criado
      if ($foto_type == 'image/png' && file_exists($foto_temp)) {
        unlink($foto_temp);
      }
    } else {
      throw new Exception("Erro ao fazer upload da foto.");
    }
  } catch (Exception $e) {
    $_SESSION['mensagem'] = $e->getMessage();
    error_log("Erro no upload: " . $e->getMessage());
  }

  header("Location: create-member.php");
  exit();
}


?>


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
      <h2 class="w3l_head w3l_head1">Participe da equipe</h2>

      <?php if (isset($_SESSION['mensagem'])): ?>
        <p><?= $_SESSION['mensagem']; ?></p>
        <?php unset($_SESSION['mensagem']); ?>
      <?php endif;
      if (isset($_GET["sent"])) {
        echo
        '<div class="alert alert-success" >
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <strong>SENT!! </strong><p> Cadastro criado com sucesso. Estamos análisando seu cadastro.</p>
                    </div>';
      } ?>
      <div class="agileits_mail_grids">
        <div class="agileits_mail_grid_left">
          <form action="create-member.php" method="post" enctype="multipart/form-data">
            <h4>Seu Nome*</h4>
            <input type="text" maxlength="24" name="nome" placeholder="Ex: Antonio José (Até 24 caracteres)" required="">
            <h4>Seu Cargo*</h4>
            <input type="text" name="cargo" placeholder="Ex: bolsista..." required="">
            <h4>Sua Curriculo Lattes(Link)*</h4>
            <input type="text" name="lattes" placeholder="Ex: https://lattes.cnpq.br/..." required="">
            <label for="foto">Escolha sua melhor Foto</label>
            <input type="file" name="foto" accept="image/*" required><br>
            <input type="submit" name="submit" value="Enviar">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- //mail -->


  <!-- footer -->

  <?php
  include("footer.php");
  ?>