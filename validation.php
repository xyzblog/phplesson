<?php
$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $firstName = sanitizeInput($_POST["first_name"]);
    $lastName = sanitizeInput($_POST["last_name"]);
    $otherName = sanitizeInput($_POST["other_name"]);
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $dob = sanitizeInput($_POST["dob"]);
    $homeAddress = sanitizeInput($_POST["home_address"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $gender = sanitizeInput($_POST["gender"]);
    $phone = sanitizeInput($_POST["phone"]);
    $lga = sanitizeInput($_POST["lga"]);
    $stateOrigin = sanitizeInput($_POST["state_origin"]);
    $country = sanitizeInput($_POST["country"]);
    $message = sanitizeInput($_POST["message"]);

    // Required Fields Validation
    $requiredFields = ["first_name", "last_name", "username", "email", "dob", "home_address", "password", "confirm_password", "gender", "phone", "lga", "state_origin", "country", "message"];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errorMessages[] = ucfirst(str_replace("_", " ", $field)) . " is required.";
        }
    }

    // Email Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email format.";
    }

    // Phone Number Validation
    if (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $errorMessages[] = "Invalid phone number. Must be 10-15 digits.";
    }

    // Password Validation
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W]/', $password)) {
        $errorMessages[] = "Password must be at least 8 characters, include an uppercase, lowercase, number, and special character.";
    }

    // Confirm Password Validation
    if ($password !== $confirmPassword) {
        $errorMessages[] = "Passwords do not match.";
    }

    // Display Success Message if No Errors
    if (empty($errorMessages)) {
        echo "<p class='success'>Form submitted successfully!</p>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vie wport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Validation</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 170vh;
}

.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px gray;
    width: 400px;
}

h2 {
    text-align: center;
    background-color: blue;
    color: #fff;
    padding: 20px;
}

.form-group {
    margin-  bottom: 10px;
}

label {
    display: block;
    font-weight: bold;
}

input, textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}

.error {
    color: red;
    font-size: 14px;
    list-style-type: none;
}

.success {
    color: green;
    font-weight: bold;
    text-align: center  ;
}

    </style>
</head>
<body>

<div class="container">
    <h2>Registration Form</h2>
    <form id="validationForm" action="" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" id="first_name" name="first_name">
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" id="last_name" name="last_name">
        </div>

        <div class="form-group">
            <label>Other Name:</label>
            <input type="text" id="other_name" name="other_name">
        </div>

        <div class="form-group">
            <label>Username:</label>
            <input type="text" id="username" name="username">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" id="dob" name="dob">
        </div>

        <div class="form-group">
        <label>Gender:</label>
        <input type="text" id="gender" name="gender">
       </div>

        <div class="form-group">
            <label>Home Address:</label>
            <input type="text" id="home_address" name="home_address">
        </div>

        <div class="form-group">
            <label>L.G.A:</label>
            <input type="text" id="lga" name="lga">
        </div>

        <div class="form-group">
            <label>State of Origin:</label>
            <input type="text" id="state_origin"name="state_origin">
        </div>

        <div class="form-group">
            <label>Country:</label>
           <input type="text" id="country"name="country">
         </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="text" id="phone" name="phone">
        </div>

        <div class="form-group">
            <label>Message:</label>
            <textarea id="message" name="message"></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>

    <ul id="errorList"></ul>
</div>

<script>
function validateForm() {
    let errors = [];
    let firstName = document.getElementById("first_name").value.trim();
    let lastName = document.getElementById("last_name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;
    let phone = document.getElementById("phone").value.trim();
    
    // Validate Required Fields
    if (firstName === "") errors.push("First Name is required.");
    if (lastName === "") errors.push("Last Name is required.");
    if (email === "") errors.push("Email is required.");
    
    // Email Validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) errors.push("Invalid email format.");

    // Password Validation
    let passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordPattern.test(password)) {
        errors.push("Password must be at least 8 characters, include uppercase, lowercase, number, and special character.");
    }

    if (password !== confirmPassword) errors.push("Passwords do not match.");

    if (errors.length > 0) {
        document.getElementById("errorList").innerHTML = errors.map(e => `<li class='error'>${e}</li>`).join("");
        return false;
    }
    return true;
}

</script> <!-- Link to external JS -->
</body>
</html>
