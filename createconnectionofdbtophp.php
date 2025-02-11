<?php
// Database Connection
$servername = "localhost";
// the name of the hosting server
$username = "root";
// the name of the site
$password = "";
// this password will be given by the hoster to your dashboard
$dbname = "createaccount"; 
// dbname of the data base you created in you MSQL worksheet
try{
    // Create connection
    $conn = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
    // Set PDO Error To Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection successful!";
}
catch(PDOEXCEPTION $e){
    echo "Connections failed!" . $e->getMessage();
}
?>