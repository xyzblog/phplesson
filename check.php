<?php
$host = "localhost";
$dbname = "createaccount";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $other_name = trim($_POST["other_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $age = intval($_POST["age"]);
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $lga = trim($_POST["lga"]);
    $state = trim($_POST["state"]);
    $country = trim($_POST["country"]);

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($gender) || empty($phone) || empty($lga) || empty($state) || empty($country) || empty($address) || empty($message)|| empty($other_name) || empty($age)) {
        $errors[] = "All fields are required.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password (min 8 characters, at least one uppercase, one lowercase, one number, one special character)
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $errors[] = "Password must have at least 8 characters, one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Validate phone number (must be 10-15 digits)
    if (!preg_match('/^\d{10,15}$/', $phone)) {
        $errors[] = "Phone number must be between 10 to 15 digits.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        $success = "Registration successful!";
    }
}
?>
    <?php if (!empty($errors)): ?>
        <div class="error"><?= implode("<br>", $errors) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        body{
    background: #f8f9fa;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items:center;
    height: 150vh;
}
.container{
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba
(0, 0, 0, 0.1);
    width: 350px;
}
h2{
    text-align: center;
}
.input-group{
    position: relative;
    margin-bottom: 15px;
}
.input-group input, .input-group 
select{
    width: 100%;
    padding: 10px;
    padding-left: 35px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.input-group i{
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
}
.password-toggle{
    position: absolute;
    right: 10px;
    cursor: pointer;
}
button{
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover{
    background-color: darkgreen;
}
        .error { color: red; text-align: center; }
        .success { color: green; text-align: center; }
        button {
            width: 100%;
            padding: 10px;
            background: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
     <form id="registrationForm" action="register.php" method="POST">
         <h2>Register</h2>
         <div class="input-group">
             <label for="first_name">First Name:</label>
             <i class="bx bx-user"></i>
             <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
         </div>
         <div class="input-group">
             <label for="first_name">Last Name:</label>
             <i class="bx bx-user"></i>
             <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
         </div>
         <div class="input-group">
             <label for="first_name">Other Name:</label>
             <i class="bx bx-user"></i>
             <input type="text" name="other_name" id="other_name" placeholder="Other Name"(Optional)>
         </div>
         <div class="input-group">
             <label for="dob">Date of Birth:</label>
             <i class="bx bx-calendar"></i>
             <input type="date" name="dob" id="dob" required>
         </div>
         <div class="input-group">
             <label for="gender">Gender:</label>
             <select name="gender" id="gender" required>
                 <option value="Select Gender"></option>
                 <option value="male">Male</option>
                 <option value="female">female</option>
             </select>
         </div>
         <div class="input-group">
             <label for="first_name">Phone Number:</label>
             <i class="bx bx-phone"></i>
             <input type="text" name="Phone" id="Phone" placeholder="Phone Number" required>
         </div>
         <div class="input-group">
            <label for="password">password:</label>
            <i class="bx bx-lock"></i>
            <input type="password" id="password" name="password" placeholder="password" required>
            <i class="bx bx-show password-toggle"></i>
         </div>
         <div class="input-group">
             <label for="email">Email:</label>
             <i class="bx bx-envelope"></i>
             <input type="mail" name="email" id="email" placeholder="Email" required>
         </div>
         <div class="input-group">
             <label for="address">Home Address:</label>
             <i class="bx bx-home"></i>
             <input type="text" name="address" id="address" placeholder="Home Address" required>
         </div>
         <div class="input-group">
             <label for="lga">L.G.A:</label>
             <i class="bx bx-map"></i>
             <input type="text" name="lga" id="lga" placeholder="LGA" required>
         </div>
         <div class="input-group">
             <label for="State">State of Origin:</label>
             <i class="bx bx-map"></i>
             <input type="text" name="State" id="State" placeholder="State" required>
         </div>
         <div class="input-group">
             <label for="country">Country:</label>
             <i class="bx bx-globe"></i>
             <input type="text" name="country" id="country" placeholder="Country" required>
         </div>
         <div class="input-group">
             <label for="message">Message:</label>
             <i class="bx bx-envelope"></i>
             <input type="text" name="message" id="message" placeholder="message" required>
         </div>
         <button type="submit">Register</button>
         <p id="message"></p>
     </form>
 </div>
</div>

<script>
    document.getElementById("togglePassword").onclick = function () {
        let password = document.getElementById("password");
        password.type = password.type === "password" ? "text" : "password";
    };
</script>

</body>
</html>
