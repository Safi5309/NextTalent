<?php
session_start();
require_once 'db.php';

// Allow access only if logged in as a company
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'company') {
    header("Location: index.php");
    exit();
}

// Get all job seekers (employees)
$sql = "SELECT name, email, skill, experience, cv_path FROM users WHERE role = 'employee'";
$result = $conn->query($sql);
$employees = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Seekers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        a.cv-link {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Registered Job Seekers</h2>

    <?php if (!empty($employees)): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Skill</th>
                    <th>Experience</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $emp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($emp['name']); ?></td>
                        <td><?php echo htmlspecialchars($emp['email']); ?></td>
                        <td><?php echo htmlspecialchars($emp['skill']); ?></td>
                        <td><?php echo htmlspecialchars($emp['experience']); ?> yrs</td>
                        <td>
                            <?php if (!empty($emp['cv_path'])): ?>
                                <a href="<?php echo htmlspecialchars($emp['cv_path']); ?>" target="_blank" class="cv-link">View CV</a>
                            <?php else: ?>
                                <span>No CV uploaded</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No job seekers found.</p>
    <?php endif; ?>
</body>
</html>
