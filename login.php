<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signIn'])) {
    $users = json_decode(file_get_contents('users.json'), true);
    foreach ($users as $user) {
        if ($user['email'] == $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['fName'] = $user['fName'];
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Invalid credentials";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" id="signIn">
        <h1 class="form-title">SIGN IN</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>";?>
        <form method="post" action="">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">----------or----------</p>
        <div class="links">
            <button onclick="location.href='register.php'">Don't Have an Account Yet? Click Here.</button>
        </div>
    </div>
</body>

</html>