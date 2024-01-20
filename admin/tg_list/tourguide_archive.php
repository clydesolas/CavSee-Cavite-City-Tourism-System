<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
    
	<div class="card-header">
    <div class="btn-group" role="group" >
            <button type="button" class="btn btn-dark " >
            <a href="./?page=tg_list/"  class="text-light" style="">  <i class="nav-icon fas fa-users"></i>Tour Guide List
            </a>
        </button>
                <button type="button" class="btn btn-dark  active disabled">
                <i class="nav-icon fas fa-comment-alt"></i> Archive
            </button>
        </div>
		<div class="card-tools">
			<a href="?page=tg_list/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
        <table class="table table-stripped text-dark">
            <colgroup>
              
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Added</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT * FROM users where role ='tour_guide' and status = 'ARCHIVED' order by firstname asc ");
                    while($row= $qry->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['firstname']." ".$row['lastname']  ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo date("Y-m-d",strtotime($row['date_added'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 'ACTIVE'): ?>
                                <span class="badge badge-warning">ACTIVE</span>
                            <?php elseif($row['status'] == 'INACTIVE'): ?>
                                <span class="badge badge-primary">INACTIVE</span>
                                <?php   elseif($row['status'] == 'ARCHIVED'): ?>
                                <span class="badge badge-secondary">ARCHIVED</span>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-file text-primary"></span> View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-secondary"></span> Undo Archive</a>
                                </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure you want to undo the archive for this tour guide?","undoarchive_tourguide",[$(this).attr('data-id')])
		})
        $('.view_data').click(function(){
            uni_modal("Booking Information","tg_list/view.php?id="+$(this).attr('data-id'))
        })
		$('.table').dataTable();
	})
	function undoarchive_tourguide($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=undoarchive_tourguide",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>