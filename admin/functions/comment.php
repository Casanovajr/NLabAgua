

<?php

require_once "../security.php";
require_once "../admin/functions/db.php";

if (isset($_POST['submit'])) {
    // Validar e sanitizar entradas
    $blogid = validateInt($_POST['blogid'], 1);
    $name = sanitizeInput($_POST['name']);
    $comment = sanitizeInput($_POST['comment']);
    
    // Validações
    if ($blogid === false) {
        die('ID do blog inválido.');
    }
    
    if (empty($name) || empty($comment)) {
        die('Nome e comentário são obrigatórios.');
    }
    
    if (strlen($name) > 100) {
        die('Nome deve ter no máximo 100 caracteres.');
    }
    
    if (strlen($comment) > 1000) {
        die('Comentário deve ter no máximo 1000 caracteres.');
    }
	
	$sql = "INSERT INTO comments(name, comment, blogid)
    VALUES (?,?,?)";

    $stmt = $db->prepare($sql);


    try {
      $stmt->execute([$name, $comment, $blogid]);
      header('Location:../blog.php');
      // echo "DONE!!";

      }

     catch (Exception $e) {
        $e->getMessage();
        echo "Error";
    }	

}







?>