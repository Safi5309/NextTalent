<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user']['id'];
$company_id = $_POST['company_id'] ?? null;
$job_title = $_POST['job_title'] ?? '';

if ($company_id && $job_title) {
  // Check for duplicate submission (optional)
  $check = $conn->prepare("SELECT * FROM cv_submissions WHERE user_id = ? AND company_id = ? AND job_title = ?");
  $check->bind_param("iis", $user_id, $company_id, $job_title);
  $check->execute();
  $existing = $check->get_result()->fetch_assoc();

  if (!$existing) {
    $stmt = $conn->prepare("INSERT INTO cv_submissions (user_id, company_id, job_title) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $company_id, $job_title);
    $stmt->execute();
    $stmt->close();
  }

  header("Location: job-category.php?title=" . urlencode($job_title));
  exit();
} else {
  echo "Invalid data.";
}
?>
