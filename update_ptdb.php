<?php 

require_once 'db.php';
 $stmt = $pdo->prepare("
    update patients set status = 'accepted' where id = ?
    ");
    $stmt->execute([$_GET["id"]]);

?>