<?php
require_once '../../config.php';
// require_once '../../classes/DBConnection.php';

$db = new DBConnection();
$username = $db->getUsername();
$host = $db->getHost();
$database = $db->getDatabase();
$password  = $db->getPassword();


function addFolderToZip($folder, $zip, $base = '') {
    $handle = opendir($folder);

    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path = $folder . '/' . $file;
            $localPath = $base . $file;

            if (is_file($path)) {
                // Encrypt each file individually
              
                $zip->addFile($path, $localPath);
               
            } elseif (is_dir($path)) {
                $zip->addEmptyDir($localPath);
                addFolderToZip($path, $zip, $localPath . '/');
            }
        }
    }
}
set_time_limit(500);
// Configuration
$backupFolder = 'backup_restore/backup/';
$exportFolder = 'backup_restore/';
$additionalFolders = ['../review/'];
$mysqldump ="C:\wamp64\bin\mysql\mysql5.7.36\bin\mysqldump.exe";
$zipPassword = 'sdg;tr45r43gverg54w6356.j.kjk/ikg34cwr23@@css32@r'; 

// Create backup folder if not exists
if (!file_exists($backupFolder)) {
    mkdir($backupFolder, 0755, true);
}

// Export MySQL database
$exportFile = $exportFolder . 'database_backup.sql';
$command = "mysqldump -uu578342230_cavsee -pcvsuImus1 $database --ignore-table=$database.backup_recovery_log > $exportFile";
system($command, $return);

if ($return === 0) {
    $conditionMet=true;
    // Create a zip archive
    $zip = new ZipArchive();
    $br_name = 'backup_' . date('Y-m-d_H-i-s') . '.zip';
    $zipFile = $backupFolder . $br_name;

    if ($zip->open($zipFile, ZipArchive::CREATE) === true) {
        // $zip->setPassword('secret');
        // Add database export
        $zip->addFile($exportFile, 'database_backup.sql');
        // $zip->setEncryptionName('database_backup.sql', ZipArchive::EM_AES_256, '1234');
        // Add additional folders/files to the backup
        foreach ($additionalFolders as $folder) {
            $folder = rtrim($folder, '/') . '/'; 
            addFolderToZip($folder, $zip, $folder);
        }
       
        $zip->close();
    }

    unlink($exportFile);

    $date_added = date('Y-m-d H:i:s');


    $activity = 'Back up ';
    $insertQuery2 = "INSERT into backup_recovery_log (br_name, activity) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($db->conn, $insertQuery2);
    mysqli_stmt_bind_param($stmt2, "ss", $br_name, $activity);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
} else {
    $conditionMet=false;
}

// Send a JSON response
header('Content-Type: application/json');
echo json_encode(['conditionMet' => $conditionMet, 'br_name' => $br_name]);
?>
