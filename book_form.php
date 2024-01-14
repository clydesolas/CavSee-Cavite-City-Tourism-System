<div class="container">
    <form action="" id="book-form">
        <?php date_default_timezone_set('Asia/Manila'); ?>
            <input name="package_id" type="hidden" value="<?php echo $_GET['package_id'] ?>" >
            <input type="date" min = "<?php  echo date("Y-m-d"); ?>" class='form form-control p-2' required   name='schedule'>
        
    </form>
</div>
<script>
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_tour",
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
                        alert_toast("Book Request Successfully sent.")
                        $('.modal').modal('hide')
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