<?php
require 'dbconnection.php';
$sql = "INSERT INTO users(user_name, email_address) VALUES (:user_name, :email_address)";
$stmt = $conn->prepare($sql);
// Bind parameters
$stmt->bindparam(':user_name', $name);
$stmt->bindparam(':email_address', $email);
// Set values and execute
$name = "Agi Kingdom";
$email = "agikingdom4us@gmail.com";
$stmt->execute();
echo "New record created successfully!"
?>