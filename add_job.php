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
    <title>Add Job</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Add a New Job</h1>
        <form method="post" action="process_add_job.php">
            <div class="input-group">
                <input type="text" name="jobTitle" placeholder="Job Title" required>
                <label for="jobTitle">Job Title</label>
            </div>
            <div class="input-group">
                <textarea name="jobDescription" placeholder="Job Description" required></textarea>
                <label for="jobDescription">Job Description</label>
            </div>
            <div class="input-group">
                <input type="text" name="salary" placeholder="Salary" required>
                <label for="salary">Salary</label>
            </div>
            <div class="input-group">
                <input type="text" name="location" placeholder="Location" required>
                <label for="location">Location</label>
            </div>
            <div class="input-group">
                <input type="text" name="companyName" placeholder="Company Name or Shop" required>
                <label for="companyName">Company Name or Shop</label>
            </div>
            <div class="input-group">
                <input type="text" name="employerName" placeholder="Employer Name" required>
                <label for="employerName">Employer Name</label>
            </div>
            <div class="input-group">
                <input type="text" name="employerContact" placeholder="Employer Contact Number" required>
                <label for="employerContact">Employer Contact Number</label>
            </div>
            <div class="input-group">
                <input type="email" name="employerEmail" placeholder="Employer Email" required>
                <label for="employerEmail">Employer Email</label>
            </div>
            <input type="submit" class="btn" value="Post Job">
        </form>
        <button onclick="location.href='dashboard.php'">Back</button>
    </div>
</body>

</html>