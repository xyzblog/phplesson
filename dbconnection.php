<?php
// DATABASE CONNECTION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pupils";
try{
    // CREATE CONNECTION
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // SET PDO ERROR TO EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful";
}
catch(PDOEXCEPTION $e){
    echo "Connection failed:" . $e->getMessage();
}
?>