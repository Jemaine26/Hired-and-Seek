<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
    $servername = "localhost:3307";
    $username = "root";  
    $password = "nicoldmrls";  
    $dbname = "hire&seek";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate form inputs
    $fName = htmlspecialchars(trim($_POST['fName']));
    $lName = htmlspecialchars(trim($_POST['lName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user_type is set
    if (!isset($_POST['user_type']) || empty(trim($_POST['user_type']))) {
        die("User type is required. Please select a valid user type.");
    }
    $user_type = htmlspecialchars(trim($_POST['user_type']));

    // Check if the email already exists
    $checkEmailSql = "SELECT * FROM users WHERE email = ?";
    $stmtCheck = $conn->prepare($checkEmailSql);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        die("Email address already exists. Please use a different email.");
    } else {
        // Insert new user
        $sql = "INSERT INTO users (fName, lName, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fName, $lName, $email, $passwordHash, $user_type);

        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;
            header("Location: dashboard.php");
            exit();
        } else {
            die("Error registering user: " . $stmt->error);
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
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <div class="container" id="signUp">
        <h1 class="form-title">Register</h1>
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
            <div class="input-group">
                <select name="user_type" id="user_type" required>
                    <option value="Job Seeker">Job Seeker</option>
                    <option value="Employee">Employee</option>
                </select>
                <label for="user_type">User Type</label>
            </div>

            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>

        <p class="or">---------- or ----------</p>
        <div class="links">
            <button onclick="location.href='login.php'" class="btn-secondary">Already have an account? Click here.</button>
        </div>
    </div>
</body>

</html>
