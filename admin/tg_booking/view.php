<?php
include '../../config.php';
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT b.*, u.username as email, p.title,concat(u.firstname,' ',u.lastname) as name FROM book_list b inner join `packages` p on p.id = b.package_id inner join users u on u.id = b.user_id where b.id = '{$_GET['id']}' ");
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
                <h5 class="modal-title" id="reviewModalLabel">Review Booking</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div class="py-4">
<p><b>ID:</b> <?php echo $book_list_id ?></p>

<p><b>Package:</b> <?php echo $title ?></p>
<p><b>User:</b> <?php echo $name ?></span></p>
<p><b>Head Count:</b> <?php echo $book_pax ?></span></p>
<p><b>Visitor Type/s:</b> <?php echo $pax_type ?></span></p>
<p><b>Email:</b> <?php echo $email ?></span></p>
<p><b>Schedule:</b> <?php echo date("F d, Y",strtotime($schedule)) ?></p>
<p><b>Remark:</b> <?php echo $remark ?></span></p>

</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(function(){
        $('#book-status').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_book_status",
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
    $('#remark-container').hide();
        jQuery(document).ready(function($) {
            $('#status').change(function() {
                console.log( $('#status').val());
                if ($(this).val() == '2') { // Check if the selected value is "Cancelled"
                    $('#remark-container').show();
                    $('#remark').prop('required', true);
                } else {
                    $('#remark-container').hide();
                    $('#remark').prop('required', false);

                }
            });
            $('#close').click(function() {
               location.reload();
            });
});
</script>