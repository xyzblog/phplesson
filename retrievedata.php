<?php
// to retrieve  or fetch data or information from a table
require 'createaccount.php';
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
// Execute the query
$stmt->execute();
// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $row) {
    echo "ID:" . $row["user_id"] . "-Name:" . $row["name"] . "-Email:" . $row["email"] . "-password:" . $row["password"] . "-Phone:" . $row["phone"] . "-Address:" . $row["address"] . "-Gender:" . $row["gender"] . $row["age"] . "-date_of_birth:" . $row["date_of_birth"] . "-lga:" . $row["lga"] . "-state:" . $row["state"] . "-country:" . $row["country"]. "<br>";
}

?>