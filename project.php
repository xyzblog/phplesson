<!--  STEP 1: Set up your development environment. install a local server like XAMPP OR WAMP
  start Apache for php, and MYSQL for database
  use a code editor like VS code, sblime text etc-->
  <!-- Step 2: Create the MYSQL Database and Users Table -->
   <!-- create database -->
  CREATE DATABASE user_management;
  <!-- create Users Table -->
  USE user_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    address TEXT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 <!-- Step 3: Create the Registration Form(HTML, CSS, JS) -->
  <!-- HTML(register.html) -->
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">
</head>
<!-- Add the CSS (styles.css) -->
<style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #f4f4f4;
}

.container {
    width: 300px;
    background: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.input-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    padding: 5px;
}

.input-group i {
    padding: 5px;
}

.input-group input, .input-group select {
    border: none;
    outline: none;
    flex: 1;
    padding: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background: #28a745;
    border: none;
    color: white;
    cursor: pointer;
}

</style>
<body>
    <div class="container">
        <form action="register.php" method="POST" onsubmit="return validateForm()">
            <h2>Register</h2>
            
            <div class="input-group">
                <i class="bx bx-user"></i>
                <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            
            <div class="input-group">
                <i class="bx bx-user"></i>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            
            <div class="input-group">
                <i class="bx bx-calendar"></i>
                <input type="date" name="dob" required>
            </div>

            <div class="input-group">
                <i class="bx bx-map"></i>
                <input type="text" name="address" placeholder="Address" required>
            </div>

            <div class="input-group">
                <i class="bx bx-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="bx bx-phone"></i>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="input-group">
                <i class="bx bx-male-female"></i>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="input-group">
                <i class="bx bx-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="bx bx-show" id="togglePassword"></i>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        // Add the javascript (script.js)
        document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.classList.replace("bx-show", "bx-hide");
    } else {
        passwordField.type = "password";
        this.classList.replace("bx-hide", "bx-show");
    }
});

    </script>
</body>
</html>
 <!-- Step 4: Process Registration (register.php) -->
 <?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, email, phone, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $dob, $address, $email, $phone, $gender, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!-- Database Connection (config.php) -->
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'user_management');
?>
<!-- NEXT STEPS: 
 1. login system (Login Form, Validation, PHP processing) 
 2. Dashboard (View, Edit, Delete users)
 3. Media queries for responsive design-->
