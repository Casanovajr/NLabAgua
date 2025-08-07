<?php
/**
 * =============================================
 * LabÁgua - Configuração do Banco de Dados
 * =============================================
 * Configurações para conexão MySQL via XAMPP
 * 
 * @author LabÁgua Team
 * @version 1.0
 * @since 2024
 */

// Configurações do ambiente
define('DB_ENVIRONMENT', 'development'); // development, production, testing

// Configurações do banco de dados para XAMPP
if (DB_ENVIRONMENT === 'development') {
    // Configurações para desenvolvimento local (XAMPP)
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_NAME', 'labagua');
    define('DB_USER', 'root');
    define('DB_PASS', ''); // Senha vazia por padrão no XAMPP
    define('DB_CHARSET', 'utf8mb4');
    
    // Configurações de debug
    define('DB_DEBUG', true);
    define('DB_LOG_ERRORS', true);
    
} elseif (DB_ENVIRONMENT === 'production') {
    // Configurações para produção (Hostinger ou outro)
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_NAME', 'u863616108_labagua');
    define('DB_USER', 'u863616108_labagua');
    define('DB_PASS', 'SuaSenhaSegura123!');
    define('DB_CHARSET', 'utf8mb4');
    
    // Configurações de segurança para produção
    define('DB_DEBUG', false);
    define('DB_LOG_ERRORS', true);
}

// Configurações SSL (se necessário)
define('DB_SSL_ENABLE', false);
define('DB_SSL_CA', '');
define('DB_SSL_CERT', '');
define('DB_SSL_KEY', '');

// Configurações de conexão
define('DB_TIMEOUT', 30);
define('DB_PERSISTENT', false);
define('DB_AUTO_RECONNECT', true);

/**
 * Classe para gerenciamento de conexão com banco de dados
 */
class DatabaseConfig {
    private static $instance = null;
    private $connection = null;
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;
    private $charset;
    
    /**
     * Construtor privado para implementar Singleton
     */
    private function __construct() {
        $this->host = DB_HOST;
        $this->port = DB_PORT;
        $this->database = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
        $this->charset = DB_CHARSET;
    }
    
