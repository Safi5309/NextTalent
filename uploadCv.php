<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user']['id'];

if ($_FILES['cv']['error'] === 0 && $_FILES['cv']['type'] === 'application/pdf') {
  $uploadDir = "uploads/cv/";
  if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

  $filename = $uploadDir . time() . '_' . basename($_FILES["cv"]["name"]);
  move_uploaded_file($_FILES["cv"]["tmp_name"], $filename);

  $stmt = $conn->prepare("UPDATE users SET cv_path = ? WHERE id = ?");
  $stmt->bind_param("si", $filename, $user_id);
  $stmt->execute();
  $stmt->close();

  $_SESSION['user']['cv_path'] = $filename;

  header("Location: profile.php");
  exit();
} else {
  echo "Only PDF files are allowed.";
}
?>
