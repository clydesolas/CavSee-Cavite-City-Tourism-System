    
</section>
<section class="page-section mt-5">
    <div class="container bg-light pt-2">
    <div class=" d-flex justify-content-between" >
        <div>
        <h4><b>Booked Packages</b></h4>
        </div>
        <div>
        <a href="./home.php?page=edit_account"  class="btn btn-dark" style=""><div class="fa fa-user-cog"></div>Manage Account</a>

        </div>
    </div><br>
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="25">
                <col width="25">
                <col width="15">
                <col width="10">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Package</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                $qry = $conn->query("SELECT b.*,p.title, b.id as bid FROM book_list b, packages p WHERE p.id = b.package_id AND b.user_id ='".$_settings->userdata('id')."'");
                while ($row = $qry->fetch_assoc()):
                    $review_exists = $conn->query("SELECT * FROM `rate_review` where book_list_id = '{$row['bid']}'")->num_rows;
                    $review_button_available = $review_exists;
                ?>
                    <tr>
                        <td>
                        <?php if($row['status'] == 0): ?>
                              <span class="badge badge-pill badge-danger rounded-circle text-danger m-1 p-1 py-0" style=" ">.</span>   

                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-pill badge-danger rounded-circle text-danger m-1 p-1 py-0" style=" ">.</span>   

                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-pill badge-secondary rounded-circle text-secondary m-1 p-1 py-0" style=" ">.</span>   

                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-pill badge-secondary rounded-circle text-secondary m-1 p-1 py-0" style=" ">.</span>   

                            <?php endif; ?>
                        <?php echo $i++ ?>
                    </td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("Y-m-d",strtotime($row['schedule'])) ?></td>
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
                        <td align="center">
                        <?php if ($row['status'] == 3 && $review_button_available <=0 ): ?>
                        <button type="button" class="btn btn-flat btn-default border btn-sm" data-toggle="modal" data-target="#reviewModal">
                            <a class="dropdown-item edit_data" style="color: white; background-color: black; border-color: black" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Review</a>
<!--                          
                                <a class="submit_review" href="javascript:void(0)" data-id="<?php echo $row['package_id'] ?>">Submit Review</a> -->
                            <?php endif; ?>
                        </button>
                    </td>
                    </tr>
                    <div class="modal fade" id="reviewModal" tabindex="1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Review Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">

                <!-- <input type="hidden" name="user_id" value="<?php  echo $_settings->userdata('id') ?>"> -->
                <input type="hidden" name="package_id" value="<?php echo $row['package_id'] ?>">
                <input type="hidden" name="book_list_id" value="<?php echo $row['bid'] ?>">
                <div class="form-group2 mx-4">
                        <label for="rating"class="control-label">Rating:</label>
                        <!-- Add an input field for the rating with a name attribute -->
                        <input type="hidden" id="rating" name="rate" value="0">
                        <div id="rateYo"></div>
                    </div>
                </div>
                <div class="form-group2 mx-4">
                    <label for="review" class="control-label">Feedback: </label>
                    <textarea name="review" id="review" cols="30" rows="10" class="summernote"></textarea>
                </div>
                  
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</section>

</div>
<!-- Add this in the head section of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    
    $(function () {
        $("#rateYo").rateYo({
            rating: 0, // initial rating
            starWidth: "30px", // width of each star
            normalFill: "#A0A0A0", // color of inactive stars
            ratedFill: "#FFD700", // color of active stars
            onSet: function (rating, rateYoInstance) {
                $("#rating").val(rating);
                console.log("Rated: " + rating);
            }
        });
    });

    $(function(){
        $('#reviewForm').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=rate_review",
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
                        alert_toast("Rate and Review Successfully submitted.")
                        setTimeout(() => {
                            end_loader()
                        }, 1500);
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    end_loader()
                    }
                }
            })
        })
        $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
    })



    function cancel_book($id){
        start_loader()
        $.ajax({
            url:_base_url_+"classes/Master.php?f=update_book_status",
            method:"POST",
            data:{id:$id,status:2},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("an error occured",'error')
                end_loader()
            },
            success:function(resp){
                if(typeof resp == 'object' && resp.status == 'success'){
                    alert_toast("Book cancelled successfully",'success')
                    setTimeout(function(){
                        location.reload()
                    },2000)
                }else{
                    console.log(resp)
                    alert_toast("an error occured",'error')
                }
                end_loader()
            }
        })
    }
    $(function(){
        $('.cancel_data').click(function(){
            _conf("Are you sure to cancel this booking?","cancel_book",[$(this).data('id')])
        })
        $('.submit_review').click(function(){
            uni_modal("Rate & Feedback","./rate_review.php?id="+$(this).data('id'),'mid-large')
        })
        $('table').dataTable();
    })
</script>