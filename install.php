<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabÁgua - Instalação</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #007cc0 0%, #189dfb 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .install-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 90%;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .logo i {
            font-size: 2.5rem;
            color: #007cc0;
        }
        
        .logo-text {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007cc0;
        }
        
        h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #666;
            font-size: 1.1rem;
        }
        
        .step {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #007cc0;
        }
        
        .step h3 {
            color: #007cc0;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .step-number {
            background: #007cc0;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .code-block {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            margin: 10px 0;
            overflow-x: auto;
        }
        
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }
        
        .alert-info {
            background: #e3f2fd;
            color: #1565c0;
            border-left: 4px solid #2196f3;
        }
        
        .alert-success {
            background: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }
        
        .alert-warning {
            background: #fff3e0;
            color: #ef6c00;
            border-left: 4px solid #ff9800;
        }
        
        .btn {
            background: #007cc0;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background: #005a8c;
        }
        
        .btn-success {
            background: #28a745;
        }
        
        .btn-success:hover {
            background: #218838;
        }
        
        .test-results {
            margin-top: 20px;
        }
        
        .test-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }
        
        .test-pass {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        .test-fail {
            background: #ffebee;
            color: #c62828;
        }
        
        .icon-check {
            color: #4caf50;
        }
        
        .icon-error {
            color: #f44336;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="install-container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-tint"></i>
                <i class="fas fa-flask"></i>
                <span class="logo-text">LabÁgua</span>
            </div>
            <h1>Instalação do Sistema</h1>
            <p class="subtitle">Configure seu sistema de análise de água</p>
        </div>

        <?php
        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            if ($_POST['action'] === 'test_connection') {
                testDatabaseConnection();
            } elseif ($_POST['action'] === 'install_database') {
                installDatabase();
            }
        }
        
        function testDatabaseConnection() {
            echo '<div class="alert alert-info">';
            echo '<h4><i class="fas fa-cog fa-spin"></i> Testando Conexão...</h4>';
            echo '</div>';
            
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'labagua';
            
            // Testar conexão MySQL
            $connection = @mysqli_connect($host, $username, $password);
            
            echo '<div class="test-results">';
            
            if ($connection) {
                echo '<div class="test-item test-pass">';
                echo '<i class="fas fa-check-circle icon-check"></i>';
                echo '<span>Conexão MySQL estabelecida com sucesso</span>';
                echo '</div>';
                
                // Verificar se o banco existe
                $db_exists = mysqli_select_db($connection, $database);
                
                if ($db_exists) {
                    echo '<div class="test-item test-pass">';
                    echo '<i class="fas fa-check-circle icon-check"></i>';
                    echo '<span>Banco de dados "labagua" encontrado</span>';
                    echo '</div>';
                    
                    // Verificar tabelas
                    $tables = ['admin', 'posts', 'membros', 'contacts', 'subscribers'];
                    $existing_tables = [];
                    
                    foreach ($tables as $table) {
                        $result = mysqli_query($connection, "SHOW TABLES LIKE '$table'");
                        if ($result && mysqli_num_rows($result) > 0) {
                            $existing_tables[] = $table;
                            echo '<div class="test-item test-pass">';
                            echo '<i class="fas fa-check-circle icon-check"></i>';
                            echo "<span>Tabela '$table' encontrada</span>";
                            echo '</div>';
                        } else {
                            echo '<div class="test-item test-fail">';
                            echo '<i class="fas fa-times-circle icon-error"></i>';
                            echo "<span>Tabela '$table' não encontrada</span>";
                            echo '</div>';
                        }
                    }
                    
                    if (count($existing_tables) === count($tables)) {
                        echo '<div class="alert alert-success">';
                        echo '<h4><i class="fas fa-check-circle"></i> Sistema Pronto!</h4>';
                        echo '<p>Todas as tabelas estão configuradas corretamente.</p>';
                        echo '<a href="index.php" class="btn btn-success">Acessar Site</a> ';
                        echo '<a href="labagua/admin/login.php" class="btn">Admin</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-warning">';
                        echo '<h4><i class="fas fa-exclamation-triangle"></i> Instalação Necessária</h4>';
                        echo '<p>Algumas tabelas estão faltando. Execute a instalação do banco de dados.</p>';
                        echo '</div>';
                    }
                    
                } else {
                    echo '<div class="test-item test-fail">';
                    echo '<i class="fas fa-times-circle icon-error"></i>';
                    echo '<span>Banco de dados "labagua" não encontrado</span>';
                    echo '</div>';
                    
                    echo '<div class="alert alert-warning">';
                    echo '<h4><i class="fas fa-exclamation-triangle"></i> Banco Não Encontrado</h4>';
                    echo '<p>O banco de dados precisa ser criado. Execute a instalação.</p>';
                    echo '</div>';
                }
                
                mysqli_close($connection);
                
            } else {
                echo '<div class="test-item test-fail">';
                echo '<i class="fas fa-times-circle icon-error"></i>';
                echo '<span>Erro na conexão MySQL: ' . mysqli_connect_error() . '</span>';
                echo '</div>';
                
                echo '<div class="alert alert-warning">';
                echo '<h4><i class="fas fa-exclamation-triangle"></i> Erro de Conexão</h4>';
                echo '<p>Verifique se o XAMPP está rodando e se as configurações estão corretas.</p>';
                echo '</div>';
            }
            
            echo '</div>';
        }
        
        function installDatabase() {
            echo '<div class="alert alert-info">';
            echo '<h4><i class="fas fa-cog fa-spin"></i> Instalando Banco de Dados...</h4>';
            echo '</div>';
            
            $host = 'localhost';
            $username = 'root';
            $password = '';
            
            $connection = @mysqli_connect($host, $username, $password);
            
            if (!$connection) {
                echo '<div class="alert alert-warning">';
                echo '<h4><i class="fas fa-times-circle"></i> Erro de Conexão</h4>';
                echo '<p>Não foi possível conectar ao MySQL: ' . mysqli_connect_error() . '</p>';
                echo '</div>';
                return;
            }
            
            // Ler e executar o arquivo SQL
            $sql_file = __DIR__ . '/database/labagua_fixed.sql';
            
            if (!file_exists($sql_file)) {
                echo '<div class="alert alert-warning">';
                echo '<h4><i class="fas fa-times-circle"></i> Arquivo SQL Não Encontrado</h4>';
                echo '<p>O arquivo database/labagua.sql não foi encontrado.</p>';
                echo '</div>';
                return;
            }
            
            $sql_content = file_get_contents($sql_file);
            
            // Separar as queries
            $queries = explode(';', $sql_content);
            $success_count = 0;
            $error_count = 0;
            
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query) && !preg_match('/^--/', $query)) {
                    $result = mysqli_query($connection, $query);
                    if ($result) {
                        $success_count++;
                    } else {
                        $error_count++;
                        if (strpos(mysqli_error($connection), 'already exists') === false) {
                            echo '<div class="test-item test-fail">';
                            echo '<i class="fas fa-times-circle icon-error"></i>';
                            echo '<span>Erro na query: ' . mysqli_error($connection) . '</span>';
                            echo '</div>';
                        }
                    }
                }
            }
            
            mysqli_close($connection);
            
            if ($success_count > 0) {
                echo '<div class="alert alert-success">';
                echo '<h4><i class="fas fa-check-circle"></i> Instalação Concluída!</h4>';
                echo "<p>$success_count queries executadas com sucesso.</p>";
                echo '<p><strong>Credenciais do Admin:</strong></p>';
                echo '<p>Email: <code>admin@labagua.com</code><br>';
                echo 'Senha: <code>admin123</code></p>';
                echo '<a href="index.php" class="btn btn-success">Acessar Site</a> ';
                echo '<a href="labagua/admin/login.php" class="btn">Fazer Login Admin</a>';
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning">';
                echo '<h4><i class="fas fa-exclamation-triangle"></i> Erro na Instalação</h4>';
                echo '<p>Ocorreram erros durante a instalação. Verifique os logs acima.</p>';
                echo '</div>';
            }
        }
        ?>

        <div class="step">
            <h3><span class="step-number">1</span> Pré-requisitos</h3>
            <p>Antes de começar, certifique-se de que você tem:</p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>XAMPP instalado e rodando</li>
                <li>Apache e MySQL ativos</li>
                <li>PHP 7.4 ou superior</li>
                <li>Extensão MySQLi habilitada</li>
            </ul>
        </div>

        <div class="step">
            <h3><span class="step-number">2</span> Testar Conexão</h3>
            <p>Primeiro, vamos testar se o sistema consegue conectar ao MySQL:</p>
            <form method="POST" style="margin-top: 15px;">
                <input type="hidden" name="action" value="test_connection">
                <button type="submit" class="btn">
                    <i class="fas fa-plug"></i> Testar Conexão
                </button>
            </form>
        </div>

        <div class="step">
            <h3><span class="step-number">3</span> Instalar Banco de Dados</h3>
            <p>Se a conexão estiver funcionando, instale o banco de dados:</p>
            <form method="POST" style="margin-top: 15px;">
                <input type="hidden" name="action" value="install_database">
                <button type="submit" class="btn">
                    <i class="fas fa-database"></i> Instalar Banco
                </button>
            </form>
        </div>

        <div class="step">
            <h3><span class="step-number">4</span> Instalação Manual (Alternativa)</h3>
            <p>Se preferir, você pode instalar manualmente via phpMyAdmin:</p>
            <div class="alert alert-info">
                <p><strong>Passos:</strong></p>
                <ol style="margin-left: 20px;">
                    <li>Abra o phpMyAdmin (http://localhost/phpmyadmin)</li>
                    <li>Clique em "Importar"</li>
                    <li>Selecione o arquivo <code>database/labagua.sql</code></li>
                    <li>Clique em "Executar"</li>
                </ol>
            </div>
        </div>

        <div class="step">
            <h3><span class="step-number">5</span> Configurações</h3>
            <p>Após a instalação, você pode configurar:</p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li><strong>Admin:</strong> Login com admin@labagua.com / admin123</li>
                <li><strong>SMTP:</strong> Configure email em config/database.php</li>
                <li><strong>Uploads:</strong> Verifique permissões da pasta uploads/</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <p style="color: #666; font-size: 14px;">
                <i class="fas fa-info-circle"></i>
                Após a instalação, você pode deletar este arquivo (install.php) por segurança.
            </p>
        </div>
    </div>
</body>
</html>
