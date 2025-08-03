<?php
include 'db.php';

$role = $_POST['role'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($role === "employee") {
  $skill = $_POST['skill'];
  $experience = $_POST['experience'];

  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, skill, experience) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssi", $role, $name, $email, $password, $skill, $experience);

} else if ($role === "company") {
  $job_type = $_POST['job_type'];
  $salary = $_POST['salary'];

  $stmt = $conn->prepare("INSERT INTO users (role, name, email, password, job_type, salary) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $role, $name, $email, $password, $job_type, $salary);
}

if ($stmt->execute()) {
  echo "Registration successful!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
