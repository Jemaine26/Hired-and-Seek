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

$jobId = $_GET['id'];

$sql = "SELECT * FROM jobs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobId);
$stmt->execute();
$result = $stmt->get_result();
$job = $result->fetch_assoc();

if (!$job) {
    header("Location: your_posted_jobs.php");
    exit();
}

if ($job['postedBy'] !== $_SESSION['email']) {
    header("Location: your_posted_jobs.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE jobs SET jobTitle = ?, jobDescription = ?, salary = ?, location = ?, companyName = ?, employerName = ?, employerContact = ?, employerEmail = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $_POST['jobTitle'], $_POST['jobDescription'], $_POST['salary'], $_POST['location'], $_POST['companyName'], $_POST['employerName'], $_POST['employerContact'], $_POST['employerEmail'], $jobId);
    if ($stmt->execute()) {
        header("Location: your_posted_jobs.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Job</h1>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="jobTitle" value="<?= $job['jobTitle'];?>" required>
                <label for="jobTitle">Job Title</label>
            </div>
            <div class="input-group">
                <textarea name="jobDescription" required><?= $job['jobDescription'];?></textarea>
                <label for="jobDescription">Job Description</label>
            </div>
            <div class="input-group">
                <input type="text" name="salary" value="<?= $job['salary'];?>" required>
                <label for="salary">Salary</label>
            </div>
            <div class="input-group">
                <input type="text" name="location" value="<?= $job['location'];?>" required>
                <label for="location">Location</label>
            </div>
            <div class="input-group">
                <input type="text" name="companyName" value="<?= $job['companyName'];?>" required>
                <label for="companyName">Company Name or Shop</label>
            </div>
            <div class="input-group">
                <input type="text" name="employerName" value="<?= $job['employerName'];?>" required>
                <label for="employerName">Employer Name</label>
            </div>
            <div class="input-group">
                <input type="text" name="employerContact" value="<?= $job['employerContact'];?>" required>
                <label for="employerContact">Employer Contact Number</label>
            </div>
            <div class="input-group">
                <input type="email" name="employerEmail" value="<?= $job['employerEmail'];?>" required>
                <label for="employerEmail">Employer Email</label>
            </div>
            <input type="submit" class="btn" value="Update Job">
        </form>
        <button onclick="location.href='your_posted_jobs.php'">Back</button>
    </div>
</body>

</html>