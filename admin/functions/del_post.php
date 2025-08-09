
<?php 

 
require_once "db.php";

if (isset($_POST["id"])) {

	$id = $_POST["id"];

    // Apaga o post e possíveis comentários associados, mesmo que não existam comentários
    $sql = "DELETE posts, comments FROM posts LEFT JOIN comments ON comments.blogid = posts.id WHERE posts.id = ?";

    $stmt = $db->prepare($sql);


    try {
      $stmt->execute([$id]);
      header('Location:../posts.php?deleted');

      }

     catch (Exception $e) {
        $e->getMessage();
        echo "Error";
    }

}
else {
	header('Location:../posts.php?del_error');
}

	

?>