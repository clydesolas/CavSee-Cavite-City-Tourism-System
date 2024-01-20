<?php
include '../../config.php'; // Include your database connection file
$idd = $_settings->userdata('id');

$bookingCountQuerytg = "SELECT COUNT(*) as count FROM book_list WHERE status IN (1) AND tourguide_id='$idd'";
$bookingCountResulttg = $conn->query($bookingCountQuerytg);

$bookingCounttg = 0;

if ($row = $bookingCountResulttg->fetch_assoc()) {
    $bookingCounttg = $row['count'];
}

echo json_encode(['count' => $bookingCounttg]);
?>
