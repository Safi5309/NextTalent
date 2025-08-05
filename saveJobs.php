<?php
session_start();
include 'db.php';

if (!isset($_SESSION['company_id'])) {
  header("Location: login.html");
  exit();
}

$company_id = $_SESSION['company_id'];

foreach ($_POST['jobs'] as $job) {
  $title = $job['title'];
  $vacancy = $job['vacancy'];

  $stmt = $conn->prepare("INSERT INTO joblist (company_id, title, vacancy) VALUES (?, ?, ?)");
  $stmt->bind_param("isi", $company_id, $title, $vacancy);
  $stmt->execute();
}

echo "Jobs successfully saved. <a href='profile.php'>Go to Profile</a>";
?>
