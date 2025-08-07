<?php
/**
 * Arquivo de teste para diagnosticar problemas de exclusão de posts
 * REMOVER APÓS TESTE
 */

require_once "../security.php";
require_once "functions/db.php";

echo "<h2>Teste de Diagnóstico - Exclusão de Posts</h2>";

// Testar conexão com banco
echo "<h3>1. Teste de Conexão</h3>";
if ($connection) {
    echo "✅ Conexão MySQLi: OK<br>";
} else {
    echo "❌ Conexão MySQLi: FALHOU<br>";
}

if ($db) {
    echo "✅ Conexão PDO: OK<br>";
} else {
    echo "❌ Conexão PDO: FALHOU<br>";
}

// Listar posts existentes
echo "<h3>2. Posts Existentes</h3>";
try {
    $sql = "SELECT id, title, date FROM posts ORDER BY id DESC LIMIT 5";
    $result = $db->query($sql);
    
    if ($result->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Título</th><th>Data</th></tr>";
        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum post encontrado.";
    }
} catch (Exception $e) {
    echo "❌ Erro ao listar posts: " . $e->getMessage();
}

// Testar se existe tabela de comentários
echo "<h3>3. Teste de Tabela de Comentários</h3>";
try {
    $sql = "SELECT COUNT(*) as total FROM comments";
    $result = $db->query($sql);
    $row = $result->fetch();
    echo "✅ Tabela comments existe. Total de comentários: " . $row['total'] . "<br>";
} catch (Exception $e) {
    echo "❌ Problema com tabela comments: " . $e->getMessage() . "<br>";
}

// Testar função de validação
echo "<h3>4. Teste de Validação</h3>";
$test_id = validateInt("123", 1);
echo "validateInt('123', 1) = " . ($test_id !== false ? $test_id : 'false') . "<br>";

$test_invalid = validateInt("abc", 1);
echo "validateInt('abc', 1) = " . ($test_invalid !== false ? $test_invalid : 'false') . "<br>";

// Simular exclusão (sem executar)
echo "<h3>5. Teste de Query de Exclusão (Simulação)</h3>";
if (isset($_GET['test_id'])) {
    $test_id = validateInt($_GET['test_id'], 1);
    if ($test_id !== false) {
        try {
            // Preparar queries sem executar
            $sql_comments = "DELETE FROM comments WHERE blogid = ?";
            $stmt_comments = $db->prepare($sql_comments);
            echo "✅ Query de comentários preparada com sucesso<br>";
            
            $sql_post = "DELETE FROM posts WHERE id = ?";
            $stmt_post = $db->prepare($sql_post);
            echo "✅ Query de post preparada com sucesso<br>";
            
            echo "✅ Queries preparadas corretamente. ID testado: $test_id<br>";
            echo "<strong>NOTA:</strong> Nenhuma exclusão foi executada neste teste.<br>";
            
        } catch (Exception $e) {
            echo "❌ Erro ao preparar queries: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "❌ ID inválido fornecido<br>";
    }
} else {
    echo "Para testar, adicione ?test_id=X na URL (onde X é um ID válido)<br>";
}

echo "<hr>";
echo "<p><strong>IMPORTANTE:</strong> Remova este arquivo após o teste!</p>";
?>