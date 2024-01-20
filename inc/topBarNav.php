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
									<li><a href="index.php">Home</a></li>
                                 
                                  
                                    <li class="active-menu"><a href="./?page=packages"  >Packages</a></li>
                                    <li><a href="./?page=feedback">Review</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./?page=my_account">Booking List  <span class="badge badge-danger px-2 rounded" style="background-color: red !important;" id="bookingCountDisplay"></span></a></li>

                                    <?php if(isset($_SESSION['userdata'])): ?>
                                    <li class="nav-item"><a class="nav-link" href="./?page=edit_account"><i class="fa fa-user"></i> Hi, <?php  echo ucwords($_settings->userdata('firstname')) ?>!</a></li>
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
 $(document).ready(function() {
    function fetchBookingCount() {
        $.ajax({
            type: 'GET',
            url: 'inc/getBookingCount.php', 
            dataType: 'json',
            success: function(response) {
                // Handle the response
                var bookingCount = response.count;
                console.log('Booking Count:', bookingCount);

                // Update the div with the booking count
                $('#bookingCountDisplay').text(bookingCount);
            },
            error: function(error) {
                console.error('Error fetching booking count:', error);
            }
        });
    }

    // Initial fetch on document ready
    fetchBookingCount();

    // Periodically fetch and update booking count (every 5 seconds in this example)
    setInterval(fetchBookingCount, 2000); // Adjust the interval as needed
});


 $(function(){
    $('#login_btn').click(function(){
      uni_modal("","login.php","large");
 
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