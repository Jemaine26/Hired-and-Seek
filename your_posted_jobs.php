<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$jobs = json_decode(file_get_contents('jobs.json'), true);
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
            <?php foreach ($jobs as $index => $job):?>
                <?php if (isset($job['postedBy']) && $job['postedBy'] === $_SESSION['email']):?>
                    <tr>
                        <td><?= $job['jobTitle'];?></td>
                        <td><?= $job['jobDescription'];?></td>
                        <td><?= $job['salary'];?></td>
                        <td><?= $job['location'];?></td>
                        <td><?= $job['companyName'];?></td>
                        <td><?= $job['employerName'];?></td>
                        <td><?= $job['employerContact'];?></td>
                        <td><?= $job['employerEmail'];?></td>
                        <td>
                            <button onclick="location.href='edit_job.php?index=<?= $index;?>'">Edit</button>
                            <form method="post" action="delete_job.php?index=<?= $index;?>">
                                <input type="submit" class="btn" value="Delete" onclick="return confirm('Are you sure you want to delete this job?')">
                            </form>
                        </td>
                    </tr>
                <?php endif;?>
            <?php endforeach;?>
        </table>
        <button onclick="location.href='dashboard.php'">Back</button>
    </div>
</body>

</html>