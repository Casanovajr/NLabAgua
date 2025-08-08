<?php
session_start();
/**
 * Configuração Centralizada para Admin
 * LabÁgua - Sistema de Análise de Água
 */

// Definir constantes do sistema
define('ADMIN_PATH', __DIR__ . '/../');
define('ROOT_PATH', __DIR__ . '/../../');
define('SITE_URL', 'http://localhost/labag'); // Ajuste conforme necessário

// Incluir configuração do banco de dados
require_once ADMIN_PATH . 'config/database.php';

// Incluir funções do banco de dados
require_once ADMIN_PATH . 'functions/db.php';

// Incluir funções de segurança globais (requireAuth, setupSecureSession, etc.)
require_once ROOT_PATH . 'security.php';

// Configurações de sessão


// Configurações de timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de erro (apenas em desenvolvimento)
if (DB_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Função para verificar se o usuário está logado
function isLoggedIn() {
    // Considera sessões com admin_id OU e-mail (usado pelo fluxo atual)
    return (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
        || (isset($_SESSION['email']) && !empty($_SESSION['email']));
}

// Função para verificar permissões
function hasPermission($permission) {
    if (!isLoggedIn()) {
        return false;
    }
    
    // Implementar lógica de permissões conforme necessário
    return true;
}

// Função para redirecionar
function redirect($url) {
    header("Location: $url");
    exit();
}

// Função para sanitizar entrada
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Funções CSRF já existem em security.php; definir apenas se não existirem
if (!function_exists('generateCSRFToken')) {
    function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('verifyCSRFToken')) {
    function verifyCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

// Função para log de atividades
function logActivity($action, $details = '') {
    global $connection;
    
    if (isLoggedIn()) {
        $admin_id = $_SESSION['admin_id'];
        $admin_name = $_SESSION['admin_name'] ?? 'Unknown';
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        
        $query = "INSERT INTO system_logs (admin_id, admin_name, action, details, ip_address, user_agent) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        
        executeQuery($query, [$admin_id, $admin_name, $action, $details, $ip, $user_agent]);
    }
}

// Função para obter configurações do sistema
function getSystemSettings() {
    $settings = fetchMultiple("SELECT setting_key, setting_value FROM settings");
    $config = [];
    
    foreach ($settings as $setting) {
        $config[$setting['setting_key']] = $setting['setting_value'];
    }
    
    return $config;
}

// Função para atualizar configurações do sistema
function updateSystemSetting($key, $value) {
    $query = "INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) 
              ON DUPLICATE KEY UPDATE setting_value = ?";
    
    return executeQuery($query, [$key, $value, $value]);
}

// Verificar se o banco está conectado
if (!isDatabaseConnected()) {
    if (DB_DEBUG) {
        die("Erro: Não foi possível conectar ao banco de dados. Verifique as configurações.");
    } else {
        die("Erro interno do servidor.");
    }
}

?>
