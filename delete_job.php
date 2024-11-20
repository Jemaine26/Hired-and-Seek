<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$jobs = json_decode(file_get_contents('jobs.json'), true);
$jobIndex = $_GET['index'];

$jobToDelete = $jobs[$jobIndex];

unset($jobs[$jobIndex]);
file_put_contents('jobs.json', json_encode(array_values($jobs)));

header("Location: your_posted_jobs.php");
exit();