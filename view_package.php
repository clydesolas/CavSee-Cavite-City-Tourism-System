<?php 
if(isset($_GET['id'])){
    $packages = $conn->query("SELECT * FROM `packages` where md5(id) = '{$_GET['id']}'");
    if($packages->num_rows > 0){
        foreach($packages->fetch_assoc() as $k => $v){
            $$k = $v;
        }
    }
$review = $conn->query("SELECT r.*,concat(firstname,' ',lastname) as name FROM `rate_review` r inner join users u on r.user_id = u.id where r.package_id='{$id}' order by unix_timestamp(r.date_created) desc ");
$review_count =$review->num_rows;
$rate = 0;
$feed = array();
while($row= $review->fetch_assoc()){
    $rate += $row['rate'];
    if(!empty($row['review'])){
        $row['review'] = stripslashes(html_entity_decode($row['review']));
        $feed[] = $row;
    }
}
$average_rating = ($review_count > 0) ? number_format($rate / $review_count, 1) : 0;

if(is_dir(base_app.'uploads/package_'.$id)){
    $ofile = scandir(base_app.'uploads/package_'.$id);
    foreach($ofile as $img){
        if(in_array($img,array('.','..')))
        continue;
        $files[] = validate_image('uploads/package_'.$id.'/'.$img);
    }
}
}
?>
<section class="page-section ">
    <div class="container bg-light mt-3 pt-3"  style="line-height: 1px !important;">
        <div class="row">
            <div class="col-md-5">
                <div id="tourCarousel"  class="carousel slide" data-ride="carousel" data-interval="3000">
                    <div class="carousel-inner h-100">
                        <?php foreach($files as $k => $img): ?>
                        <div class="carousel-item  h-100 <?php echo $k == 0? 'active': '' ?>">
                            <img class="d-block w-100  h-100" src="<?php echo $img ?>" alt="">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="w-100"
                    <hr class="border-warning">
                    <div class="rating">
                        <h5 class="mt-2 mb-0">Rating (<?php echo $average_rating;?>)</h5>
							<?php for ($j = 1; $j <= 5; $j++): ?>
								<?php if ($j <= $average_rating): ?>
									<span class="fa fa-star" style="color: #FFD700;"></span>
								<?php else: ?>
									<span class="fa fa-star" style="color: #A0A0A0;"></span>
								<?php endif; ?>
							<?php endfor; ?>
						</div>
                    <hr>
                    <div class="w-100 d-flex justify-content-between">
                        <span class="rounded-0 btn-flat btn-sm btn-primary d-flex align-items-center  justify-content-between" style="color: white; background-color: black; border-color: black"><i class="fa fa-tag"></i> <span class="ml-1"><?php echo number_format($cost) ?></span></span>
                        <button class="btn btn-flat btn-warning" type="button" id="book" style="color: white; background-color: black; border-color: black">Book Now</button>
                       <a href="./home.php?page=packages"> <button class="btn btn-flat btn-warning" type="button" id="book" style="color: white; background-color: black; border-color: black">Back</button></a>
                    </div>
                </div>
            </div>
            <div class="col-md-7" style="line-height: 1px !important;">
                <h3 class="my-0"><?php echo $title ?></h3>
                <p class=''>Location: <?php echo $tour_location ?></p>
                <h4 class="pt-0 my-0">Details</h4>
                <div class="mb-0 pb-0"  style="line-height: 1 !important;"><?php echo stripslashes(html_entity_decode($description)) ?></div>
                <div class="my-0 py-0">
                <hr  >
                <h5>Reviews (<?php echo count($feed) ?>)</h5>
                
                <?php foreach($feed as $r): ?>
                <div class="w-100 d-flex justify-content-between  align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo validate_image('assets/img/user.jpg') ?>" class="border mr-3 review-user-avatar" alt="">
                        <span><?php echo $r['name'] ?></span>
                    </div>
                    <span class='text-muted'><?php echo date("Y-m-d H:i A",strtotime($r['date_created'])) ?></span>
                </div>
                <div class="w-100 review-feedback">
                    <?php echo $r['review'] ?>
                </div>
                <hr class='border-light'>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function(){
        $('#book').click(function(){
            if("<?php echo $_settings->userdata('id') ?>" > 0)
                uni_modal("Book Info","book_form.php?package_id=<?php echo $id ?>");
            else
                uni_modal("","login.php","large");
        })
    })
</script>