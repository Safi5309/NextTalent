<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.html");
  exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Profile -NextTalent</title>
  <link rel="stylesheet" href="styles.css" />
  <style>
    :root {
  --primary-color: #6a38c2;
  --primary-color-dark: #6132b4;
  --text-dark: #262626;
  --text-light: #737373;
  --extra-light: #f5f5f5;
  --white: #ffffff;
}

body {
  background-color: var(--extra-light);
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
}

.profile-container {
  max-width: 500px;
  margin: 5rem auto;
  padding: 2rem 1.5rem;
  background-color: var(--white);
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  text-align: center;
}

.profile-container h2 {
  color: var(--primary-color);
  margin-bottom: 1.5rem;
  font-size: 1.8rem;
}

.profile-picture {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 1rem;
  border: 3px solid var(--primary-color);
}

.profile-details {
  text-align: left;
  margin-top: 1.5rem;
}

.profile-details p {
  margin: 0.75rem 0;
  font-size: 1rem;
  color: var(--text-dark);
}

.profile-details strong {
  display: inline-block;
  width: 130px;
  color: var(--text-light);
  font-weight: 500;
}

.profile-actions {
  margin-top: 2rem;
  display: flex;
  justify-content: center;
  gap: 1rem;
}

.home-btn, .logout-btn {
  padding: 0.7rem 1.5rem;
  font-weight: 600;
  border-radius: 5px;
  border: none;
  text-decoration: none;
  cursor: pointer;
  color: white;
  display: inline-block;
  transition: background-color 0.3s ease;
}

.home-btn {
  background-color: #3498db;
}

.home-btn:hover {
  background-color: #217dbb;
}

.logout-btn {
  background-color: crimson;
}

.logout-btn:hover {
  background-color: darkred;
}


  </style>
</head>
<body>
  <div class="profile-container">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>

    <?php if ($user['picture']): ?>
      <img class="profile-picture" src="<?php echo $user['picture']; ?>" alt="Profile Picture">
    <?php else: ?>
      <img class="profile-picture" src="assets/default-profile.png" alt="Default Profile">
    <?php endif; ?>

    <div class="profile-details">
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

      <?php if ($user['role'] === 'employee'): ?>
        <p><strong>Role:</strong> Job Seeker</p>
        <p><strong>Skills:</strong> <?php echo htmlspecialchars($user['skill'] ?: 'N/A'); ?></p>
        <p><strong>Experience:</strong> <?php echo htmlspecialchars($user['experience'] ?: '0'); ?> years</p>
      <?php else: ?>
        <p><strong>Role:</strong> Company</p>
        <p><strong>Job Type:</strong> <?php echo htmlspecialchars($user['job_type'] ?: 'N/A'); ?></p>
        <p><strong>Salary Range:</strong> <?php echo htmlspecialchars($user['salary'] ?: 'N/A'); ?></p>
      <?php endif; ?>
    </div>

    <div class="profile-actions">
  <a href="index.html" class="home-btn">Home</a>
  <form action="logout.php" method="post" style="display: inline;">
    <button type="submit" class="logout-btn">Logout</button>
  </form>
</div>

  </div>
</body>
</html>
