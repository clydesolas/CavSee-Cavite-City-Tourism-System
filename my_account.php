    
</section>
<section class="page-section mt-5">
    <div class="container bg-light pt-2">
    <div class=" d-flex justify-content-between" >
        <div>
        <h4><b>Booked Packages</b></h4>
        </div>
        <div>
        <a href="./?page=edit_account"  class="btn btn-dark" style=""><div class="fa fa-user-cog"></div>Manage Account</a>

        </div>
    </div><br>
    <div class="table-responsive">
        <table class="table table-stripped text-dark">

            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th><div style="width:100px">Date Created</div></th>
                    <th>Package</th>
                    <th>Schedule</th>
                    <th>Tour Guide</th>
                    <th><div style="width:100px">Head Count</div></th>
                    <th>Visitor Types</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Remark</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                $qry = $conn->query("SELECT b.*, p.title, b.id as bid,
                            concat(u.firstname,' ',u.lastname) as name, 
                            concat(tg.firstname,' ',tg.lastname) as tourguide_name 
                     FROM book_list b 
                     INNER JOIN packages p ON p.id = b.package_id 
                     INNER JOIN users u ON u.id = b.user_id 
                     LEFT JOIN users tg ON tg.id = b.tourguide_id 
                     WHERE b.user_id ='".$_settings->userdata('id')."'");
                     if (!$qry) {
                        die('Error in query: ' . $conn->error);
                    }
                while ($row = $qry->fetch_assoc()):
                    $review_exists = $conn->query("SELECT * FROM `rate_review` where book_list_id = '{$row['bid']}'")->num_rows;
                    $review_button_available = $review_exists;
                ?>
                    <tr>
                        <td>
                            <div style="width:50px">
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
                        </div>
                    </td>
                        <td><?php echo $row['book_list_id'] ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><div style="word-wrap: break-word;width:150px"><?php echo $row['title'] ?></div></td>
                        <td><div style="word-wrap: break-word;width:100px"><?php echo date("Y-m-d",strtotime($row['schedule'])) ?></div></td>
                        <td><div style="word-wrap: break-word;width:150px"><?php echo $row['tourguide_name'] ?></div></td>
                        <td><?php echo $row['book_pax'] ?></td>
                        <td><div style="word-wrap: break-word;width:100px"><?php echo $row['pax_type'] ?></div></td>


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
                        <?php if ($row['status'] == 3 and $review_button_available === 0): ?>
                        <button type="button" class="btn btn-dark border btn-sm" data-toggle="modal" data-target="#reviewModal<?php echo $row['bid'] ?>">
                            <a class="text-decoration-none edit_data" href="javascript:void(0)" data-id="<?php echo $row['bid'] ?>">Review</a>
                       </button>   
                            <?php endif; ?>
                        <?php if ($row['status'] == 0): ?>
                        <button type="button" class="btn btn-danger border btn-sm" data-toggle="modal" data-target="#cancel<?php echo $row['bid'] ?>">
                            <a class="text-decoration-none edit_data" href="javascript:void(0)" data-id="cancel<?php echo $row['bid'] ?>">Cancel</a>
                        </button>
                        <?php endif; ?>
                    </td>
                    <td><div style="word-wrap: break-word;width:300px"><?php echo $row['remark'];?></div></td>
                    </tr>
                    <div class="modal fade" id="reviewModal<?php echo $row['bid'] ?>" tabindex="1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Review <?php echo $row['bid'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="reviewForm<?php echo $row['bid'] ?>">
                                <h1><?php echo $row['schedule'] ?></h1>
                                <h1><?php echo $row['tourguide_name'] ?></h1>
                                <h1><?php echo $row['book_pax'] ?></h1>
                                <h1><?php echo $row['pax_type'] ?></h1>


                                <!-- <input type="hidden" name="user_id" value=""> -->
                                <input type="hidden" name="package_id" value="<?php echo $row['package_id'] ?>">
                                <input type="hidden" name="book_list_id" value="<?php echo $row['bid'] ?>">
                                <div class="form-group2 mx-4">
                                        <label for="rating"class="control-label">Rating:</label>
                                        <!-- Add an input field for the rating with a name attribute -->
                                        <input type="hidden" id="rating<?php echo $row['bid'] ?>" required name="rate" value="0">
                                        <div id="rateYo<?php echo $row['bid'] ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group2 mx-4">
                                    <label for="review" class="control-label">Feedback: </label>
                                    <textarea name="review" id="review" cols="30" rows="10" required class="summernote"></textarea>
                                </div>
                                
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="cancel<?php echo $row['bid'] ?>" tabindex="1" role="dialog" aria-labelledby="cancelModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelModal">Cancel Book ID: <?php echo $row['bid'] ?><?php echo $row['book_list_id'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="cancelForm<?php echo $row['bid'] ?>">
                                    <div class="d-flex text-center">
                                    <input type="hidden" name="status" value="<?php echo $row['status'] ?>">
                                    <input type="hidden" name="id" value="<?php echo $row['bid'] ?>">

                                    <h3 class="">Are sure you want to cancel this booking?</h3>
                                    </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
  <script>


$('#cancelForm<?php echo $row['bid'] ?>').submit(function(e){
    e.preventDefault(); // Prevent the default form submission behavior
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=cancel_book",
        method: "POST",
        data: {id: <?php echo $row['bid'] ?>, status: 2},
        dataType: "json",
        error: err => {
            console.log(err);
            alert_toast("An error occurred", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                alert_toast("Book cancelled successfully", 'success');
                setTimeout(function() {
                    end_loader();
                    $('#reviewModal<?php echo $row['bid'] ?>').modal('hide'); // Close the modal
                    console.log('Before reload');
                    location.reload(); // Reload the page
                }, 1500);
            } else {
                console.log(resp);
                alert_toast("An error occurred", 'error');
            }
            end_loader();
        }
    });
});

$(function () {
        $("#rateYo<?php echo $row['bid'] ?>").rateYo({
            rating: 0, // initial rating
            starWidth: "30px", // width of each star
            normalFill: "#A0A0A0", // color of inactive stars
            ratedFill: "#FFD700", // color of active stars
            onSet: function (rating, rateYoInstance) {
                $("#rating<?php echo $row['bid'] ?>").val(rating);
                console.log("Rated: " + rating);
            }
        });
    });

    $(function(){
        $('#reviewForm<?php echo $row['bid'] ?>').submit(function(e){
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
                        setTimeout(function() {
                            end_loader();
                            $('#reviewModal<?php echo $row['bid'] ?>').modal('hide'); // Close the modal
                            console.log('Before reload');
                            location.reload(); // Reload the page
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
</script>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </div>
</section>

</div>
<!-- Add this in the head section of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
                 
    
    

</script>