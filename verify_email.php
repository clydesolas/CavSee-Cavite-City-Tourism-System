<?php

// Simulating server-side code
require_once('config.php');
require_once  'assets/vendor/phpmailer/src/Exception.php';
require_once  'assets/vendor/phpmailer/src/PHPMailer.php';
require_once  'assets/vendor/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $otp = rand(100000, 999999);
        if ($email) {
           
        
        
        $check = $conn->query("SELECT * FROM `users` where username='{$email}' ")->num_rows;
		if($check > 0){
        echo json_encode(['status' => 'Email already exist', 'message' => 'Email already taken.']);
			exit;
		}
        else{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'clydesolas01@gmail.com'; 
            $mail->Password = 'qjjziqpmioubgtue'; 
            
                // Set the email content
                $mail->setFrom('clydesolas01@gmail.com', 'CavSee');
             $mail->addAddress($email, 'Recipient Name');
             $mail->Subject = 'Verify Email';
             $mail->isHTML(true);
             $mail->Body = '<html>
             <body style="font-family: Arial, sans-serif;">
             <h2> OTP:  <span style="color: #126b23;">'.$otp.'</span></h2>
             </body>
             </html>';
         
              // Send the email
            $mail->send();
            $response = ['status' => 'success', 'message' => 'OTP verification successful', 'otp' => $otp];
            echo json_encode($response);
            exit;
        }}
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Invalid request']);
        exit;
    }
}


?>
