<?php
require_once '../../config.php';
    $i = 1;
    $sql = mysqli_query($conn, "SELECT * FROM backup_recovery_log  ORDER BY date_added DESC") or die(mysqli_error($connection));
    if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_array($sql)) {
        $name = $row['br_name'];
        $date_added =date("F j, Y g:i A", strtotime($row['date_added']));
        $activity = $row['activity'];
    ?>
        <tr>
            <td class="text-center"><?php echo $i++;?></td>
            <td><?php echo  $name; ?></td>
            <td class="text-center"><?php echo $date_added;?></td>
            <td class="text-center"><?php echo $activity;?></td>
        </tr>
    <?php }}?>