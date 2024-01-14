<?php
require_once '../../config.php';
// require_once '../../classes/DBConnection.php';
$mysqldump ="C:\wamp64\bin\mysql\mysql5.7.36\bin\mysqldump.exe";
$db = new DBConnection();
$database = $db->getDatabase();
echo $db->getUsername();
$currentPath = __DIR__;
echo "Current Path: $currentPath";
$br_name='test';
$activity = 'Back up ';
$command = "$mysqldump -uu578342230_cvsu_imus -pcvsuImus1 $database --ignore-table=$database.backup_recovery_log > db11.sql";
system($command, $return);

unlink('backup_restore/database_backup.sql');
?>