<?php
require_once '../../config.php';
// require_once '../../classes/DBConnection.php';

$db = new DBConnection();
$username = $db->getUsername();
$host = $db->getHost();
$database = $db->getDatabase();
$password  = $db->getPassword();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $uploadedFile2 = $_FILES['backupFile']['name'];
        move_uploaded_file($_FILES['backupFile']['tmp_name'], 'backup_restore/'.$uploadedFile2);

        $conditionMet=true;
        $problem=' ';

        set_time_limit(500);
        // Configuration
        $backupFolder = 'backup_restore/';
        $exportFolder = 'backup_restore/';

        $mysql ='C:\wamp64\bin\mysql\mysql5.7.36\bin\mysql.exe';
       
      $uploadedFile = 'backup_restore/'.$uploadedFile2;
       
        if ($uploadedFile) {
            // Extract the backup
            $zip = new ZipArchive();
            if ($zip->open($uploadedFile) === true) {
                
                // Iterate through each file in the archive
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    
                    // Skip the database file
                    if ($filename === 'database_backup.sql') {
                        continue;
                    }
            
                    // Extracting directories
                    $dirname = pathinfo($filename, PATHINFO_DIRNAME);
                    if (!is_dir($dirname)) {
                        mkdir($dirname, 0777, true);
                    }
            
                    // Extracting files
                    if (!is_dir($filename)) {
                        file_put_contents($filename, $zip->getFromName($filename));
                    }
                }
               
                // Extract database
                $exportFile = $exportFolder . 'database_restore.sql';
                file_put_contents($exportFile, $zip->getFromName('database_backup.sql'));

                // Restore database
                $command = "mysql -hlocalhost -uu578342230_cavsee -pcvsuImus1 $database < $exportFile";
                system($command,$return);
                
                if ($return===0) {
                $zip->close();
                unlink($exportFile);
                $activity = 'Recovered';
                    $insertQuery2 = "INSERT into backup_recovery_log (br_name, activity) VALUES (?, ?)";
                    $stmt2 = mysqli_prepare($db->conn, $insertQuery2);
                    mysqli_stmt_bind_param($stmt2, "ss", $uploadedFile2, $activity);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_close($stmt2);
                $conditionMet=true;
                $problem=' ';
                } else {
                
                $conditionMet=false;
                $problem='mysqlcommand';

                }
               
               
        }

        else {
            $conditionMet=false;
                    }      
            
                }
  


        // Send a JSON response
        header('Content-Type: application/json');
        echo json_encode(['conditionMet' => $conditionMet]);
    } else {
        echo 'Error uploading file.';
    }

?>
