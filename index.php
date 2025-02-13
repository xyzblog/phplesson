<?php
// Include database connmection
used database: 'polytechnicsite'
include 'index.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $sql = "INSERT INTO users (:user_name, :email, :dob)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':user_name' =>$user_name, ':email'=>$mail, ':dob'=>$dob]);
    echo "user created successfully.";
}

?>