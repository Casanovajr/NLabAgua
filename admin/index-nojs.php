<?php
ob_start();

// Incluir funções de segurança
require_once "security.php";
require_once "functions/db.php";

// Verificar autenticação com sessão segura
requireAuth('login.php');

$email = sanitizeOutput($_SESSION['email']);

$sql_posts = "SELECT * FROM posts";
$query_posts = mysqli_query($connection, $sql_posts);

$sql_contacts = "SELECT * FROM contacts";
$query_contacts = mysqli_query($connection, $sql_contacts);

$sql_subscribers = "SELECT * FROM subscribers";
$query_subscribers = mysqli_query($connection, $sql_subscribers);

$sql_comments = "SELECT * FROM comments";
$query_comments = mysqli_query($connection, $sql_comments);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Sem JS - LabÁgua</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <a class="logo" href="index-nojs.php">
                        <b><img src="../assets/images/favicon.ico" style="width: 30px; height: 30px;" alt="home" /></b>
                        <span class="hidden-xs"><b>LabÁgua - SEM JS</b></span>
                    </a>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $email;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Sem JavaScript</li>
                        </ol>
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                            <i data-icon="E" class="linea-icon linea-basic"></i>
                                            <h5 class="text-muted vb">Artigos Publicados</h5> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-danger">
                                                <?php echo mysqli_num_rows($query_posts);?>
                                            </h3> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br b-r-none">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                            <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                                            <h5 class="text-muted vb">Artigos Comentados</h5> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-megna">
                                                <?php echo mysqli_num_rows($query_comments);?>
                                            </h3> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                            <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                                            <h5 class="text-muted vb">Mensagens</h5> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-primary">
                                                <?php echo mysqli_num_rows($query_contacts);?>
                                            </h3> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 b-0">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                            <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                                            <h5 class="text-muted vb">Inscritos</h5> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-success">
                                                <?php echo mysqli_num_rows($query_subscribers);?>
                                            </h3> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>✅ Dashboard Sem JavaScript Funcionando!</h3>
                            <p>Se esta versão carrega, o problema está no JavaScript do dashboard original.</p>
                            <ul>
                                <li><a href="index.php">🔗 Tentar Dashboard Original</a></li>
                                <li><a href="index-simple.php">📊 Dashboard Simplificado</a></li>
                                <li><a href="dashboard-test.php">📊 Dashboard Teste</a></li>
                                <li><a href="../index.php">🏠 Voltar ao Site</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2025 &copy; LabÁgua - Versão Sem JavaScript</footer>
        </div>
    </div>
    
    <!-- SEM JAVASCRIPT - APENAS HTML E CSS -->
</body>
</html>
