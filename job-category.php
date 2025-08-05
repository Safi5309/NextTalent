<?php
include 'db.php';
$title = $_GET['title'] ?? '';
$stmt = $conn->prepare("
  SELECT u.name AS company, j.vacancy
  FROM joblist j
  JOIN users u ON j.company_id = u.id
  WHERE j.title = ?
");
$stmt->bind_param("s", $title);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head><title><?php echo htmlspecialchars($title); ?> Jobs</title></head>
<body>
  <h2>Companies offering "<?php echo htmlspecialchars($title); ?>"</h2>
  <ul>
    <?php while ($row = $result->fetch_assoc()): ?>
      <li><strong><?php echo htmlspecialchars($row['company']); ?></strong> — <?php echo (int)$row['vacancy']; ?> vacancies</li>
    <?php endwhile; ?>
  </ul>
  <a href="index.php">← Back</a>
</body>
</html>
