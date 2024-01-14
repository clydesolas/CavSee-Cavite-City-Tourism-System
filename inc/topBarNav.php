<?php
 $idd = $_settings->userdata('id');
$bookingCountQuery = "SELECT COUNT(*) as count FROM book_list WHERE status IN (0, 1) AND user_id = '$idd'";
$bookingCountResult = $conn->query($bookingCountQuery);

$bookingCount = 0;

if ($row = $bookingCountResult->fetch_assoc()) {
    $bookingCount = $row['count'];
}
?>
    <div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header" style="z-index: 2 !important;">
			<header id="fh5co-header-section" >
				<div class="container" >
					<div class="nav-header" >
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo"><a href="">CaviSee: Cavite City Tourism</a></h1>
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
								<li class="active">
									<li><a href="home.php">Home</a></li>
                                 
                                  
                                    <li class="active-menu"><a href="./home.php?page=packages"  >Packages</a></li>
                                    <li><a href="./home.php?page=feedback">Review</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./home.php?page=my_account">Booking List  <span class="badge badge-danger px-2 rounded" style="background-color: red !important;"><?php if($bookingCount>0){echo $bookingCount;} ?></span></a></li>

                                    <?php if(isset($_SESSION['userdata'])): ?>
                                    <li class="nav-item"><a class="nav-link" href="./home.php?page=edit_account"><i class="fa fa-user"></i> Hi, <?php  echo ucwords($_settings->userdata('firstname')) ?>!</a></li>
                                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i></a></li>
                                  <?php else: ?>
                                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)" id="login_btn">Login</a></li>
                                  <?php endif; ?>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</header>
			
		</div>
<script>
  $(function(){
    $('#login_btn').click(function(){
      uni_modal("","login.php","large")
    })
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function () {
        if($('body').offset.top == 0)
          $('#mainNav').removeClass('navbar-shrink')
    })
  })
</script>