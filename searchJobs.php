<?php
require_once 'db.php'; // ✅ YOUR connection file

$searchResults = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);

    $sql = "SELECT joblist.title, users.name AS company_name, joblist.vacancy
            FROM joblist
            JOIN users ON joblist.company_id = users.id
            WHERE joblist.title LIKE '%$title%'";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Job</title>
</head>
<body>
    <h2>Search for a Job</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Enter job title" required>
        <button type="submit">Search</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <h3>Search Results:</h3>
        <?php if (!empty($searchResults)): ?>
            <ul>
                <?php foreach ($searchResults as $job): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job['title']); ?></strong> at 
                        <?php echo htmlspecialchars($job['company_name']); ?> 
                        — Vacancies: <?php echo $job['vacancy']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No jobs found for that title.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
