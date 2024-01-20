<?php
include '../../config.php'; // Include your database connection file

$inquiry = "SELECT COUNT(*) as count FROM inquiry";
$inquiryRes = $conn->query($inquiry);

$inquiryCount = 0;

if ($row = $inquiryRes->fetch_assoc()) {
    $inquiryCount = $row['count'];
}

echo json_encode(['count' => $inquiryCount]);
?>
