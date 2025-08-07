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
    <title>Dashboard Corrigido - LabÁgua</title>
    
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
                    <a class="logo" href="index-fixed.php">
                        <b><img src="../assets/images/favicon.ico" style="width: 30px; height: 30px;" alt="home" /></b>
                        <span class="hidden-xs"><b>LabÁgua</b></span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li><a href="functions/logout.php"><i class="fa fa-power-off"></i> Sair</a></li>
                </ul>
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
                            <li class="active">Início</li>
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
                
                <!-- Menu de Navegação -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>Menu de Navegação</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="posts.php" class="btn btn-primary btn-block">
                                        <i class="fa fa-file-text"></i> Gerenciar Posts
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="contacts.php" class="btn btn-info btn-block">
                                        <i class="fa fa-envelope"></i> Mensagens
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="member.php" class="btn btn-success btn-block">
                                        <i class="fa fa-users"></i> Membros
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="users.php" class="btn btn-warning btn-block">
                                        <i class="fa fa-user"></i> Usuários
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2025 &copy; LabÁgua</footer>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
</body>
</html>
