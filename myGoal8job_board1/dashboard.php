<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['fName']; ?>!</h1>
        <button onclick="location.href='add_job.php'">Post a Job</button>
        <button onclick="location.href='your_posted_jobs.php'">View Your Posted Jobs</button>
        <button onclick="location.href='available_jobs.php'">View Available Jobs</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>
</body>

</html>