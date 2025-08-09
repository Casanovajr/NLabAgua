<?php
// Charset upgrade tool: set database and key tables to utf8mb4 (emoji support)
// Usage: open in browser while logged in as admin: /labag/admin/tools/charset_upgrade.php

require_once __DIR__ . '/../functions/db.php';

header('Content-Type: text/plain; charset=utf-8');

function runQuery(mysqli $conn, string $sql): bool {
    $ok = mysqli_query($conn, $sql);
    if (!$ok) {
        echo "[ERRO] " . mysqli_error($conn) . "\nSQL: $sql\n\n";
    } else {
        echo "[OK] $sql\n";
    }
    return $ok;
}

echo "Atualizando charset/collation para utf8mb4...\n\n";

$dbName = defined('DB_NAME') ? DB_NAME : null;
if (!$dbName) {
    echo "[ERRO] DB_NAME não definido.\n";
    exit; 
}

// Database
runQuery($connection, "ALTER DATABASE `" . $dbName . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// Tabelas alvo
$tables = ['posts', 'comments'];
foreach ($tables as $t) {
    runQuery($connection, "ALTER TABLE `{$t}` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
}

// Colunas específicas (garantia extra)
runQuery($connection, "ALTER TABLE `posts` 
    MODIFY `author` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    MODIFY `title` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    MODIFY `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL");

runQuery($connection, "ALTER TABLE `comments`
    MODIFY `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    MODIFY `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL");

echo "\nConcluído. Teste inserir/emojis em posts e comentários.\n";


