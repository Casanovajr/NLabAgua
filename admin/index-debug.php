<?php
// Versão com debug do admin/index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();

echo "<!-- DEBUG: Iniciando admin/index.php -->\n";

// Incluir funções de segurança
echo "<!-- DEBUG: Carregando security.php -->\n";
require_once "security.php";
echo "<!-- DEBUG: security.php carregado -->\n";

echo "<!-- DEBUG: Carregando functions/db.php -->\n";
require_once "functions/db.php";
echo "<!-- DEBUG: functions/db.php carregado -->\n";

// Verificar autenticação com sessão segura
echo "<!-- DEBUG: Verificando autenticação -->\n";
requireAuth('login.php');
echo "<!-- DEBUG: Autenticação verificada -->\n";

$email = sanitizeOutput($_SESSION['email']);
echo "<!-- DEBUG: Email: $email -->\n";

echo "<!-- DEBUG: Executando queries -->\n";

// Queries com tratamento de erro
try {
    $sql_posts = "SELECT * FROM posts";
    $query_posts = mysqli_query($connection, $sql_posts);
    if (!$query_posts) {
        echo "<!-- DEBUG: Erro na query posts: " . mysqli_error($connection) . " -->\n";
    } else {
        echo "<!-- DEBUG: Query posts executada com sucesso -->\n";
    }
} catch (Exception $e) {
    echo "<!-- DEBUG: Exceção na query posts: " . $e->getMessage() . " -->\n";
}

try {
    $sql_contacts = "SELECT * FROM contacts";
    $query_contacts = mysqli_query($connection, $sql_contacts);
    if (!$query_contacts) {
        echo "<!-- DEBUG: Erro na query contacts: " . mysqli_error($connection) . " -->\n";
    } else {
        echo "<!-- DEBUG: Query contacts executada com sucesso -->\n";
    }
} catch (Exception $e) {
    echo "<!-- DEBUG: Exceção na query contacts: " . $e->getMessage() . " -->\n";
}

try {
    $sql_subscribers = "SELECT * FROM subscribers";
    $query_subscribers = mysqli_query($connection, $sql_subscribers);
    if (!$query_subscribers) {
        echo "<!-- DEBUG: Erro na query subscribers: " . mysqli_error($connection) . " -->\n";
    } else {
        echo "<!-- DEBUG: Query subscribers executada com sucesso -->\n";
    }
} catch (Exception $e) {
    echo "<!-- DEBUG: Exceção na query subscribers: " . $e->getMessage() . " -->\n";
}

try {
    $sql_comments = "SELECT * FROM comments";
    $query_comments = mysqli_query($connection, $sql_comments);
    if (!$query_comments) {
        echo "<!-- DEBUG: Erro na query comments: " . mysqli_error($connection) . " -->\n";
    } else {
        echo "<!-- DEBUG: Query comments executada com sucesso -->\n";
    }
} catch (Exception $e) {
    echo "<!-- DEBUG: Exceção na query comments: " . $e->getMessage() . " -->\n";
}

echo "<!-- DEBUG: Queries executadas, iniciando HTML -->\n";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Debug - LabÁgua</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
</head>

<body>
    <!-- DEBUG: Body iniciado -->
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <a class="logo" href="index-debug.php">
                        <b><img src="../assets/images/favicon.ico" style="width: 30px; height: 30px;" alt="home" /></b>
                        <span class="hidden-xs"><b>LabÁgua - DEBUG</b></span>
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
                            <li class="active">Debug</li>
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
                            <h3>✅ Dashboard Debug Funcionando!</h3>
                            <p>Se esta versão carrega, o problema está no JavaScript ou em alguma parte específica do dashboard original.</p>
                            <ul>
                                <li><a href="index.php">🔗 Tentar Dashboard Original</a></li>
                                <li><a href="index-simple.php">📊 Dashboard Simplificado</a></li>
                                <li><a href="index-nojs.php">📊 Dashboard Sem JS</a></li>
                                <li><a href="../index.php">🏠 Voltar ao Site</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2025 &copy; LabÁgua - Versão Debug</footer>
        </div>
    </div>
    
    <!-- DEBUG: Iniciando JavaScript -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- DEBUG: JavaScript básico carregado -->
    <script>
    console.log('DEBUG: JavaScript básico carregado');
    $(document).ready(function() {
        console.log('DEBUG: Document ready');
    });
    </script>
</body>
</html>
