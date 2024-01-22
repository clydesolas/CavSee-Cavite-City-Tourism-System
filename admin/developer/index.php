<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">CavSee Web Developers</h3>
		<!-- <div class="card-tools">
			<a href="?page=packages/manage" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
  
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <img src="../images/developers/v.jpg" alt="" srcset=""  style="width: 100%; height:100%">
                    </div>
                    <div class="card-footer text-dark text-center">
                        <span class="fw-bold"><u>Vincent Cachapero</u></span>
                        <br> Project Manager/ Backend Dev
                        vincent.cachapero@gmail.com
                        09231231212
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                    <div class="card-body">
                        <img src="../images/developers/c.jpg" alt="" srcset=""  style="width: 100%; height:100%">
                    </div>
                    <div class="card-footer text-dark text-center">
                        <span class="fw-bold"><u>Camela Mateo</u></span>
                      <br>  Business Analyst/ Frontend Dev
                        camela.mateo@gmail.com
                        09231231212
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                    <div class="card-body">
                        <img src="../images/developers/m.jpg" alt="" srcset=""  style="width: 100%; height:100%">
                    </div>
                    <div class="card-footer text-dark text-center">
                        <span class="fw-bold"><u>Mohaimen Sultan</u></span>
                        <br> Full Stack Dev
                        mohaimen.sultan@gmail.com
                        09231231212
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                    <div class="card-body">
                        <img src="../images/developers/cb.jpg" alt="" srcset=""  style="width: 100%; height:100%">
                    </div>
                    <div class="card-footer text-dark text-center">
                        <span class="fw-bold"><u>Charles Brian Carreon</u></span>
                        Frontend Dev
                        charles.carreon@gmail.com
                        09231231212
                    </div>
                </div>
            </div>
       
       </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this inquiry permanently?","delete_inquiry",[$(this).attr('data-id')])
		})
        $('.view_data').click(function(){
            uni_modal("Inquiry","inquiries/view.php?id="+$(this).attr('data-id'))
            $(this).closest('tr').find('.status').html('<span class="badge badge-success">Read</span>')
        })
		$('.table').dataTable();
	})
	function delete_inquiry($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_inquiry",
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