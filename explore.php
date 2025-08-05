<?php
include 'db.php';

$query = "SELECT title, SUM(vacancy) AS total_vacancy FROM joblist GROUP BY title";
$result = $conn->query($query);

$cards = [];

while ($row = $result->fetch_assoc()) {
  $cards[] = [
    'title' => $row['title'],
    'vacancy' => $row['total_vacancy']
  ];
}

header('Content-Type: application/json');
echo json_encode($cards);
?>
