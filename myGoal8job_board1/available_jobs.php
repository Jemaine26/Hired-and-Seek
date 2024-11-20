<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "user123";
$password = "Bangtan_Sonyeondan";
$dbname = "goal8_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);
$jobs = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Available Jobs</h1>
        <table>
            <tr>
                <th>Job Title</th>
                <th>Description</th>
                <th>Salary</th>
                <th>Location</th>
                <th>Company Name</th>
                <th>Employer Name</th>
                <th>Employer Contact</th>
                <th>Employer Email</th>
            </tr>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?= $job['jobTitle']; ?></td>
                    <td><?= $job['jobDescription']; ?></td>
                    <td><?= $job['salary']; ?></td>
                    <td><?= $job['location']; ?></td>
                    <td><?= $job['companyName']; ?></td>
                    <td><?= $job['employerName']; ?></td>
                    <td><?= $job['employerContact']; ?></td>
                    <td><?= $job['employerEmail']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button onclick="location.href='dashboard.php'">Back</button>
    </div>
</body>

</html>