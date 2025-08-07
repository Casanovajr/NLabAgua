<?php
require_once "db.php";

$author = $_POST['author'] ?? 'Anônimo';
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $title && $content) {
  $sql = "INSERT INTO posts (author, title, content) VALUES (?, ?, ?)";
  $stmt = $db->prepare($sql);

  try {
    $stmt->execute([$author, $title, $content]);
    header('Location: ../posts.php?posted');
    exit;
  } catch (Exception $e) {
    echo "Erro ao salvar: " . $e->getMessage();
  }
} else {
  echo "Preencha todos os campos obrigatórios.";
}
