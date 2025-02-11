<?php
require 'createaccount.php';
$sql = "INSERT INTO users(name,  email, password, phone, address, gender, age, date_of_birth, lga, state, country) 
VALUES(:name, :email, :password, :phone, :address, :gender, :age, :date_of_birth, :lga, :state, :country)";
$stmt = $conn->prepare($sql);
// Bind parameters
$stmt->bindparam(':name', $name);
$stmt->bindparam(':email', $email);
$stmt->bindparam(':password', $password);
$stmt->bindparam(':phone', $phone);
$stmt->bindparam(':address', $address);
$stmt->bindparam(':gender', $gender);
$stmt->bindparam(':age', $age);
$stmt->bindparam(':date_of_birth', $date_of_birth);
$stmt->bindparam(':lga', $lga);
$stmt->bindparam(':state', $state);
$stmt->bindparam(':country', $country);
// Set Values and execute
$name = "Agi Kingdom";
$email = "agikingdom4us@gmail.com";
$password = "King@001";
$phone = "0703-885-3061";
$address = "Ebize street obagi town";
$gender = "male";
$age = 30;
$date_of_birth = "2000-01-01";
$lga = "Ogba-Egbema-Ndoni";
$state = "Rivers";
$country = "Nigeria";
$stmt->execute();
echo "New record created successfully!";
?>