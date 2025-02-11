<?php
// Initialize variables
$name = $email = "";
$nameErr = $emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation name
    if (empty($_POST['name'])){
        $nameErr = "Name is required.";
    }else{
        $name = testInput($_POST['name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)){
            $nameErr = "Only letters and spaces are allowed.";
        }
    }
    // Validate email
    if (empty($_POST['email'])){
        $emailErr = "Email is required.";
    }else{
        $email = testInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format.";
        }
    }
}
// function to sanitize input
function testInput($data){
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation Using PHP</title>
    <style>
        .error{color: red}
    </style>
</head>
<body>
    <h2>PHP Form Validation Example</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><span class="error"><?php echo $nameErr; ?></span>
        <br>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><span class="error"><?php echo $emailErr; ?></span>
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>