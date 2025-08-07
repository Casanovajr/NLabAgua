<?php
// Teste simplificado do dashboard
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔧 Teste do Dashboard</h1>";

// Testar configuração
try {
    require_once 'config.php';
    echo "<p>✅ Configuração carregada</p>";
    
    if (isset($connection)) {
        echo "<p>✅ Conexão com banco disponível</p>";
        
        // Testar queries básicas
        $tables = ['posts', 'contacts', 'subscribers', 'comments'];
        
        foreach ($tables as $table) {
            $sql = "SELECT COUNT(*) as count FROM $table";
            $query = mysqli_query($connection, $sql);
            
            if ($query) {
                $row = mysqli_fetch_assoc($query);
                echo "<p>✅ Tabela $table: " . $row['count'] . " registros</p>";
            } else {
                echo "<p>❌ Erro na tabela $table: " . mysqli_error($connection) . "</p>";
            }
        }
    } else {
        echo "<p>❌ Variável \$connection não está disponível</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Erro: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='login.php'>🔐 Ir para Login</a></p>";
echo "<p><a href='../index.php'>🏠 Voltar ao Site</a></p>";
?>