<!-- Step 5. Validate input fields(Javascript and php) 
 Now we will validate phone numbers, email, and password both on the frontend(javascript) and backend(PHP)-->
 <!-- Updated Javascript Validation(script.js) -->
 function validateForm() {
    let firstName = document.forms["registerForm"]["first_name"].value.trim();
    let lastName = document.forms["registerForm"]["last_name"].value.trim();
    let dob = document.forms["registerForm"]["dob"].value.trim();
    let address = document.forms["registerForm"]["address"].value.trim();
    let email = document.forms["registerForm"]["email"].value.trim();
    let phone = document.forms["registerForm"]["phone"].value.trim();
    let gender = document.forms["registerForm"]["gender"].value.trim();
    let password = document.forms["registerForm"]["password"].value.trim();

    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    let phonePattern = /^[0-9]{10,15}$/;
    let passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (firstName === "" || lastName === "" || dob === "" || address === "" || email === "" || phone === "" || gender === "" || password === "") {
        alert("All fields are required!");
        return false;
    }

    if (!emailPattern.test(email)) {
        alert("Invalid email format!");
        return false;
    }

    if (!phonePattern.test(phone)) {
        alert("Phone number must be 10-15 digits!");
        return false;
    }

    if (!passwordPattern.test(password)) {
        alert("Password must contain at least 8 characters, 1 uppercase, 1 lowercase, 1 digit, and 1 special character!");
        return false;
    }

    return true;
}
<!-- Updates PHP Validation (register.php) -->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);

    // Regular expressions for validation
    $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $phonePattern = "/^[0-9]{10,15}$/";
    $passwordPattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    // Server-side validation
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($address) || empty($email) || empty($phone) || empty($gender) || empty($password)) {
        die("All fields are required!");
    }

    if (!preg_match($emailPattern, $email)) {
        die("Invalid email format!");
    }

    if (!preg_match($phonePattern, $phone)) {
        die("Invalid phone number! It must be between 10-15 digits.");
    }

    if (!preg_match($passwordPattern, $password)) {
        die("Invalid password! It must contain at least 8 characters, 1 uppercase, 1 lowercase, 1 digit, and 1 special character.");
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, email, phone, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $dob, $address, $email, $phone, $gender, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!-- Step 6: Create the Login System(In this case, users will login using their email and password) 
 HTML (login.html)-->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h2>Login</h2>
            
            <div class="input-group">
                <i class="bx bx-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="bx bx-lock"></i>
                <input type="password" name="password" id="login-password" placeholder="Password" required>
                <i class="bx bx-show" id="toggleLoginPassword"></i>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        document.getElementById("toggleLoginPassword").addEventListener("click", function() {
            let passwordField = document.getElementById("login-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.classList.replace("bx-show", "bx-hide");
            } else {
                passwordField.type = "password";
                this.classList.replace("bx-hide", "bx-show");
            }
        });
    </script>
</body>
</html>

<!-- PHP(login.php) -->
<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        die("Email and Password are required!");
    }

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Step 7: Build the users Dashboard(View, Edit, Delete users)
 the dashboard will display all registered users and allow editing or deleting records
 
 Dashboard UI(dashboard.php)-->
 <?php
require 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, first_name, last_name, email, phone, gender FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>User Dashboard</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["first_name"]; ?></td>
            <td><?php echo $row["last_name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["phone"]; ?></td>
            <td><?php echo $row["gender"]; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>


<!-- step 7: Edit Usre Data(edit.php) -->
<?php
require 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', gender='$gender' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Update failed!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
        <select name="gender">
            <option value="Male" <?php if ($user['gender'] == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($user['gender'] == "Female") echo "selected"; ?>>Female</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<!-- step 7: Delete User Data (delete.php) -->
<?php
require 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['id'])) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    $conn->close();
    header("Location: dashboard.php");
}
?>
<!-- step 7: Logout (logout.php) -->
<?php
session_start();
session_destroy();
header("Location: login.html");
exit();
?>

<!-- Step 8: Implement Media Queries (styles.css)-->
@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    table {
        width: 100%;
        display: block;
        overflow-x: auto;
    }
    .input-group {
        display: block;
    }
}


<!-- Step 9: Secure Dashboard With Session Authentication
 This is used to restrict access to dashboard.php, edit.php, and delete.php by checking for an active sessoion -->
 session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

<!-- Next Steps: 
 1. profile picture upload(Allow users to upload and update profile picture)
 2. Forgot password functionality(password reset via email)
 3. Email verification system(Confirm user registration via email)
 4. Optimization(Improve website security, performance, and user experience)-->
 <!-- STEP 1: ADDING PROFILE PICTURE UPLOAD DURING REGISTRATION: This will allow users to upload a profile picture during registration, store it in a folder, and save the file path in the database -->
  <!-- MODIFY REGISTRATION FORM (register.html) -->
  <form name="registerForm" action="register.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <!-- Other input fields -->
    
    <div class="input-group">
        <label>Profile Picture</label>
        <input type="file" name="profile_picture" accept="image/*" required>
    </div>
    
    <button type="submit">Register</button>
</form>

