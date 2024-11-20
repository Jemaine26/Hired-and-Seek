<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['logout_confirm']) && $_POST['logout_confirm'] == 'yes') {
        session_destroy();
        header("Location: index.php");
        exit;
    } else {
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Are you sure you want to logout?</h1>
        <form method="post" action="">
            <input type="hidden" name="logout_confirm" value="yes">
            <input type="submit" class="btn" value="Yes">
        </form>
        <form method="post" action="">
            <input type="hidden" name="logout_confirm" value="no">
            <input type="submit" class="btn" value="No">
        </form>
    </div>
</body>

</html>