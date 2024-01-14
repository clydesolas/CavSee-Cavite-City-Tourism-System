<?php
require_once '../../config.php';
// Retrieve start and end dates from the AJAX request
$start_date = date('Y-m-d', strtotime($_GET['start_date']));
$end_date = date('Y-m-d', strtotime($_GET['end_date']));

$i=1;
    $qry = $conn->query("SELECT b.*,p.title,concat(u.firstname,' ',u.lastname) as name 
    FROM book_list b inner join `packages` p on p.id = b.package_id 
    inner join users u on u.id = b.user_id
    where b.schedule>= '$start_date' AND b.schedule<='$end_date'  
    order by date(b.date_created) asc ");
    while($row= $qry->fetch_assoc()):
?>
    <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['book_list_id'] ?></td>
        <td><?php echo date("M j, Y h:ia",strtotime($row['date_created'])) ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo date("M j, Y",strtotime($row['schedule'])) ?></td>
        <td class="text-center">
            <?php if($row['status'] == 0): ?>
                <span class="badge badge-warning">Pending</span>
            <?php elseif($row['status'] == 1): ?>
                <span class="badge badge-primary">Confirmed</span>
            <?php elseif($row['status'] == 2): ?>
                <span class="badge badge-danger">Cancelled</span>
            <?php elseif($row['status'] == 3): ?>
                <span class="badge badge-success">Done</span>
            <?php endif; ?>
        </td>
     
    </tr>
<?php endwhile; ?>

