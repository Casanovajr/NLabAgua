
<?php 

// Incluir funções de segurança
require_once "../../security.php";
require_once "db.php";

if (isset($_POST["id"])) {
    
    // Validar entrada
    $id = validateInt($_POST["id"], 1);
    
    if ($id === false) {
        logSecurity("Invalid post ID for deletion: " . $_POST["id"], 'WARNING');
        header('Location:../posts.php?del_error');
        exit();
    }
    
    try {
        // Primeiro, deletar os comentários associados
        $sql_comments = "DELETE FROM comments WHERE blogid = ?";
        $stmt_comments = $db->prepare($sql_comments);
        $stmt_comments->execute([$id]);
        
        // Depois, deletar o post
        $sql_post = "DELETE FROM posts WHERE id = ?";
        $stmt_post = $db->prepare($sql_post);
        
        if ($stmt_post->execute([$id])) {
            // Verificar se o post foi realmente deletado
            if ($stmt_post->rowCount() > 0) {
                logSecurity("Post deleted successfully. ID: $id", 'INFO');
                header('Location:../posts.php?deleted');
            } else {
                logSecurity("No post found with ID: $id", 'WARNING');
                header('Location:../posts.php?del_error');
            }
        } else {
            throw new Exception("Failed to delete post");
        }

    } catch (Exception $e) {
        logSecurity("Error deleting post ID $id: " . $e->getMessage(), 'ERROR');
        error_log("Delete post error: " . $e->getMessage());
        header('Location:../posts.php?del_error');
    }

} else {
    logSecurity("Delete post called without ID", 'WARNING');
    header('Location:../posts.php?del_error');
}

exit();

?>