<!-- 2: Update php to handle file upload (register.php) by modifying the registration script to handle profile picture -->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);

    // Validate profile picture
    $profile_picture = $_FILES['profile_picture'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profile_picture["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allowed file types
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG, & GIF files are allowed.");
    }

    // Check file size (limit to 2MB)
    if ($profile_picture["size"] > 2 * 1024 * 1024) {
        die("File is too large. Maximum size is 2MB.");
    }

    // Move file to the uploads directory
    if (!move_uploaded_file($profile_picture["tmp_name"], $target_file)) {
        die("Failed to upload file.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, email, phone, gender, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $first_name, $last_name, $dob, $address, $email, $phone, $gender, $hashed_password, $target_file);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!-- 3: Update Database Table (Modify the user table to include a profie_picture) -->
ALTER TABLE users ADD COLUMN profile_picture VARCHAR(255) NOT NULL;

<!-- 4: Display Profile Picture on Dashboard (dashboard.php) update the dashboard to show the users profile picture -->
<table border="1">
    <tr>
        <th>Profile Picture</th>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><img src="<?php echo $row['profile_picture']; ?>" width="50" height="50"></td>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["first_name"]; ?></td>
        <td><?php echo $row["last_name"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["phone"]; ?></td>
        <td><?php echo $row["gender"]; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>


<!-- 5: Allow users to update profile picture(Modify edit.php to allow uers to update their profile picture)
 [update edit form (edit.php)] -->
 <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
    
    <label>Update Profile Picture</label>
    <input type="file" name="profile_picture" accept="image/*">
    
    <button type="submit">Update</button>
</form>

<!-- Handle profile picture update (edit.php) -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Handle profile picture update
    if (!empty($_FILES["profile_picture"]["name"])) {
        $profile_picture = $_FILES['profile_picture'];
        $target_file = "uploads/" . basename($profile_picture["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"]) && $profile_picture["size"] <= 2 * 1024 * 1024) {
            move_uploaded_file($profile_picture["tmp_name"], $target_file);
            $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', profile_picture='$target_file' WHERE id=$id";
        } else {
            die("Invalid image format or size.");
        }
    } else {
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE id=$id";
    }

    if ($conn->query($sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Update failed!";
    }
}
?>
<!-- Next Steps
Forgot Password Functionality (Users reset their password via email).
Email Verification System (Users confirm email after registration).
Website Optimization (Performance, security, and UI improvements). -->

<!-- step 2: Implement Forgot Password Feature(This feature allows users to reset their password via email.
) 1. Create the Forgot Password Form (forgot_password.html)
Users will enter their email to receive a reset link. -->

<form action="forgot_password.php" method="POST">
    <label>Email Address</label>
    <input type="email" name="email" required>
    <button type="submit">Reset Password</button>
</form>

<!--2. Handle Forgot Password Request (forgot_password.php)
This script generates a password reset link and sends it to the user's emai  -->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store reset token in database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        // Send email with reset link
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n$reset_link";
        $headers = "From: no-reply@yourwebsite.com";

        mail($email, $subject, $message, $headers);
        echo "Password reset link has been sent to your email.";
    } else {
        echo "Email not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- 3. Create Reset Password Form (reset_password.php)
Users will enter a new password. -->
<?php
require 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Verify token and expiration
    $stmt = $conn->prepare("SELECT email FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($email);
        $stmt->fetch();
    } else {
        die("Invalid or expired token.");
    }
} else {
    die("Token missing.");
}
?>

<form action="update_password.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <label>New Password</label>
    <input type="password" name="password" required>
    <button type="submit">Update Password</button>
</form>

<!--4. Update Password in Database (update_password.php)
  -->
  <?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update password and clear reset token
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);

    if ($stmt->execute()) {
        echo "Password updated successfully. <a href='login.html'>Login</a>";
    } else {
        echo "Error updating password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- 5. Update Users Table
Modify the users table to store the reset token and expiration. -->
ALTER TABLE users ADD COLUMN reset_token VARCHAR(64) NULL, ADD COLUMN reset_expires DATETIME NULL;

<!-- How It Works
User requests password reset → enters their email.
Server verifies email → generates a secure reset link.
User receives reset link via email → clicks the link.
User enters a new password → password is updated.
 -->


 <!-- Step 3: Implement Email Verification System
This feature ensures users confirm their email before logging in.

 1. Modify Registration to Send Verification Email (register.php)
Update the registration script to generate a verification token.-->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $dob = trim($_POST['dob']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $profile_picture = "default.jpg"; // Placeholder if not uploaded
    $verification_token = bin2hex(random_bytes(32));

    // Store user data with unverified status
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, dob, address, email, phone, gender, password, profile_picture, verification_token, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssssssss", $first_name, $last_name, $dob, $address, $email, $phone, $gender, $password, $profile_picture, $verification_token);

    if ($stmt->execute()) {
        // Send verification email
        $verify_link = "http://yourwebsite.com/verify.php?token=$verification_token";
        $subject = "Email Verification";
        $message = "Click the link below to verify your email:\n$verify_link";
        $headers = "From: no-reply@yourwebsite.com";

        mail($email, $subject, $message, $headers);
        echo "Registration successful! Check your email to verify your account.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- 2. Create the Verification Script (verify.php)
Handles email confirmation. -->
<?php
require 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Check if token exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE verification_token = ? AND is_verified = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Verify user
        $stmt = $conn->prepare("UPDATE users SET is_verified = 1, verification_token = NULL WHERE verification_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        echo "Email verified! You can now <a href='login.html'>login</a>.";
    } else {
        echo "Invalid or already verified token.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No token provided.";
}
// Checks if the token exists and is not verified.
// Marks the user as verified.

?>

<!-- 3. Restrict Login for Unverified Users (login.php)
Modify login to allow only verified users. -->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Check credentials
    $stmt = $conn->prepare("SELECT id, password, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $is_verified);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        if ($is_verified) {
            session_start();
            $_SESSION["user_id"] = $id;
            header("Location: dashboard.php");
        } else {
            echo "Please verify your email before logging in.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
// Prevents unverified users from logging in.
?>

<!--3. Restrict Login for Unverified Users (login.php)
Modify login to allow only verified users.  -->
<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    // Check credentials
    $stmt = $conn->prepare("SELECT id, password, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $is_verified);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        if ($is_verified) {
            session_start();
            $_SESSION["user_id"] = $id;
            header("Location: dashboard.php");
        } else {
            echo "Please verify your email before logging in.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
// Prevents unverified users from logging in.
?>

<!-- 4. Update Database Table
Modify the users table to include verification fields. -->
ALTER TABLE users ADD COLUMN verification_token VARCHAR(64) NULL, ADD COLUMN is_verified TINYINT(1) DEFAULT 0;
<!-- How It Works
User registers → gets a verification email.
User clicks the link → email is verified.
User logs in → only verified users can access the dashboard. -->


<!-- Step 4: Website Optimization (Security & Performance Enhancements)
To ensure your website runs efficiently and securely, we'll implement key optimizations.

 -->

 <!-- 1. Security Enhancements
a. Secure Password Hashing
You’re already using password_hash() for secure storage. Ensure password_verify() is used for authentication.

b. Input Validation & Sanitization
Prevent SQL injection and XSS attacks by validating and sanitizing user input.

Example: Validate & Sanitize Input in Registration (register.php) -->
<?php
function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$first_name = clean_input($_POST['first_name']);
$last_name = clean_input($_POST['last_name']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$phone = preg_replace("/[^0-9]/", "", $_POST['phone']); // Remove non-numeric characters
$password = $_POST['password'];

if (!$email || strlen($phone) < 10) {
    die("Invalid email or phone number.");
}
?>

<!-- c. Prevent SQL Injection (Using Prepared Statements)
Use prepared statements instead of direct SQL queries.

 Good Example (Using Prepared Statement)-->
 $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

<!-- d. Prevent Cross-Site Scripting (XSS)
Escape output before displaying user-generated content. -->
echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');

<!-- e. Session Security
Regenerate session ID on login:
 -->
 session_regenerate_id(true);

 <!-- Use HTTP-Only & Secure Cookies: -->

session_set_cookie_params(['httponly' => true, 'secure' => true]);








