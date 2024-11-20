<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$jobs = json_decode(file_get_contents('jobs.json'), true);

$newJob = [
    'jobTitle' => $_POST['jobTitle'],
    'jobDescription' => $_POST['jobDescription'],
    'salary' => $_POST['salary'],
    'location' => $_POST['location'],
    'companyName' => $_POST['companyName'],
    'employerName' => $_POST['employerName'],
    'employerContact' => $_POST['employerContact'],
    'employerEmail' => $_POST['employerEmail'],
    'postedBy' => $_SESSION['email']
];

$jobs[] = $newJob;

file_put_contents('jobs.json', json_encode($jobs));

header("Location: dashboard.php");
exit();