<?php
/**
 * Configuração de Banco de Dados para Admin
 * LabÁgua - Sistema de Análise de Água
 */

// Carregar configurações do arquivo env.php da raiz
$envConfig = require_once __DIR__ . '/../../env.php';

// Definir constantes do banco de dados
define('DB_HOST', $envConfig['DB_HOST'] ?? 'localhost');
define('DB_USER', $envConfig['DB_USER'] ?? 'root');
define('DB_PASS', $envConfig['DB_PASS'] ?? '');
define('DB_NAME', $envConfig['DB_NAME'] ?? 'labagua');
define('DB_PORT', $envConfig['DB_PORT'] ?? 3306);
define('DB_DEBUG', $envConfig['APP_DEBUG'] ?? false);

// Função para obter conexão MySQLi
function getDatabaseConnection() {
    global $connection;
    
    if (!isset($connection) || !$connection) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        
        if (!$connection) {
            if (DB_DEBUG) {
                die("Erro na conexão com banco de dados: " . mysqli_connect_error());
            } else {
                die("Erro interno do servidor. Verifique as configurações do banco.");
            }
        }
        
        // Definir charset para UTF-8
        mysqli_set_charset($connection, 'utf8mb4');
    }
    
    return $connection;
}

// Função para obter conexão PDO
function getPDOConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4;port=" . DB_PORT;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]);
        } catch (PDOException $e) {
            if (DB_DEBUG) {
                die('Erro na conexão PDO: ' . $e->getMessage());
            } else {
                die('Erro interno do servidor.');
            }
        }
    }
    
    return $pdo;
}

// Inicializar conexões globais
$connection = getDatabaseConnection();
$db = getPDOConnection();

// Função para verificar se o banco está conectado
function isDatabaseConnected() {
    global $connection;
    return $connection && mysqli_ping($connection);
}

// Função para testar a conexão
function testDatabaseConnection() {
    try {
        $conn = getDatabaseConnection();
        if ($conn && mysqli_ping($conn)) {
            return [
                'status' => 'success',
                'message' => 'Conexão com banco de dados estabelecida com sucesso!',
                'server_info' => mysqli_get_server_info($conn),
                'database' => DB_NAME
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Falha na conexão com banco de dados.'
            ];
        }
    } catch (Exception $e) {
        return [
            'status' => 'error',
            'message' => 'Erro: ' . $e->getMessage()
        ];
    }
}

// Função para verificar se as tabelas necessárias existem
function checkRequiredTables() {
    $requiredTables = [
        'admin',
        'posts', 
        'membros',
        'contacts',
        'subscribers',
        'comments',
        'settings'
    ];
    
    $missingTables = [];
    $existingTables = [];
    
    foreach ($requiredTables as $table) {
        $query = "SHOW TABLES LIKE '$table'";
        $result = mysqli_query($GLOBALS['connection'], $query);
        
        if (mysqli_num_rows($result) > 0) {
            $existingTables[] = $table;
        } else {
            $missingTables[] = $table;
        }
    }
    
    return [
        'existing' => $existingTables,
        'missing' => $missingTables,
        'all_exist' => empty($missingTables)
    ];
}

// Verificar conexão automaticamente se estiver em modo debug
if (DB_DEBUG && !isDatabaseConnected()) {
    echo "<div style='background: #ffebee; color: #c62828; padding: 15px; margin: 10px; border-radius: 5px; border-left: 4px solid #c62828;'>";
    echo "<strong>Erro de Conexão:</strong> Não foi possível conectar ao banco de dados.";
    echo "</div>";
}

?>
