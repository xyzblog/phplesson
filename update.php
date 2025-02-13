<?php
include 'createconnectionofdbtophp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_id = $_POST['id'];
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET name = :name, email = :email, age = :age WHERE user_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':name' =>$name, ':email' => $email, ':age' =>$age, ':id' => $user_id]);
    echo "User updated successfully. <a href = 'home.html'>Back to Home</a>";
}
?> 