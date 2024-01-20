<?php
include '../../config.php'; // Include your database connection file

$rate = "SELECT COUNT(*) as count FROM rate_review";
$rateRes = $conn->query($rate);

$bookingCount = 0;

if ($row = $rateRes->fetch_assoc()) {
    $rateCount = $row['count'];
}

echo json_encode(['count' => $rateCount]);
?>
