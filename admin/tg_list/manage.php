<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `packages` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update ": "Create New " ?>Register new Tour guide</h3>
	</div>
	<div class="card-body">
		<form action="" id="tg-form">
			<!-- <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>"> -->
			<div class="form-group">
				<label for="firstname" class="control-label">First name</label>
                <input type="text"  class="form form-control" name="firstname" value="<?php echo isset($firstname) ? $firstname : ""; ?>">
			</div>
            <div class="form-group">
				<label for="lastname" class="control-label">Last name</label>
                <input type="text"  class="form form-control" name="lastname" value="<?php echo isset($lastname) ? $lastname : ""; ?>">
			</div>
            <div class="form-group">
				<label for="email" class="control-label">Email</label>
                <input type="email"  class="form form-control" name="username" value="<?php echo isset($username) ? $username : ""; ?>">
			</div>
            <input type="hidden" name="role" value="tour_guide">
            <div class="card-footer">
		<button class="btn btn-flat btn-primary" type="submit">Submit</button>
		<a class="btn btn-flat btn-default" href="?page=responses">Cancel</a>
	</div>
		</form>
	</div>
	
</div>
<script>
  
		$('#tg-form').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_tg",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log('error:'+err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully registered",'success')
                        location.href = "./?page=tg_list";
                        setTimeout(function(){
                            location.reload();
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                            alert_toast(resp.msg,"error")
                     
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
		})

        
</script>