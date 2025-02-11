CREATE DATABASE createaccount;

USE createaccount;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    date_of_birth DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    lga VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL
);

step 2 INSERT 10 SAMPLE users
INSERT INTO users (first_name, last_name, other_name, email, password, age, gender, date_of_birth, address, phone, lga, state, country)
VALUES
('John', 'Doe', 'Michael', 'johndoe@example.com', '$2y$10$abcdefg', 25, 'Male', '1998-05-15', '123 Street, City', '1234567890', 'LGA1', 'State1', 'Country1'),
('Jane', 'Smith', 'Ann', 'janesmith@example.com', '$2y$10$abcdefg', 22, 'Female', '2002-10-20', '456 Avenue, Town', '0987654321', 'LGA2', 'State2', 'Country2'),
('Michael', 'Johnson', 'Chris', 'michaelj@example.com', '$2y$10$abcdefg', 28, 'Male', '1995-02-05', '789 Road, Village', '1231231234', 'LGA3', 'State3', 'Country3'),
('Emily', 'Brown', 'Rose', 'emilyb@example.com', '$2y$10$abcdefg', 24, 'Female', '1999-07-12', '101 Blvd, County', '3213214321', 'LGA4', 'State4', 'Country4'),
('Daniel', 'Williams', 'Lee', 'danielw@example.com', '$2y$10$abcdefg', 26, 'Male', '1997-09-25', '222 Lane, Region', '9876543210', 'LGA5', 'State5', 'Country5'),
('Olivia', 'Jones', 'May', 'oliviaj@example.com', '$2y$10$abcdefg', 21, 'Female', '2003-04-18', '333 Street, Province', '4567891230', 'LGA6', 'State6', 'Country6'),
('William', 'Taylor', 'John', 'williamt@example.com', '$2y$10$abcdefg', 27, 'Male', '1996-06-30', '444 Drive, District', '5678904321', 'LGA7', 'State7', 'Country7'),
('Sophia', 'Anderson', 'Eve', 'sophiaa@example.com', '$2y$10$abcdefg', 23, 'Female', '2000-12-05', '555 Path, Zone', '6789012345', 'LGA8', 'State8', 'Country8'),
('James', 'Martinez', 'George', 'jamesm@example.com', '$2y$10$abcdefg', 29, 'Male', '1994-03-22', '666 Avenue, City', '7890123456', 'LGA9', 'State9', 'Country9'),
('Ava', 'Hernandez', 'Marie', 'avah@example.com', '$2y$10$abcdefg', 20, 'Female', '2004-08-10', '777 Rd, Town', '8901234567', 'LGA10', 'State10', 'Country10');

STEP3: CONNECT TO MYSQL DATABASE USING PASSWORD_DEFAULT
<?php
$host = "localhost";
$dbname = "createaccount";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

STEP4: CREATE REGISTRATION FORM WITH Validation
<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $other_name = trim($_POST["other_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $age = intval($_POST["age"]);
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $lga = trim($_POST["lga"]);
    $state = trim($_POST["state"]);
    $country = trim($_POST["country"]);

    // Validate password
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        die("Password must have at least one uppercase letter, one lowercase letter, one number, and one special character.");
    }

    // Validate phone number
    if (!preg_match('/^\d{10,15}$/', $phone)) {
        die("Phone number must be between 10 to 15 digits.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (first_name, last_name, other_name, email, password, age, gender, date_of_birth, address, phone, lga, state, country)
            VALUES (:first_name, :last_name, :other_name, :email, :password, :age, :gender, :date_of_birth, :address, :phone, :lga, :state, :country)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':other_name' => $other_name,
        ':email' => $email,
        ':password' => $hashed_password,
        ':age' => $age,
        ':gender' => $gender,
        ':date_of_birth' => $date_of_birth,
        ':address' => $address,
        ':phone' => $phone,
        ':lga' => $lga,
        ':state' => $state,
        ':country' => $country
    ]);

    echo "Registration successful!";
}
?>

STEP5: CREATE THE HTML FORM
<form action="register.php" method="post">
    <input type="text" name="first_name" required placeholder="First Name">
    <input type="text" name="last_name" required placeholder="Last Name">
    <input type="text" name="other_name" placeholder="Other Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <input type="text" name="phone" required placeholder="Phone Number">
    <button type="submit">Register</button>
</form>
