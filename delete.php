<?php
include 'createconnectionofdbtophp.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE user_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    echo "User deleted successfully.";
    
}
?>