    /**
     * Obtém a instância única da classe (Singleton)
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Estabelece conexão com o banco de dados
     */
    public function getConnection() {
        if ($this->connection === null) {
            try {
                // String de conexão DSN
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";
                
                // Opções PDO
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => DB_PERSISTENT,
                    PDO::ATTR_TIMEOUT => DB_TIMEOUT,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}"
                ];
                
                // SSL se habilitado
                if (DB_SSL_ENABLE) {
                    $options[PDO::MYSQL_ATTR_SSL_CA] = DB_SSL_CA;
                    $options[PDO::MYSQL_ATTR_SSL_CERT] = DB_SSL_CERT;
                    $options[PDO::MYSQL_ATTR_SSL_KEY] = DB_SSL_KEY;
                }
                
                // Criar conexão PDO
                $this->connection = new PDO($dsn, $this->username, $this->password, $options);
                
                // Log de sucesso se debug habilitado
                if (DB_DEBUG) {
                    error_log("LabÁgua: Conexão com banco de dados estabelecida com sucesso");
                }
                
            } catch (PDOException $e) {
                $error_message = "Erro na conexão com banco de dados: " . $e->getMessage();
                
                if (DB_LOG_ERRORS) {
                    error_log("LabÁgua Database Error: " . $error_message);
                }
                
                if (DB_DEBUG) {
                    throw new Exception($error_message);
                } else {
                    throw new Exception("Erro interno do servidor. Tente novamente mais tarde.");
                }
            }
        }
        
        return $this->connection;
    }
    
    /**
     * Obtém conexão MySQLi para compatibilidade com código legado
     */
    public function getMysqliConnection() {
        try {
            $connection = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
            
            // Verificar erro de conexão
            if ($connection->connect_error) {
                throw new Exception("Erro MySQLi: " . $connection->connect_error);
            }
            
            // Definir charset
            $connection->set_charset($this->charset);
            
            return $connection;
            
        } catch (Exception $e) {
            if (DB_LOG_ERRORS) {
                error_log("LabÁgua MySQLi Error: " . $e->getMessage());
            }
            
            if (DB_DEBUG) {
                throw $e;
            } else {
                throw new Exception("Erro interno do servidor. Tente novamente mais tarde.");
            }
        }
    }
    
    /**
     * Testa a conexão com o banco
     */
    public function testConnection() {
        try {
            $connection = $this->getConnection();
            $stmt = $connection->query("SELECT 1");
            return $stmt !== false;
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Obtém informações sobre o banco
     */
    public function getDatabaseInfo() {
        try {
            $connection = $this->getConnection();
            $stmt = $connection->query("SELECT VERSION() as version, DATABASE() as database_name");
            return $stmt->fetch();
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Fecha a conexão
     */
    public function closeConnection() {
        $this->connection = null;
    }
    
    /**
     * Previne clonagem do objeto
     */
    private function __clone() {}
    
    /**
     * Previne unserialize do objeto
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

/**
 * Função auxiliar para obter conexão PDO
 */
function getDBConnection() {
    return DatabaseConfig::getInstance()->getConnection();
}

/**
 * Função auxiliar para obter conexão MySQLi (compatibilidade)
 */
function getMysqliConnection() {
    return DatabaseConfig::getInstance()->getMysqliConnection();
}

/**
 * Função para testar conexão
 */
function testDatabaseConnection() {
    return DatabaseConfig::getInstance()->testConnection();
}

// Variável global para compatibilidade com código existente
$connection = null;

try {
    $connection = getMysqliConnection();
} catch (Exception $e) {
    if (DB_DEBUG) {
        die("Erro de conexão: " . $e->getMessage());
    } else {
        die("Erro interno do servidor. Verifique as configurações do banco de dados.");
    }
}

// Definir timezone
date_default_timezone_set('America/Sao_Paulo');

/**
 * Configurações adicionais do sistema
 */
define('SYSTEM_NAME', 'LabÁgua');
define('SYSTEM_VERSION', '1.0.0');
define('SYSTEM_URL', 'http://localhost/labag'); // Ajuste conforme necessário
define('UPLOAD_MAX_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

/**
 * Configurações de segurança
 */
define('SESSION_TIMEOUT', 3600); // 1 hora
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 minutos
define('PASSWORD_MIN_LENGTH', 8);
define('REQUIRE_STRONG_PASSWORD', true);

/**
 * Configurações de email (para notificações)
 */
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'contato@labagua.com');
define('SMTP_PASSWORD', 'sua_senha_app');
define('SMTP_ENCRYPTION', 'tls');
define('FROM_EMAIL', 'contato@labagua.com');
define('FROM_NAME', 'LabÁgua');

/**
 * Configurações de arquivos
 */
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('LOG_DIR', __DIR__ . '/../logs/');
define('BACKUP_DIR', __DIR__ . '/../backups/');

// Criar diretórios se não existirem
$dirs = [UPLOAD_DIR, LOG_DIR, BACKUP_DIR];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

/**
 * Função para log de erros customizado
 */
function logError($message, $file = 'error.log') {
    if (DB_LOG_ERRORS) {
        $timestamp = date('Y-m-d H:i:s');
        $log_message = "[{$timestamp}] {$message}" . PHP_EOL;
        file_put_contents(LOG_DIR . $file, $log_message, FILE_APPEND | LOCK_EX);
    }
}

/**
 * Função para sanitizar dados
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Função para validar email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Função para gerar hash de senha
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Função para verificar senha
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Função para gerar token seguro
 */
function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// Inicializar sessão se não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
    // Configurações de segurança da sessão
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
}

// Definir cabeçalhos de segurança
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}

?>
