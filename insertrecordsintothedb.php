<?php
// INSERTING RECORDS USING MYSQLi
// SET AND CONNECT THE DATABASE FIRST
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "createaccount";

// CREATE CONNECTION
try( $conn = new PDO($username, $password))


// TABLE DATA
$data = array(array("name" =>"Agi Shalom", "email" => "agi.shalom@gmail.com", "password"=> "xyz0$1234567Agi", "age"=> 10, "gender"=> "male", "date_of_birth"=> "2015-07-30", "address"=> "# 7 Ebize street obagi town", "lga"=> "Onelga", "state"=> "Rivers", "country"=> "Nigeria", "phone"=> "07038853061")
);

// INSERT RECORDS

    $sql = "INSERT INTO users(name, email, password, age, gender, date_of_birth, address, lga, state, country, phone) 
    VALUES("''" . $row["name"]."' '" .$row["email"]."' '" .$row["password"]."' '" .$row["age"]."' '" .$row["gender"]."' '" .$row["date_of_birth"]."' '". $row["address"]."' '" .$row["lga"]."' '" .$row["state"]."' '" .$row["phone"]."' '" .$row["country"].)";
    if ($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }else{
        echo "Error: ".$sql. "<br>". $conn->error;
    }
}
// CLOSE THE CONNECTION
$conn->close();
?>