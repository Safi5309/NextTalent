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
    <html>
    <head>
        <title>Upload Your CV</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
            }
            form {
                margin-top: 20px;
            }
            .btn {
                padding: 8px 16px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <h2>Upload Your CV (PDF only)</h2>
        <form action="cvUpload.php<?php echo ($company_id && $job_title) ? '?company_id=' . $company_id . '&job_title=' . urlencode($job_title) : ''; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="cv" accept="application/pdf" required>
            <br><br>
            <button type="submit" class="btn">Upload CV</button>
        </form>
        <br>
        <a href="index.php">← Back to Home</a>
    </body>
    </html>

    <?php
    exit();
}

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
