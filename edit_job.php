<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$jobs = json_decode(file_get_contents('jobs.json'), true);
$jobIndex = $_GET['index'];
$job = $jobs[$jobIndex];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jobs[$jobIndex] = [
        'jobTitle' => $_POST['jobTitle'],
        'jobDescription' => $_POST['jobDescription'],
        'salary' => $_POST['salary'],
        'location' => $_POST['location'],
        'companyName' => $_POST['companyName'],
        'employerName' => $_POST['employerName'],
        'employerContact' => $_POST['employerContact'],
        'employerEmail' => $_POST['employerEmail'],
        'postedBy' => $job['postedBy'],
    ];
    file_put_contents('jobs.json', json_encode($jobs));
    header("Location: your_posted_jobs.php");
    exit();
}
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