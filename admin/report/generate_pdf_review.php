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

    $sql = "SELECT r.*,concat(u.firstname,' ',u.lastname) as name, p.title 
            FROM `rate_review` r, `users` u, `packages` p 
            WHERE u.id = r.user_id AND p.id = r.package_id 
            AND date(r.date_created)>= '$start_date' AND date(r.date_created) <='$end_date'
            ORDER BY r.date_created ASC";

    $result = $conn->query($sql);

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {
        // Page header
        public function Header() {
            // Logo
            $this->SetY(5);
            $this->SetFont('helvetica', 'B', 14);
            $title = 'CavSee';
            $header = 'Cavite City Tourism Management System';
            $header2 = 'Rate & Review Report';

            $this->Cell(0, 1, $title, 0, 1, 'C'); // 'C' stands for center alignment
            $this->Cell(0, 1, $header, 0, 1, 'C');
            $this->Cell(0, 14, $header2, 0, 1, 'C');

        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from the bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $inf = 'Electronic Copy from CavSee';
            $this->Cell(0, 15, $inf, 0, 1, 'R');
        }

        // Page content
        public function generateRateReviewTable($result) {
            $html = '<table border="1" style="width:100%;">';
            $html .= '<thead><tr style="font-weight:bold"><th style="width:35px; ">No.</th><th style="width:140px;">Date Created</th><th>Full Name</th><th>Package</th><th style="width:40px; ">Rate</th><th>Review</th></tr></thead>';
            $html .= '<tbody>';

            $i = 0;
            while ($row_data = $result->fetch_assoc()) {
                $i++;
                $date_created = date("M j, Y h:ia", strtotime($row_data['date_created']));
                $user_name = $row_data['name'];
                $package_title = $row_data['title'];
                $rate = $row_data['rate'];
                $review = strip_tags(stripslashes(html_entity_decode($row_data['review'])));

                $html .= '<tr>';
                $html .= '<td style="width:35px; text-align:center">' . $i . '</td>';
                $html .= '<td  style="width:140px;">' . $date_created . '</td>';
                $html .= '<td>' . $user_name . '</td>';
                $html .= '<td>' . $package_title . '</td>';
                $html .= '<td style="width: 40px; ">' . $rate . '/5</td>';
                $html .= '<td>' . $review . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody></table>';

            // Output the HTML table using the writeHTML method
            $this->writeHTML($html, true, false, false, false, '');
        }
    }

    // Create a new PDF document
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetY(100);
    
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Event Supply Management System');
    $pdf->SetTitle('Rate and Review');

    // Set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // Set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // Add a new page
    $pdf->AddPage();
    $pdf->SetY(30);

    // Generate the Rate and Review table
    $pdf->generateRateReviewTable($result);

    // Close and output the PDF document
    $pdf->Output('Rate_Review_' . date('Y-m-d') . '.pdf', 'D');
}
?>
