<?php
require_once '../../config.php';
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';

if (isset($_POST['pdf'])) {
    // Get input values
    $start_date = date('Y-m-d', strtotime($_POST['start_date']));
    $end_date = date('Y-m-d', strtotime($_POST['end_date']));

    $year = date('Y', strtotime($start_date));

    if (date('Y', strtotime($_POST['start_date'])) != date('Y', strtotime($_POST['end_date']))) {
        $year .= '-' . date('Y', strtotime($end_date));
    }

    $sql = "SELECT b.*, p.title, CONCAT(u.firstname, ' ', u.lastname) as name 
            FROM book_list b 
            INNER JOIN `packages` p ON p.id = b.package_id 
            INNER JOIN users u ON u.id = b.user_id WHERE b.schedule>= '$start_date' AND b.schedule<='$end_date' 
            ORDER BY DATE(b.date_created) ASC";

    $result = $conn->query($sql);
  

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {
   //Page header
        public function Header() {
            // Logo
            $this->SetY(5);
            $this->SetFont('helvetica', 'B', 14);
            $title = 'CavSee';
            $header = 'Cavite City Tourism Management System';
            $header2 = 'Booking Report';

            $this->Cell(0, 1, $title, 0, 1, 'C'); // 'C' stands for center alignment
            $this->Cell(0, 1, $header, 0, 1, 'C');
            $this->Cell(0, 14, $header2, 0, 1, 'C');
           

        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $inf = 'Electronic Copy from CavSee';
            $this->Cell(0, 15, $inf, 0, 1, 'R');
        }
        
        

        // Page content
        public function generateBookListTable($result) {
            $html = '<table border="1" style="width:93%;">';
            $html .= '<thead><tr style = "font-weight:bold"><th style="width:35px; ">No.</th><th>ID</th><th>Date Created</th><th style="width:135px">User Name</th><th>Book Title</th><th>Schedule</th><th style="width:100px">Status</th></tr></thead>';
            $html .= '<tbody>';

            $i = 0;
            while ($row_data = $result->fetch_assoc()) {
                $i++;
                $date_created = date("M j, Y h:ia" , strtotime($row_data['date_created']));
                $user_name = $row_data['name'];
                $book_title = $row_data['title'];
                $book_list_id = $row_data['book_list_id'];
                $schedule = date("M j, Y", strtotime($row_data['schedule']));
                $status = getStatusLabel($row_data['status']);

                $html .= '<tr>';
                $html .= '<td style="width:35px; text-align:center">' . $i . '</td>';
                $html .= '<td>' . $book_list_id . '</td>';
                $html .= '<td>' . $date_created . '</td>';
                $html .= '<td style="width:135px">' . $user_name . '</td>';
                $html .= '<td>' . $book_title . '</td>';
                $html .= '<td>' . $schedule . '</td>';
                $html .= '<td style="width:100px">' . $status . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody></table>';

            // Output the HTML table using writeHTML method
            $this->writeHTML($html, true, false, false, false, '');
        }
    }

    // create new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetY(100);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Event Supply Management System');
    $pdf->SetTitle('Supply Office Accreditation');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->AddPage();
    $pdf->SetY(30);

    // Generate the Book List table
    $pdf->generateBookListTable($result);


    //Close and output PDF document
    $pdf->Output('Book_List_' . date('Y-m-d') . '.pdf', 'D');
}

// Add your getStatusLabel function here if it's not already defined
function getStatusLabel($status) {
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
