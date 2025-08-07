<?php
ob_start();

// Incluir configuração centralizada da pasta admin
require_once __DIR__ . '/includes/config.php';

// Configurar sessão segura
setupSecureSession();

// A conexão $connection já está disponível através do config.php

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar rate limiting (proteção contra força bruta)
    if (!checkRateLimit('login_attempt', 5, 300)) {
        $email_err = 'Muitas tentativas de login. Tente novamente em 5 minutos.';
        logSecurity('Login rate limit exceeded', 'WARNING');
    } else {
        // Check if email is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = 'Por favor, insira um endereço de e-mail.';
        } else {
            $email = sanitizeInput(trim($_POST["email"]));
            // Validar formato do email
            if (!validateEmail($email)) {
                $email_err = 'Formato de e-mail inválido.';
            }
        }

        // Check if password is empty
        if (empty(trim($_POST['password']))) {
            $password_err = 'Por favor, digite sua senha.';
        } else {
            $password = trim($_POST['password']);
            // Validação básica de senha
            if (strlen($password) < 6) {
                $password_err = 'A senha deve ter pelo menos 6 caracteres.';
            }
        }
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement (pegar id e nome também para sessão)
        $sql = "SELECT id, name, email, password FROM admin WHERE email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if email exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $admin_id, $admin_name, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session and save the email to the session
                            session_regenerate_id(true); // Regenerar ID da sessão por segurança
                            $_SESSION['email'] = $email;
                            $_SESSION['admin_id'] = $admin_id;
                            $_SESSION['admin_name'] = $admin_name;
                            $_SESSION['last_activity'] = time();
                            
                            // Log de login bem-sucedido
                            logSecurity("Successful login for user: $email", 'INFO');
                            
                            header("Location: index.php");
                            exit(); // Ensure no further code is executed after redirection
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'A senha que você digitou não é válida. Por favor, tente novamente.';
                            
                            // Log de tentativa de login falhada
                            logSecurity("Failed login attempt for email: $email", 'WARNING');
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
                    $email_err = 'Nenhuma conta encontrada com esse e-mail. Verifique novamente e tente novamente.';
                }
            } else {
                echo "Oops! Algo deu errado. Tente novamente mais tarde.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/agua.png">
    <title>Área Administrativa</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h3 class="box-title m-b-20">Entrar</h3>
                                            <p style="color:red;"><?php echo sanitizeOutput($email_err); ?></p>
                        <p style="color:red;"><?php echo sanitizeOutput($password_err); ?></p>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Senha">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>