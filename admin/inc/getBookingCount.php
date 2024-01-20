<?php
include '../../config.php'; // Include your database connection file

$bookingCountQuery = "SELECT COUNT(*) as count FROM book_list WHERE status IN (0)";
$bookingCountResult = $conn->query($bookingCountQuery);

$bookingCount = 0;

if ($row = $bookingCountResult->fetch_assoc()) {
    $bookingCount = $row['count'];
}

echo json_encode(['count' => $bookingCount]);
?>
