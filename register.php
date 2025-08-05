<?php
session_start();
include 'db.php';

$role = $_POST['role'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$picturePath = null;

if ($_FILES['picture']['name']) {
  $targetDir = "uploads/";
  if (!is_dir($targetDir)) mkdir($targetDir);
  $picturePath = $targetDir . time() . '_' . basename($_FILES["picture"]["name"]);
  move_uploaded_file($_FILES["picture"]["tmp_name"], $picturePath);
}

if ($role === "employee") {
  $name = $_POST['name'] ?? '';
  $skill = $_POST['skill'] ?? '';
  $experience = $_POST['experience'] ?? 0;

  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, picture, skill, experience) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $role, $name, $email, $password, $picturePath, $skill, $experience);
  $stmt->execute();
  header("Location: login.html");
} else {
  $company_name = $_POST['company_name'];

  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, picture) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $role, $company_name, $email, $password, $picturePath);
  $stmt->execute();

  $_SESSION['company_id'] = $conn->insert_id;
  header("Location: jobInput.html");
}
?>
