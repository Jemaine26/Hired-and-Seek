<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
    $users = json_decode(file_get_contents('users.json'), true);
    $newUser = [
        'fName' => $_POST['fName'],
        'lName' => $_POST['lName'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];
    $users[] = $newUser;
    file_put_contents('users.json', json_encode($users));
    $_SESSION['email'] = $_POST['email'];
    header("Location: dashboard.php");
    exit();
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