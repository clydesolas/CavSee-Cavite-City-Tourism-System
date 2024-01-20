<?php
require_once('../../config.php');
require_once 'vendor/phpspreadsheet/autoload.php';
ob_start(); // Start output buffering
if (isset($_POST['excel'])) {
    // Get input values
    // Assuming $_POST['start_date'] and $_POST['end_date'] are still used for date range
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d 23:59:59', strtotime($_POST['end_date']));

    // No need to concatenate the year as it is now handled in the new query

    $sql = "SELECT b.*, p.title, 
    CONCAT(u.firstname, ' ', u.lastname) as name,
    CONCAT(tg.firstname, ' ', tg.lastname) as tourguide_name
    FROM book_list b 
    INNER JOIN `packages` p ON p.id = b.package_id 
    INNER JOIN users u ON u.id = b.user_id 
    LEFT JOIN users tg ON tg.id = b.tourguide_id
    WHERE b.schedule >= '$start_date' AND b.schedule <= '$end_date' 
    ORDER BY DATE(b.date_created) DESC;
    ";
    if (!$sql) {
        die('Error in query: ' . $conn->error);
    }

    $result = $conn->query($sql);

    // Create a new PHPExcel object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add column headers
    $columnHeaders = ['No.', 'ID','Date Created', 'User Name', 'Book Title', 'Schedule', 'Head Count','Visitor Types','Tour Guide Name','Status','Remark'];
    $sheet->fromArray($columnHeaders, NULL, 'A1');
    $headerStyle = $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1');
    $headerStyle->getFont()->setBold(true);
    $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Add data from the new MySQL query result
    $row = 2; // Start from the second row
    $i = 0;
    while ($row_data = $result->fetch_assoc()) {
        $i++;
        $date_created = date("M j, Y h:ia", strtotime($row_data['date_created']));
        $user_name = $row_data['name'];
        $book_title = $row_data['title'];
        $remark = $row_data['remark'];
        $tourguide_name = $row_data['tourguide_name'];
        $book_pax = $row_data['book_pax'];
        $pax_type = $row_data['pax_type'];
        $book_list_id = $row_data['book_list_id'];
        $schedule = date("M j, Y", strtotime($row_data['schedule']));
        $status = getStatusLabel($row_data['status']); // Assuming you have a function to get status label

        $sheet->setCellValue('A' . $row, $i);
        $sheet->setCellValue('B' . $row, $book_list_id);
        $sheet->setCellValue('C' . $row, $date_created);
        $sheet->setCellValue('D' . $row, $user_name);
        $sheet->setCellValue('E' . $row, $book_title);
        $sheet->setCellValue('F' . $row, $schedule);
        $sheet->setCellValue('G' . $row, $book_pax);
        $sheet->setCellValue('H' . $row, $pax_type);
        $sheet->setCellValue('I' . $row, $tourguide_name);
        $sheet->setCellValue('J' . $row, $status);
        $sheet->setCellValue('K' . $row, $remark);

        $row++;
    }

    // Auto-size columns
    $lastColumn = $sheet->getHighestColumn();
    for ($col = 'A'; $col <= $lastColumn; $col++) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Save the Excel file
    $filename = 'book_list_' . date('Y-m-d') . '.xlsx'; // Assuming you want to include today's date in the filename
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($filename);

    // Send headers for file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // Read the file and output to the browser
    readfile($filename);

    // Delete the temporary file
    unlink($filename);

    // Close the MySQL connection
    $conn->close();
}
ob_end_flush(); // Flush output buffer

function getStatusLabel($status) {
    // Assuming you have a function to get the status label based on the status code
    // You can customize this function according to your status labels
    switch ($status) {
        case 0:
            return 'Pending';
        case 1:
            return 'Confirmed';
        case 2:
            return 'Cancelled';
        case 3:
            return 'Done';
        default:
            return '';
    }
}
?>
