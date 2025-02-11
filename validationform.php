<?php
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $fields = ["first_name", "last_name", "dob", "phone", "address", "lga", "state", "country", "email", "password", "gender"];
    foreach($fields as $field){
        if (empty($_POST[$field])){
            die("Error: All fields are required.");
        }
    }
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Error: Invalid email format.");
    }
    if (!preg_match('/^[0-9]{10,15)$/', $phone)){
    die("Error: Invalid phone number. Must be 10-15 digits");
    }
    if (!preg_match('/^(?=.*[a-z])(?=,.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8.}$6/', $password)){
        die("Error: Password must contain uppercase, lowecase, number, and special character.");
    }
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    require_once "createaccount.php";
    try{
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, other_name, email, phone, password, age, gender, address, lga, state, date_of_birth, country ) VALUES (:first_name, last_name, email, phone, password, )")
    }  
}
?>
<!DOCTYPE html>
<html lang="en">va
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validation form</title>
    <link rel="stylesheet" href="https://cndjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css">
    <style>
        body{
            background: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items:center;
            height: 100vh;
        }
        .container{
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        h2{
            text-align: center;
        }
        .input-group{
            position: relative;
            margin-bottom: 15px;
        }
        .input-group input, .input-group select{
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
                <i class="bx bx-user"></i>
                <input type="text" name="email" id="email" placeholder="Email" required>
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
                <i class="bx bx-user"></i>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
            </div>
            <button type="submit">Register</button>
            <p id="message"></p>
        </form>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        const passwordField = document.getElementById("password");
        const togglePassword = document.querySelector(".password-toggle");
        const form = document.getElementById("registrationForm");
        const message = document.getElementById("message");
        const phoneField = document.getElementById("phone");
        togglePassword.addEventListener("click", function(){
            if(passwordField.type === "password"){
                passwordField.type = "text";
                this.classList.replace("bx-show", "bx-hide");
            }else{
                passwordField.type = "password";
                this.classList.replace("bx-hide", "bx-show");
            }
        })
        form.addEventListener("submit", function (e){
            e.preventDefault();
            const password = passwordField.value;
            const phone = phoneField.value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$*!%*?&])[A-Za-z\d@$!%*?%*?&]{8,}$/;
            const phoneRegex = /^[0-9]{10,15}$/;
            if(!passwordRegex.test(password)){
                message.textContent = "Password must contain uppercase, loercase, number, and special character.";
                return;
            }
                if (!phoneRegex.test(phone)){
                    message.textContent = "Invalid phone number. Must be 10-15 digits.";
                    return; 
            }
            form.submit();
        })
    })
</script>
</html>