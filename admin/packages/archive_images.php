<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
	<div class="card-header">
    <div class="btn-group" role="group" >
            <button type="button" class="btn btn-dark  " >
            <a href="./?page=packages/"  class="text-light" style="">  <i class="nav-icon fas fa-map"></i> Packages
            </a>
        </button>
                <button type="button" class="btn btn-dark active disabled">
				<a href="./?page=packages/archive_images"  class="text-light" style=""> <i class="nav-icon fas fa-comment-alt"></i> Image Archive
            </button>
        </div>
		<div class="card-tools">
		<a href="#" class=""></a>
		</div>
	</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <?php
require_once '../config.php';

$qry = $conn->query("SELECT id, title, upload_path FROM `packages`");

if ($qry):
    while ($row = $qry->fetch_assoc()):
?>
<div class="card">
    <div class="card-header">
            <span class="ml-2"><?php echo $row['title']; ?></span></div>

        <div class="d-flex w-100 align-items-center img-item p-4">
            <div class="row">
               

              
            <?php if (isset($row['upload_path']) && is_dir(base_app . $row['upload_path'])): ?>
                <?php
                $files = scandir(base_app . $row['upload_path']);
                foreach ($files as $img):
                    if (in_array($img, array('.', '..'))) {
                        continue;
                    }

                    // Check if the file name contains "archived=true"
                    if (strpos($img, "archived=true") !== false):
                ?>
                 <div class="col-lg-4 mb-4">
                        <div class="d-flex w-100 align-items-center img-item">
                            <span><img src="<?php echo base_url . $row['upload_path'] . '/' . $img ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                            <span class="ml-4"><button class="btn btn-sm btn-default text-secondary rem_img" type="button" data-path="<?php echo base_app . $row['upload_path'] . '/' . $img ?>"><i class="fa fa-archive"></i></button></span>
                        </div>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
                
            <?php endif; ?>
           
            </div>
            </div>
        </div>
<?php
    endwhile;
else:
    echo "Error in SQL query: " . $conn->error;
endif;
?>


<script>
    function displayImg(input,_this) {
        console.log(input.files)
        var fnames = []
        Object.keys(input.files).map(k=>{
            fnames.push(input.files[k].name)
        })
        _this.siblings('.custom-file-label').html(JSON.stringify(fnames))
	    
	}
    function delete_img($path){
        start_loader()
        
        $.ajax({
            url: _base_url_+'classes/Master.php?f=undodelete_p_img',
            data:{path:$path},
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured while deleting an Image","error");
                end_loader()
            },
            success:function(resp){
                $('.modal').modal('hide')
                if(typeof resp =='object' && resp.status == 'success'){
                    $('[data-path="'+$path+'"]').closest('.img-item').hide('slow',function(){
                        $('[data-path="'+$path+'"]').closest('.img-item').remove()
                    })
                    alert_toast("Image Successfully Unarchived","success");
                    location.reload();
                }else{
                    console.log(resp)
                    alert_toast("An error occured while archiving an Image","error");
                }
                end_loader()
            }
        })
    }
	$(document).ready(function(){
		$('.rem_img').click(function(){
            _conf("Are sure to undo archive for this image?",'delete_img',["'"+$(this).attr('data-path')+"'"])
        })
	})
</script>


		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this package permanently?","delete_package",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_package($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_package",
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