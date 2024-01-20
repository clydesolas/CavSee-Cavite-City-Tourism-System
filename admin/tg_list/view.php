<?php
include '../../config.php';
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM users where role ='tour_guide' AND id = '{$_GET['id']}' order by firstname asc   ");
    foreach($qry->fetch_assoc() as $k => $v){
        $$k = $v;
    }
}
?>
<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
    #uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>
<div class="modal-header p-0 m-0">
                <h5 class="modal-title" id="reviewModalLabel"><?php echo $firstname.' '.$lastname;?></h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div class="py-4">
<p><b>ID:</b> <?php echo $id ?></p>

<p><b>Name:</b> <?php echo $firstname.' '.$lastname;?></p>
<p><b>Email:</b> <?php echo $username ?></span></p>
<p><b>Date Added:</b> <?php echo date("F d, Y",strtotime($date_added)) ?></p>
<p><b>Status:</b> <?php echo $status ?></span></p>

<form  id="tourguide-status">
    <input type="hidden" name="user_id" value="<?php echo $id ?>">

    <?php 
    if($status == "ACTIVE" || $status == "INACTIVE"){ ?>
        <div class="form-group">
        <label for="" class="control-label">Status</label>
        <select name="status" id="status" class="select custom-select" required>
            <option value="" selected disabled>Select..</option>
            <option value="ACTIVE" <?php echo $status == "ACTIVE" ? "selected" : '' ?>>ACTIVE</option>
            <option value="INACTIVE" <?php echo $status == "INACTIVE" ? "selected" : '' ?>>INACTIVE</option>
        </select>
    </div>
    
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary"  >Update</button>
    <button type="clear" class="btn btn-secondary">Clear</button>
    </div>
    <?php }?>

</form>
</div>


<script>
    $(function(){
        $('#tourguide-status').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_tourguide_status",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        location.reload()
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
      
    })
  

</script>