<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageId = $_POST['package_id'];
    $selectedDate = $_POST['selected_date'];

    // Query to fetch available headcount
    $query = "SELECT p.id, 
    CASE WHEN (p.pax - COALESCE(SUM(bl.book_pax), 0)) >= 0 
         THEN (p.pax - COALESCE(SUM(bl.book_pax), 0)) 
         ELSE 0 
    END AS available_headcount
    FROM packages p
    LEFT JOIN book_list bl ON p.id = bl.package_id AND bl.status = 1 AND bl.schedule = ?
    WHERE p.id = ?
    GROUP BY p.id, p.pax;
    ";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Error in preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param("si", $selectedDate, $packageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die('Error in executing the statement: ' . $stmt->error);
    }

    $row = $result->fetch_assoc();

    $response = array();

    if ($row) {
        $response['status'] = 'success';
        $response['available_headcount'] = $row['available_headcount'];
    } else {
        $response['status'] = 'error';
    }

    echo json_encode($response);
} else {
    // Handle the case when the request method is not POST
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request method'));
}
?>
