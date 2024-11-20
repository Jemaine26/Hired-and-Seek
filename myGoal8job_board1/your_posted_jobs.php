<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "user123";
$password = "Bangtan_Sonyeondan";
$dbname = "goal8_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch jobs posted by the current user
$sql = "SELECT * FROM jobs WHERE postedBy = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$jobs = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Posted Jobs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Your Posted Jobs</h1>
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
                <th>Actions</th>
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
                    <td>
                        <button onclick="location.href='edit_job.php?id=<?= $job['id']; ?>'">Edit</button>
                        <form method="post" action="delete_job.php?id=<?= $job['id']; ?>">
                            <input type="submit" class="btn" value="Delete" onclick="return confirm('Are you sure you want to delete this job?')">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button onclick="location.href='dashboard.php'">Back</button>
    </div>
</body>

</html>