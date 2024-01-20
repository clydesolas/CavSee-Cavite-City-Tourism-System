<?php
include '../config.php'; 
if (isset($_SESSION['userdata']['role']) &&  $_SESSION['userdata']['role'] == 'user') {
   
$idd = $_settings->userdata('id');
$bookingCountQuery = "SELECT COUNT(*) as count FROM book_list WHERE status IN (1) AND user_id = '$idd'";
$bookingCountResult = $conn->query($bookingCountQuery);

$bookingCount = 0;

if ($row = $bookingCountResult->fetch_assoc()) {
    $bookingCount = $row['count'];
}

echo json_encode(['count' => $bookingCount]);
} 
?>
