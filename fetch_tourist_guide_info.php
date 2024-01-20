<?php
// Include your database connection logic (config.php, database connection code, etc.)
require_once 'config.php';

// Assuming you have a valid database connection in $conn

// Get the package ID and selected date from the POST data
$packageId = $_POST['package_id'];
$selectedDate = $_POST['selected_date'];

// Get the user ID from your session or wherever you store it
// For demonstration purposes, I'm assuming you have a $user_id variable
$user_id = 1; // Replace this with the actual user ID retrieval logic

// Fetch available tourist guides based on the selected date and user ID
$sql = "SELECT u.id, CONCAT(u.firstname, ' ', u.lastname) AS name, 
               CASE WHEN bl.id IS NOT NULL THEN 1 ELSE 0 END AS isBooked
        FROM users u
        LEFT JOIN book_list bl ON u.id = bl.tourguide_id
                               AND bl.schedule = '$selectedDate'
                               AND bl.status = 1
        WHERE u.role = 'tour_guide'
          AND u.status = 'ACTIVE'
        ORDER BY u.firstname ASC";

$result = mysqli_query($conn, $sql);

if ($result) {
    $tourGuides = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $tourGuides[] = $row;
    }

    $response = [
        'status' => 'success',
        'tourGuides' => $tourGuides,
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => mysqli_error($conn),
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
