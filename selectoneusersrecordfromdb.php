<!-- How to select one's recordsfrom a table of data fixed in a database ro editing or replacement using MYSQLi EXTENSION -->
 <!-- step1: connect to the database -->
<?php
$servername = "localhost";
// the username from the server
$username = "root";
$password = "";
// my database name
$dbname = "createaccount";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// check connection
if($conn->connect_error){
    die("Connection failed!" . $conn->connect_error);
}

// Step 2: select the user's records
$user_id = 3;
// Replace with desired user ID
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql); 
//Step 3: Fetch the user's records
if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    // Display the user's records
    echo "Name: " . $row["name"]. " Email:" .$row["email"]. "password" .$row["password"]. "<br>";
}else{
    echo "3 results";
}

// USING PDO EXTENSION:
// STEP 1: CONNECT TO DATABASE
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "createaccount";
// try{
    // CREATE CONNECTION
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // SET PDO ERROR TO EXCEPTION
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    // $user_id = "2";
// REPLACE WITH DESIRED USER ID
// $sql = "SELECT *  FROM users WHERE user_id = :user_id";
// $stmt = $conn->prepare($sql);
// $stmt->bindParam(':user_id', $user_id);
// $stmt->execute();
// }
// catch(PDOEXCEPTION $e){
    // echo "Connection failed:" . $e->getMessage();
// }

// STEP 2: SELECT THE USER'S RECORDS

?>