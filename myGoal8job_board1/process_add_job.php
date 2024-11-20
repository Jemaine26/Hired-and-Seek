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

$sql = "INSERT INTO jobs (jobTitle, jobDescription, salary, location, companyName, employerName, employerContact, employerEmail, postedBy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $_POST['jobTitle'], $_POST['jobDescription'], $_POST['salary'], $_POST['location'], $_POST['companyName'], $_POST['employerName'], $_POST['employerContact'], $_POST['employerEmail'], $_SESSION['email']);
if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>