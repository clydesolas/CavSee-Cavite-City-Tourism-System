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
    $sql = "SELECT r.*, CONCAT(u.firstname,' ',u.lastname) as name, p.title 
            FROM `rate_review` r, `users` u, `packages` p 
            WHERE u.id = r.user_id AND p.id = r.package_id 
            AND date(r.date_created) >= '$start_date' AND date(r.date_created) <= '$end_date'
            ORDER BY r.date_created ASC";

    $result = $conn->query($sql);

    // Create a new PHPExcel object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add column headers
    $columnHeaders = ['No.', 'Date Created', 'Full Name', 'Package', 'Rate', 'Review'];
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
        $package_title = $row_data['title'];
        $rate = $row_data['rate'];
        $review = strip_tags(stripslashes(html_entity_decode($row_data['review'])));

        $sheet->setCellValue('A' . $row, $i);
        $sheet->setCellValue('B' . $row, $date_created);
        $sheet->setCellValue('C' . $row, $user_name);
        $sheet->setCellValue('D' . $row, $package_title);
        $sheet->setCellValue('E' . $row, $rate);
        $sheet->setCellValue('F' . $row, $review);

        $row++;
    }

    // Auto-size columns
    $lastColumn = $sheet->getHighestColumn();
    for ($col = 'A'; $col <= $lastColumn; $col++) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Save the Excel file
    $filename = 'rate_review_list_' . date('Y-m-d') . '.xlsx'; // Assuming you want to include today's date in the filename
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
?>
