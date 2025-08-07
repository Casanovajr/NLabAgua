<?php
/**
 * Funções de segurança centralizadas
 * Este arquivo contém funções para proteger o sistema contra vulnerabilidades
 */

/**
 * Sanitiza entrada de dados para prevenir XSS
 */
function sanitizeOutput($data) {
    if (is_array($data)) {
        return array_map('sanitizeOutput', $data);
    }
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitiza entrada de dados
 */
function sanitizeInput($data) {
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

/**
 * Valida email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Valida inteiro
 */
function validateInt($value, $min = null, $max = null) {
    $options = array();
    if ($min !== null) $options['min_range'] = $min;
    if ($max !== null) $options['max_range'] = $max;
    
    return filter_var($value, FILTER_VALIDATE_INT, array('options' => $options));
}

/**
 * Gera token CSRF
 */
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verifica token CSRF
 */
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Configura sessão segura
 */
function setupSecureSession() {
    // Configurações de sessão seguras
    if (!headers_sent()) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_strict_mode', 1);
        
        // Só usar secure em HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            ini_set('session.cookie_secure', 1);
        }
    }
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Timeout de sessão (30 minutos)
    $timeout = 1800;
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();
        return false;
    }
    $_SESSION['last_activity'] = time();
    
    return true;
}

/**
 * Verifica se usuário está autenticado
 */
function requireAuth($redirectTo = 'login.php') {
    if (!setupSecureSession()) {
        header("Location: $redirectTo?timeout=1");
        exit();
    }
    
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header("Location: $redirectTo");
        exit();
    }
    
    return true;
}

/**
 * Validar tipo de arquivo de upload
 */
function validateFileUpload($file, $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'], $maxSize = 5242880) {
    // Verificar se arquivo foi enviado
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Erro no upload do arquivo.");
    }
    
    // Verificar tamanho
    if ($file['size'] > $maxSize) {
        throw new Exception("Arquivo muito grande. Máximo: " . ($maxSize / 1024 / 1024) . "MB");
    }
    
    // Verificar tipo MIME
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Tipo de arquivo não permitido.");
    }
    
    // Verificar tipo real do arquivo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $realType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($realType, $allowedTypes)) {
        throw new Exception("Tipo de arquivo real não permitido.");
    }
    
    return true;
}

/**
 * Log de segurança
 */
function logSecurity($message, $level = 'INFO') {
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    
    $logEntry = "[$timestamp] [$level] $message - IP: $ip - User-Agent: $userAgent" . PHP_EOL;
    
    // Log em arquivo (certifique-se de que o diretório existe e tem permissões)
    error_log($logEntry, 3, __DIR__ . '/logs/security.log');
}

/**
 * Rate limiting básico (previne ataques de força bruta)
 */
function checkRateLimit($action, $limit = 5, $timeWindow = 300) {
    if (!isset($_SESSION['rate_limit'])) {
        $_SESSION['rate_limit'] = array();
    }
    
    $now = time();
    $key = $action . '_' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    
    // Limpar tentativas antigas
    if (isset($_SESSION['rate_limit'][$key])) {
        $_SESSION['rate_limit'][$key] = array_filter(
            $_SESSION['rate_limit'][$key],
            function($timestamp) use ($now, $timeWindow) {
                return ($now - $timestamp) < $timeWindow;
            }
        );
    } else {
        $_SESSION['rate_limit'][$key] = array();
    }
    
    // Verificar limite
    if (count($_SESSION['rate_limit'][$key]) >= $limit) {
        logSecurity("Rate limit exceeded for action: $action", 'WARNING');
        return false;
    }
    
    // Registrar tentativa
    $_SESSION['rate_limit'][$key][] = $now;
    return true;
}

?>