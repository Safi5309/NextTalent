<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES['cv'])) {
    $company_id = $_GET['company_id'] ?? '';
    $job_title = $_GET['job_title'] ?? '';
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Upload Your CV</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Segoe UI', sans-serif;
            }

            body {
                background: #f4f7fa;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            .container {
                background: white;
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 450px;
                text-align: center;
            }

            h2 {
                margin-bottom: 20px;
                color: #333;
            }

            input[type="file"] {
                display: block;
                margin: 20px auto;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 6px;
                width: 100%;
            }

            .btn {
                background: #007BFF;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
            }

            .btn:hover {
                background: #0056b3;
            }

            .back-link {
                display: inline-block;
                margin-top: 20px;
                color: #007BFF;
                text-decoration: none;
                font-size: 14px;
            }

            .back-link:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Upload Your CV (PDF Only)</h2>
            <form action="cvUpload.php<?php echo ($company_id && $job_title) ? '?company_id=' . $company_id . '&job_title=' . urlencode($job_title) : ''; ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="cv" accept="application/pdf" required>
                <button type="submit" class="btn">Upload CV</button>
            </form>
            <a href="index.php" class="back-link">← Back to Home</a>
        </div>
    </body>
    </html>

    <?php
    exit();
}

// Handle file upload logic
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

    if (isset($_GET['company_id'], $_GET['job_title'])) {
        $company_id = $_GET['company_id'];
        $job_title = urlencode($_GET['job_title']);
        header("Location: dropCv.php?company_id=$company_id&job_title=$job_title");
    } else {
        header("Location: profile.php");
    }

    exit();
} else {
    echo "Only PDF files are allowed or an error occurred.";
}
