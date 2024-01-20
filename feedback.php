    
</section>
<section class="page-section mt-5">
    <div class="container bg-light pt-2">
    <div class=" d-flex justify-content-between" >
        <div>
        <h4><b>Review Bookings</b></h4>
        </div>
        <div>
        <a href="./?page=edit_account"  class="btn btn-dark" style=""><div class="fa fa-user-cog"></div>Manage Account</a>

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
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php 
   $i = 1;
   $qry = $conn->query("SELECT a.*, b.*, p.title, b.id as bid FROM rate_review a
                        ,book_list b, packages p WHERE a.book_list_id = b.id
                        AND  p.id = b.package_id
                        AND b.user_id = '".$_settings->userdata('id')."' AND b.status = 3
                        ORDER BY date(b.date_created) DESC");
   
   while($row = $qry->fetch_assoc()):
       $existingRating = ($row['rate']) ? $row['rate'] : 0;
   ?>
   
   <tr>
       <td><?php echo $i++ ?></td>
       <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
       <td><?php echo $row['title'] ?></td>
       <td><?php echo date("Y-m-d", strtotime($row['schedule'])) ?></td>
       <td>
           <!-- Display existing rating as stars -->
           <div class="rating">
               <?php for ($j = 1; $j <= 5; $j++): ?>
                   <?php if ($j <= $existingRating): ?>
                       <span class="fa fa-star" style="color: #FFD700;"></span>
                   <?php else: ?>
                       <span class="fa fa-star" style="color: #A0A0A0;"></span>
                   <?php endif; ?>
               <?php endfor; ?>
           </div>
       </td>
       <td align="center">
       <button type="button" class="btn btn-flat btn-default border btn-sm" data-toggle="modal" data-target="#reviewModal_<?php echo $row['id'] ?>">
        <a class="dropdown-item edit_data" style="color: white; background-color: black; border-color: black" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit Review</a>
    </button>
       </td>
   </tr>

   
   <div class="modal fade" id="reviewModal_<?php echo $row['id'] ?>" tabindex="1" role="dialog" aria-labelledby="reviewModalLabel_<?php echo $row['id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel2">Review Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reviewForm_<?php echo $row['id'] ?>">
                <input type="hidden" id="existing_<?php echo $row['id'] ?>" value="<?php echo $existingRating ?>">

                <!-- <input type="hidden" name="user_id" value="<?php  echo $_settings->userdata('id') ?>"> -->
                <input type="hidden" name="package_id" value="<?php echo $row['package_id'] ?>">
                <input type="hidden" name="book_list_id" value="<?php echo $row['bid'] ?>">

                <div class="form-group2 mx-4">
                        <label for="rating"class="control-label">Rating:</label>
                        <!-- Add an input field for the rating with a name attribute -->
                        <input type="hidden" id="rating_<?php echo $row['id'] ?>" name="rate" value="0">
                        <div id="rateYo_<?php echo $row['id'] ?>"></div>
                    </div>
                </div>
                <div class="form-group2 mx-4">
                    <label for="review" class="control-label">Feedback: </label>
                    <textarea name="review" id="review" cols="30" rows="10" class="summernote"><?php echo $row['review'] ?></textarea>
                </div>
                  <script>
                    $(function () {
        $("#rateYo_<?php echo $row['id'] ?>").rateYo({
            rating:  $("#existing_<?php echo $row['id'] ?>").val(), // initial rating
            starWidth: "30px", // width of each star
            normalFill: "#A0A0A0", // color of inactive stars
            ratedFill: "#FFD700", // color of active stars
            onSet: function (rating, rateYoInstance) {
                $("#rating_<?php echo $row['id'] ?>").val(rating);
                console.log("Rated: " + rating);
            }
        });
    });

    $(function(){
        $('#reviewForm_<?php echo $row['id'] ?>').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_review",
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
                        alert_toast("Rate and Review Successfully updated.")
                        setTimeout(() => {
                                location.reload()
                        }, 1500);
                    }else{
                        console.log("ressss"+resp)
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
    
    
   

</script>