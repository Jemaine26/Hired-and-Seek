<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
    $servername = "localhost";
    $username = "user123";  
    $password = "Bangtan_Sonyeondan";  
    $dbname = "goal8_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $checkEmailSql = "SELECT * FROM users WHERE email = ?";
    $stmtCheck = $conn->prepare($checkEmailSql);
    if ($stmtCheck === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmtCheck->bind_param("s", $email);
    if (!$stmtCheck->execute()) {
        die("Error executing statement: " . $stmtCheck->error);
    }
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $error = "Email address already exists. Please use a different email.";
    } else {
        $sql = "INSERT INTO users (fName, lName, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("ssss", $_POST['fName'], $_POST['lName'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));
        if ($stmt->execute()) {
            $_SESSION['email'] = $_POST['email'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error registering user: " . $stmt->error;
        }
    }
    $stmtCheck->close();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="signUp">
        <h1 class="form-title">REGISTER</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fName">First Name</label>
            </div>
            <div class="input-group">
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">----------or----------</p>
        <div class="links">
            <button onclick="location.href='login.php'">Already Have an Account? Click here.</button>
        </div>
    </div>
</body>
</html>