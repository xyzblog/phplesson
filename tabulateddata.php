<?php
// to retrieve  or fetchinformation from a table
require 'createaccount.php';
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
// Execute the query
$stmt->execute();
// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<table border='1' cellspacing='0' cellspacing='10'>";
echo "<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Password</th>
<th>Phone</th>
<th>Address</th>
<th>Gender</th>
<th>Age</th>
<th>Date of Birth</th>
<th>LGA</th>
<th>State</th>
<th>Country</th>
</tr>";
foreach ($results as $row) {
    echo "<tr>
    <td>{$row["user_id"]}</td>
    <td>{$row["name"]}</td>
    <td>{$row["email"]}</td>
    <td>{$row["password"]}</td>
    <td>{$row["phone"]}</td>
    <td>{$row["address"]}</td>
    <td>{$row["gender"]}</td>
    <td>{$row["age"]}</td>
    <td>{$row["date_of_birth"]}</td>
    <td>{$row["lga"]}</td>
    <td>{$row["state"]}</td>
    <td>{$row["country"]}</td>
    </tr>";
}
echo "</table>";
// To update users data from the table
$user_id = 2;
$name = "Jennifer Smith";
$email = "jennifersmith@example.com";
$password = "$2y$10ab";
$phone = "12345678910";
$sql = "UPDATE users SET name = :name, email = :email, password = :password, phone = :phone where user_id = :id";
// $sql = "UPDATE users SET name = :name, email = :email, password = :password, phone = :phone WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindparam(':id', $user_id);
$stmt->bindparam(':name', $name);
$stmt->bindparam('email', $email);
$stmt->bindparam(':password', $password);
$stmt->bindparam(':phone', $phone);
if ($stmt->execute()) {
    echo "User updated successfully<br>";
}else{
    echo "Error updating user<br>";
}

?>