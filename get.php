<?php
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$othername = $_GET['othername'];
$dob = $_GET['dob'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$homeaddress = $_GET['homeaddress'];
$lga = $_GET['lga'];
$state = $_GET['state'];
$country = $_GET['country'];
$message = $_GET['message'];
echo "First Name: $firstname<br>";
echo "Last Name: $lastname<br>";
echo "Other Name: $othername<br>";
echo "Date of Birth: $dob<br>";
echo "Email: $email<br>";
echo "Phone: $phone<br>";
echo "Home Address: $homeaddress<br>";
echo "L.G.A: $lga<br>";
echo "State: $state<br>";
echo "Country: $country<br>";
echo "Message: $message<br>";
?>