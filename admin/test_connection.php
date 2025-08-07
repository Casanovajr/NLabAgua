<?php
/**
 * Teste de Conexão com Banco de Dados
 * LabÁgua - Sistema de Análise de Água
 */

// Incluir configuração do banco
require_once __DIR__ . '/config/database.php';

// Definir cabeçalho para JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Testar conexão
    $testResult = testDatabaseConnection();
    
    if ($testResult['status'] === 'success') {
        // Verificar tabelas
        $tableCheck = checkRequiredTables();
        
        $response = [
            'status' => 'success',
            'database' => [
                'host' => DB_HOST,
                'name' => DB_NAME,
                'user' => DB_USER,
                'port' => DB_PORT,
                'server_info' => $testResult['server_info']
            ],
            'tables' => $tableCheck,
            'message' => 'Configuração do banco de dados está funcionando corretamente!'
        ];
        
        if (!$tableCheck['all_exist']) {
            $response['warning'] = 'Algumas tabelas estão faltando. Execute o arquivo database/labagua.sql no phpMyAdmin.';
        }
        
    } else {
        $response = [
            'status' => 'error',
            'message' => $testResult['message'],
            'database' => [
                'host' => DB_HOST,
                'name' => DB_NAME,
                'user' => DB_USER,
                'port' => DB_PORT
            ]
        ];
    }
    
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => 'Erro inesperado: ' . $e->getMessage(),
        'database' => [
            'host' => DB_HOST,
            'name' => DB_NAME,
            'user' => DB_USER,
            'port' => DB_PORT
        ]
    ];
}

// Retornar resultado em JSON
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
