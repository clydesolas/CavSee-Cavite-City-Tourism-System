<?php
require_once '../../config.php';
// Retrieve start and end dates from the AJAX request
$start_date = date('Y-m-d', strtotime($_GET['start_date']));
$end_date = date('Y-m-d', strtotime($_GET['end_date']));

$i=1;
    $qry = $conn->query("SELECT r.*,concat(u.firstname,' ',u.lastname) as name, p.title
     FROM `rate_review` r, `users` u, `packages` p 
     WHERE u.id = r.user_id AND p.id = r.package_id AND date(r.date_created) >= '$start_date' AND date(r.date_created) <= '$end_date' order by r.date_created asc; ");
    while($row= $qry->fetch_assoc()):
        $row['review'] = strip_tags(stripslashes(html_entity_decode($row['review'])));
?>
    <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo date("M j, Y h:ia",strtotime($row['date_created'])) ?></td>
        <td>
            <p class="m-0"><b>User:</b> <?php echo  ucwords($row['name']) ?></p>
            <p class="m-0"><b>Package:</b> <?php echo  ucwords($row['title']) ?></p>
        </td>
        <td><p class="truncate-1 m-0"><?php echo $row['rate'] ?>/5</p></td>
        <td><p class="truncate-1 m-0" title="<?php echo $row['review'] ?>"><?php echo $row['review'] ?></p></td>
        <td align="center">
                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    Action
                <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                </div>
        </td>
    </tr>
<?php endwhile; ?>
