


<?php
/**
 * LabÁgua - Conexão com Banco de Dados
 * Configuração atualizada para XAMPP
 */

// Incluir configurações centralizadas da pasta admin
require_once __DIR__ . '/../config/database.php';

// Verificar se a conexão foi estabelecida
if (!isDatabaseConnected()) {
    if (DB_DEBUG) {
        die("Erro na conexão com banco de dados: " . mysqli_connect_error());
    } else {
        die("Erro interno do servidor. Verifique as configurações do banco.");
    }
}

// Função auxiliar para executar queries com tratamento de erro
function executeQuery($query, $params = []) {
    global $connection;
    
    try {
        if (empty($params)) {
            $result = mysqli_query($connection, $query);
        } else {
            $stmt = mysqli_prepare($connection, $query);
            if ($stmt) {
                // Determinar tipos dos parâmetros automaticamente
                $types = '';
                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= 'i';
                    } elseif (is_float($param)) {
                        $types .= 'd';
                    } else {
                        $types .= 's';
                    }
                }
                
                mysqli_stmt_bind_param($stmt, $types, ...$params);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            } else {
                throw new Exception("Erro ao preparar query: " . mysqli_error($connection));
            }
        }
        
        if (!$result && mysqli_error($connection)) {
            throw new Exception("Erro na query: " . mysqli_error($connection));
        }
        
        return $result;
        
    } catch (Exception $e) {
        if (function_exists('logError')) {
            logError("Database Query Error: " . $e->getMessage() . " | Query: " . $query);
        }
        
        if (defined('DB_DEBUG') && DB_DEBUG) {
            throw $e;
        } else {
            return false;
        }
    }
}

// Função para obter um registro único
function fetchSingle($query, $params = []) {
    $result = executeQuery($query, $params);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

// Função para obter múltiplos registros
function fetchMultiple($query, $params = []) {
    $result = executeQuery($query, $params);
    $data = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    
    return $data;
}

// Função para inserir dados
function insertData($table, $data) {
    $columns = implode(',', array_keys($data));
    $placeholders = str_repeat('?,', count($data) - 1) . '?';
    $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
    
    return executeQuery($query, array_values($data));
}

// Função para atualizar dados
function updateData($table, $data, $where, $whereParams = []) {
    $setParts = [];
    foreach (array_keys($data) as $column) {
        $setParts[] = "{$column} = ?";
    }
    $setClause = implode(', ', $setParts);
    
    $query = "UPDATE {$table} SET {$setClause} WHERE {$where}";
    $params = array_merge(array_values($data), $whereParams);
    
    return executeQuery($query, $params);
}

// Função para deletar dados
function deleteData($table, $where, $params = []) {
    $query = "DELETE FROM {$table} WHERE {$where}";
    return executeQuery($query, $params);
}

// Função para contar registros
function countRecords($table, $where = '', $params = []) {
    $query = "SELECT COUNT(*) as total FROM {$table}";
    if (!empty($where)) {
        $query .= " WHERE {$where}";
    }
    
    $result = fetchSingle($query, $params);
    return $result ? (int)$result['total'] : 0;
}

// Função para verificar se tabela existe
function tableExists($tableName) {
    // SHOW/DDL não suporta prepared statements no MySQL/MariaDB
    global $connection;
    $safe = mysqli_real_escape_string($connection, $tableName);
    $sql = "SHOW TABLES LIKE '$safe'";
    $result = executeQuery($sql);
    return $result && mysqli_num_rows($result) > 0;
}

// Verificar se as tabelas principais existem (apenas em modo debug)
if (defined('DB_DEBUG') && DB_DEBUG) {
    $requiredTables = ['admin', 'posts', 'membros', 'contacts', 'subscribers'];
    $missingTables = [];

    foreach ($requiredTables as $table) {
        if (!tableExists($table)) {
            $missingTables[] = $table;
        }
    }

    if (!empty($missingTables)) {
        $message = "Tabelas não encontradas: " . implode(', ', $missingTables) . 
                   ". Execute o arquivo database/labagua.sql no phpMyAdmin.";
        if (function_exists('logError')) {
            logError($message);
        }
        echo "<div style='background: #ffebee; color: #c62828; padding: 15px; margin: 10px; border-radius: 5px; border-left: 4px solid #c62828;'>";
        echo "<strong>Erro de Banco de Dados:</strong><br>";
        echo $message;
        echo "</div>";
    }
}

?>