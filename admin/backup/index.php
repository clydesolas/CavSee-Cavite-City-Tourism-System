<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Backup and Recovery</h3>
		<br>
        <div >
            <div class="d-flex justify-content-center mt-2 mr-2">
            <a
                href="#"
                onclick="sub()"
                title="Back up now"
                class=" btn btn-light rounded-pill px-5">
                <div class="align-items-center mx-2">
                    <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                            </svg>
                        </div>
                    <div >
                        <p class="pb-0 mb-0">Back up now</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="d-flex justify-content-center mt-2 mr-2">
            <form  enctype="multipart/form-data" id="recoveryForm">
                <input type="file"  style="display: none;" name="backupFile" id="backupFile" accept=".zip" onchange="submitForm()" required>
                <button type="button"  class=" btn btn-info  rounded-pill px-5">
                <div class="align-items-center">
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                        </svg>
                        </div>
                    <div >
                        <p class="pb-0 mb-0">Recover data</p>
                    </div>
            </button>
            </form>
            </div>
                       
        </div>

                        <script>
                            function submitForm() {
                                document.getElementById("loadingContainer").style.display = "flex";
                                    document.body.style.overflow = "hidden";
                                
                                    fetch('recover.php', {
                                        method: 'POST',
                                        body: new FormData(document.getElementById('recoveryForm')),
                                        timeout: 300000,
                                    })
                                        .then(response => {
                                        return response.json();
                                    })
                                        .then(data => {
                                            if (data.conditionMet) {
                                                alert('Back up execution is successfully done.');
                                                window.location.reload();
                                            }
                                           else{
                                                alert('Failed');
                                               
                                            }
                                        
                                            document.getElementById("loadingContainer").style.display = "none";
                                        

                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Failed.');

                                            document.getElementById("loadingContainer").style.display = "none";
                                        
                                        });
                            }

                            function sub(){
                               start_loader()
                            fetch('backup/backup_async.php')
                            
                                .then(response => response.json())
                                .then(data => {
                                  
                                    if (data.conditionMet) {
                                        var description = "Back up data successfully!";
                                        alert_toast(description)
                                         end_loader()
                                        // window.location.href = 'backup_download.php?br_name=' + encodeURIComponent(data.br_name);
                                    }
                                    else{
                                        alert_toast("an error occured1",'error')
                                         end_loader()
                                    }
                                    
                                end_loader()
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert_toast("an error occured2",'error')
                                 end_loader()
                                });
                                end_loader()
                        }
                        </script>

	</div>
	<div class="card-body">
        <div class="container-fluid">
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="15">
                <col width="25">
                <col width="20">
                <col width="5">
                <col width="5">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Filename</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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
            </tbody>
        </table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this booking permanently?","delete_booking",[$(this).attr('data-id')])
		})
        $('.view_data').click(function(){
            uni_modal("Booking Information","books/view.php?id="+$(this).attr('data-id'))
        })
		$('.table').dataTable();
	})
	function delete_booking($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_booking",
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