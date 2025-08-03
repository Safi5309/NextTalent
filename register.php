<?php
include 'db.php';

$role = $_POST['role'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$picturePath = null;

//pictures optional 
if ($_FILES['picture']['name']) {
  $targetDir = "uploads/";
  if (!is_dir($targetDir)) mkdir($targetDir);
  $picturePath = $targetDir . time() . '_' . basename($_FILES["picture"]["name"]);
  move_uploaded_file($_FILES["picture"]["tmp_name"], $picturePath);
}

if ($role === "employee") {
  $skill = $_POST['skill'];
  $experience = $_POST['experience'];
  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, picture, skill, experience) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssi", $role, $name, $email, $password, $picturePath, $skill, $experience);
} else {
  $job_type = $_POST['job_type'];
  $salary = $_POST['salary'];
  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, picture, job_type, salary) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssss", $role, $name, $email, $password, $picturePath, $job_type, $salary);
}

if ($stmt->execute()) {
  header("Location: login.html");
} else {
  echo "Error: " . $stmt->error;
}

?>
