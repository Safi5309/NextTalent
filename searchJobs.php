<?php
require_once 'db.php'; 

$searchResults = [];
$searched = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $searched = true;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Jobs</title>
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .results {
            margin-top: 20px;
        }

        .job-item {
            background-color: #eef3f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 5px solid #007bff;
        }

        .job-item strong {
            font-size: 17px;
            color: #333;
        }

        .no-results {
            text-align: center;
            color: #777;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Search for a Job</h2>

    <form method="POST">
        <input type="text" name="title" placeholder="Enter job title..." required>
        <button type="submit">Search</button>
    </form>

    <div class="results">
        <?php if ($searched): ?>
            <?php if (!empty($searchResults)): ?>
                <?php foreach ($searchResults as $job): ?>
                    <div class="job-item">
                        <strong><?php echo htmlspecialchars($job['title']); ?></strong><br>
                        Company: <?php echo htmlspecialchars($job['company_name']); ?><br>
                        Vacancies: <?php echo (int)$job['vacancy']; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">No jobs found for that title.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <a class="back-link" href="index.php">← Back to Home</a>
</div>
</body>
</html>
