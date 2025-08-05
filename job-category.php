<?php
session_start();
include 'db.php';

$title = $_GET['title'] ?? '';
$user = $_SESSION['user'] ?? null;
$cvUploaded = $user && !empty($user['cv_path']);
$userId = $user['id'] ?? null;

$stmt = $conn->prepare("
  SELECT u.id AS company_id, u.name AS company, j.vacancy
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
<head>
  <title><?php echo htmlspecialchars($title); ?> Jobs</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    .company-card {
      border: 1px solid #ccc;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    .company-card h3 {
      margin: 0 0 5px 0;
    }

    .btn {
      padding: 6px 12px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .btn.disabled {
      background-color: gray;
      cursor: not-allowed;
    }

    .note {
      color: red;
      font-weight: bold;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <h2>Companies offering "<?php echo htmlspecialchars($title); ?>"</h2>

  <?php while ($row = $result->fetch_assoc()): ?>
    <?php
      // Check if CV is already dropped
      $cvDropped = false;
      if ($user) {
          $check = $conn->prepare("SELECT id FROM cv_submissions WHERE user_id = ? AND company_id = ? AND job_title = ?");
          $check->bind_param("iis", $userId, $row['company_id'], $title);
          $check->execute();
          $check->store_result();
          $cvDropped = $check->num_rows > 0;
          $check->close();
      }
    ?>
    <div class="company-card">
      <h3><?php echo htmlspecialchars($row['company']); ?></h3>
      <p>Vacancies: <?php echo (int)$row['vacancy']; ?></p>

      <?php if ($user): ?>
        <?php if ($cvUploaded): ?>
          <?php if ($cvDropped): ?>
            <button class="btn disabled" disabled>CV Dropped</button>
          <?php else: ?>
            <form action="dropCv.php" method="POST" style="display:inline;">
              <input type="hidden" name="company_id" value="<?php echo $row['company_id']; ?>">
              <input type="hidden" name="job_title" value="<?php echo htmlspecialchars($title); ?>">
              <button type="submit" class="btn">Drop CV</button>
            </form>
          <?php endif; ?>
        <?php else: ?>
          <p class="note">You did not upload your CV.</p>
          <a href="cvUpload.php" class="btn">Upload CV Now</a>
        <?php endif; ?>
      <?php else: ?>
        <a href="login.html" class="btn">Login to Drop CV</a>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>

  <a href="index.php" class="back-link">← Back to Home</a>

</body>
</html>
