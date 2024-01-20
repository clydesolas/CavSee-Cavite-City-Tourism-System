<?php
require_once('../config.php');

require_once  '../assets/vendor/phpmailer/src/Exception.php';
require_once  '../assets/vendor/phpmailer/src/PHPMailer.php';
require_once  '../assets/vendor/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	
	function save_package(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		if(empty($id)){
			$sql = "INSERT INTO `packages` set {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		}else{
			$sql = "UPDATE `packages` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			if(isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0){
				if(!is_dir(base_app.'uploads/package_'.$id)){
					mkdir(base_app.'uploads/package_'.$id);
					$data = " `upload_path`= 'uploads/package_{$id}' ";
				}else{
					$data = " `upload_path`= 'uploads/package_{$id}' ";
				}
				$this->conn->query("UPDATE `packages` set {$data} where id = '{$id}' ");
				foreach($_FILES['img']['tmp_name'] as $k =>$v){
					move_uploaded_file($_FILES['img']['tmp_name'][$k],base_app.'uploads/package_'.$id.'/'.$_FILES['img']['name'][$k]);
				}
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"New Package successfully saved.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function save_tg(){
		extract($_POST);
		$data = "";
		function generateTemporaryPassword() {
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		
			$tempPass = "";
		
			for ($i = 0; $i < 8; $i++) {
				$tempPass .= $characters[rand(0, strlen($characters) - 1)];
			}
		
			return $tempPass;
		}
		
		$password = generateTemporaryPassword();
		$_POST['password'] = md5($password);
		foreach($_POST as $k =>$v){
				if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
		}

		$check = $this->conn->query("SELECT * FROM `users` where username='{$username}' ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Email already taken.";
			return json_encode($resp);
			exit;
		}
		$check = $this->conn->query("SELECT * FROM `users` where firstname='{$firstname}' AND lastname='{$lastname}'")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "User already exists.";
			return json_encode($resp);
			exit;
		}
		$mail = new PHPMailer(true);
		$qry = $this->conn->query("SELECT * from `users` where role = 'admin' ");
		while($row = $qry->fetch_assoc()){
			$adminEmail = $row['username'];
		}
		$mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'clydesolas01@gmail.com'; 
            $mail->Password = 'qjjziqpmioubgtue'; 
            
                // Set the email content
            $mail->setFrom('clydesolas01@gmail.com', 'CavSee');
             $mail->addAddress($username, 'Recipient Name');
             $mail->Subject = 'CavSee: Tour Guide Registration';
             $mail->isHTML(true);
             $mail->Body = '<html>
             <body style="font-family: Arial, sans-serif;">
             <h4> Good day! <br> This is your new account as a tour guide for CavSee. Please change your temporary password immediately to secure your account, thank you.
			 .</h4>
			 <ul>
			 <li>Email: '.$_POST["username"].'</li>
			 <li>Temporary Password: '.$password.'</li>
			 </ul>
             </body>
             </html>';
         
              // Send the email
           if($mail->send()){
			$save = $this->conn->query("INSERT INTO `users` set $data ");
			if($save){
				foreach($_POST as $k =>$v){
					$this->settings->set_userdata($k,$v);
				}
				$this->settings->set_userdata('id',$this->conn->insert_id);
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
		   }
		   else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function delete_p_img() {
		extract($_POST);
		
		if (is_file($path)) {
			$newPath = dirname($path) . '/archived=true' . basename($path);
			
			if (rename($path, $newPath)) {
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'rename file failed.';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'rename file failed. File does not exist.';
		}
	
		return json_encode($resp);
	}

	function undodelete_p_img(){
		extract($_POST);
		if(is_file($path)){
			$newPath = str_replace('archived=true', '', $path);
			
			// Check if renaming is successful
			if(rename($path, $newPath)){
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = 'Failed to rename the file.';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = 'File does not exist.';
		}
		return json_encode($resp);
	}
	
	
	function delete_package(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `packages` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			if(is_dir(base_app.'uploads/package_'.$id)){
				$file = scandir(base_app.'uploads/package_'.$id);
				foreach($file as $img){
					if(in_array($img,array('..','.')))
						continue;
					unlink(base_app.'uploads/package_'.$id.'/'.$img);
				}
				rmdir(base_app.'uploads/package_'.$id);
			}
			$this->settings->set_flashdata('success',"Tour Package successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function book_tour(){
		extract($_POST);

		function generateschedule_id() {
			$currentYear = date("Y");
			$lastTwoDigits = substr($currentYear, -2); // Get the last two digits
			$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		
			$schedule_id = $lastTwoDigits;
		
			for ($i = 0; $i < 6; $i++) {
				$schedule_id .= $characters[rand(0, strlen($characters) - 1)];
			}
		
			return $schedule_id;
		}
		
		$schedule_id = 'CV'.generateschedule_id();
	 
		$data = " user_id = '" . $this->settings->userdata('id') . "', book_list_id = '$schedule_id' ";
		foreach ($_POST as $k => $v) {
			$data .= ", `{$k}` = '{$v}' ";
		}

		
		$mail = new PHPMailer(true);
		$qry = $this->conn->query("SELECT * from `users` where role = 'admin' ");
		while($row = $qry->fetch_assoc()){
			$adminEmail = $row['username'];
		}
		$mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'clydesolas01@gmail.com'; 
            $mail->Password = 'qjjziqpmioubgtue'; 
            
                // Set the email content
                $mail->setFrom('clydesolas01@gmail.com', 'CavSee');
             $mail->addAddress($adminEmail, 'Recipient Name');
             $mail->Subject = 'CavSee: Pending schedule';
             $mail->isHTML(true);
             $mail->Body = '<html>
             <body style="font-family: Arial, sans-serif;">
             <h4> Good day admin! <br> You have a new request for book schedule in '.$_POST["schedule"].'. Please review it in the system and approve accordingly. Thank you!</h4>
             </body>
             </html>';
         
              // Send the email
            $mail->send();


		$save = $this->conn->query("INSERT INTO `book_list` set $data");
		if($save){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function cancel_book(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `book_list` set `status` = '{$_POST['status']}' where id ='{$_POST['id']}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Book has been cancelled.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
			return json_encode($resp);
	}

	function update_book_status(){
		extract($_POST);

		$mail = new PHPMailer(true);
		$qry2 = $this->conn->query("SELECT * from `users` where id ='{$user_id}' ");
		while($row = $qry2->fetch_assoc()){
			$userEmail = $row['username'];
		}
		$mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'clydesolas01@gmail.com'; 
            $mail->Password = 'qjjziqpmioubgtue'; 
            
			if($status==1){
				$result = 'confirmed';
			}
			else{
				$result = 'cancelled';
			}
                // Set the email content
            $mail->setFrom('clydesolas01@gmail.com', 'CavSee');
             $mail->addAddress($userEmail, 'Recipient Name');
             $mail->Subject = 'CavSee: Approval';
             $mail->isHTML(true);
             $mail->Body = '<html>
             <body style="font-family: Arial, sans-serif;">
             <h4> Good day! <br> You\'re schedule request for '.$schedule.' has been '.$result.'.</h4>
             </body>
             </html>';
         
              // Send the email
            $mail->send();

		$update = $this->conn->query("UPDATE `book_list` set `status` = '{$status}' where id ='{$id}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Book successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
			return json_encode($resp);
	}

	function update_tourguide_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `users` set `status` = '{$status}' where id ='{$user_id}' ");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Tour guide is now {$status}.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
			return json_encode($resp);
			exit;
	}


	function register(){
		extract($_POST);
		$data = "";
		$_POST['password'] = md5($password);
		foreach($_POST as $k =>$v){
				if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
		}
		$check = $this->conn->query("SELECT * FROM `users` where username='{$username}' ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Email already taken.";
			return json_encode($resp);
			exit;
		}
		
		$save = $this->conn->query("INSERT INTO `users` set $data ");
		if($save){
			foreach($_POST as $k =>$v){
				$this->settings->set_userdata($k,$v);
			}
			$this->settings->set_userdata('id',$this->conn->insert_id);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_account(){
		extract($_POST);
		$data = "";
		if(!empty($password)){
			$_POST['password'] = md5($password);
			if(md5($cpassword) != $this->settings->userdata('password')){
				$resp['status'] = 'failed';
				$resp['msg'] = "Current Password is Incorrect";
				return json_encode($resp);
				exit;
			}

		}
		$check = $this->conn->query("SELECT * FROM `users`  where `username`='{$username}' and `id` != $id ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Email already taken.";
			return json_encode($resp);
			exit;
		}
		foreach($_POST as $k =>$v){
			if($k == 'cpassword' || ($k == 'password' && empty($v)))
				continue;
				if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
		}
		$save = $this->conn->query("UPDATE `users` set $data where id = $id ");
		if($save){
			foreach($_POST as $k =>$v){
				if($k != 'cpassword')
				$this->settings->set_userdata($k,$v);
			}
			
			$this->settings->set_userdata('id',$this->conn->insert_id);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_inquiry(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
				if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
		}
		$save = $this->conn->query("INSERT INTO `inquiry` set $data");
		if($save){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function rate_review(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if($k=='review')
			$v = addslashes(htmlentities($v));
				if(!empty($data)) $data .=",";
					$data .= " `{$k}`='{$v}' ";
		}
		$data .= ", `user_id`='".$this->settings->userdata('id')."' ";

		$save = $this->conn->query("INSERT INTO `rate_review` set $data");
		if($save){
			$resp['status'] = 'success';
			// $this->settings->set_flashdata("success","Rate & Review submitted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_review(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if($k=='review') {
				$v = addslashes(htmlentities($v));
			}
			if(!empty($data)) {
				$data .= ",";
			}
			$data .= " `{$k}`='{$v}' ";
		}
		$data .= ", `user_id`='".$this->settings->userdata('id')."' ";
	
		// Complete the line with the actual value of book_list_id
		// echo "SQL Query: UPDATE `rate_review` set $data where book_list_id = $book_list_id";

		$save = $this->conn->query("UPDATE `rate_review` SET $data WHERE book_list_id = '{$book_list_id}'");
	
		if($save){
			$resp['status'] = 'success';
			// $this->settings->set_flashdata("success","Rate & Review submitted.");
		} else {
			$resp['status'] = 'failed';
			// echo "SQL Query: UPDATE `rate_review` set $data where book_list_id = $book_list_id";
			$resp['error'] = $this->conn->error;
		}
	
		return json_encode($resp);
	}
	
	function delete_inquiry(){
		$del = $this->conn->query("DELETE FROM `inquiry` where id='{$_POST['id']}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success","Inquiry Deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_review(){
		$del = $this->conn->query("DELETE FROM `rate_review` where id='{$_POST['id']}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success","Feedback Deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_booking(){
		$del = $this->conn->query("DELETE FROM `book_list` where id='{$_POST['id']}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success","Booking Deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function archive_tourguide(){
		$del = $this->conn->query("UPDATE `users` set `status` = 'ARCHIVED' where id='{$_POST['id']}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success","A tour guide has been archived.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function undoarchive_tourguide(){
		$del = $this->conn->query("UPDATE `users` set `status` = 'ACTIVE' where id='{$_POST['id']}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata("success","A tour guide has been unarchived.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_package':
		echo $Master->save_package();
	break;
	case 'delete_package':
		echo $Master->delete_package();
	break;
	case 'undoarchive_tourguide':
		echo $Master->undoarchive_tourguide();
	break;
	case 'archive_tourguide':
		echo $Master->archive_tourguide();
	break;
	case 'delete_p_img':
		echo $Master->delete_p_img();
	break;
	case 'undodelete_p_img':
		echo $Master->undodelete_p_img();
	break;
	case 'book_tour':
		echo $Master->book_tour();
	break;
	case 'update_book_status':
		echo $Master->update_book_status();
	break;
	case 'update_tourguide_status':
		echo $Master->update_tourguide_status();
	break;
	case 'register':
		echo $Master->register();
	break;
	case 'update_account':
		echo $Master->update_account();
	break;
	case 'cancel_book':
		echo $Master->cancel_book();
	break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
	break;
	case 'rate_review':
		echo $Master->rate_review();
	break;
	case 'save_tg':
		echo $Master->save_tg();
	break;
	case 'update_review':
		echo $Master->update_review();
	break;
	case 'delete_inquiry':
		echo $Master->delete_inquiry();
	break;
	case 'delete_booking':
		echo $Master->delete_booking();
	break;
	case 'delete_review':
		echo $Master->delete_review();
	break;
	default:
		// echo $sysset->index();
		break;
}