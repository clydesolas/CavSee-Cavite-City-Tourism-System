<style>
  .sidebar li.nav-item *{
    color:white;
  }
</style>
<?php
$bookingCountQuery = "SELECT COUNT(*) as count FROM book_list WHERE status IN (0)";
$bookingCountResult = $conn->query($bookingCountQuery);

$bookingCount = 0;

if ($row = $bookingCountResult->fetch_assoc()) {
    $bookingCount = $row['count'];
}
?>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-dark elevation-4 bg-primary text-white" style="background-color: #212529">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin"style="background-color: #212529" class="brand-link bg-primary1 text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" >
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden" style="background-color: #212529">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <?php if (isset($_SESSION['userdata']['user_role'] ) && $_SESSION['userdata']['user_role'] == 'admin') { ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=packages" class="nav-link nav-packages">
                        <i class="nav-icon fas fa-map-marked"></i>
                        <p>
                          Packages
                        </p>
                      </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=books" class="nav-link nav-books">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Bookings <span class="badge badge-danger px-2 rounded"id="bookingCountDisplay" style="background-color: red !important;"></span>
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=tg_list" class="nav-link nav-tourguide">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                          Tour Guide
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=inquiries" class="nav-link nav-inquiries">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>
                        Inquiries <span class="badge badge-danger px-2 rounded"id="inquiryCountDisplay" style="background-color: red !important;"></span>
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=review" class="nav-link nav-review">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                        Rate & Reviews <span class="badge badge-danger px-2 rounded"id="rateCountDisplay" style="background-color: red !important;"></span>
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=report" class="nav-link nav-report">
                      <i class="nav-icon fa fa-file" aria-hidden="true"></i>
                        <p>
                        Report
                        </p>
                      </a>
                    </li>

                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=backup" class="nav-link nav-backup">
                      <i class="nav-icon fa fa-clock" aria-hidden="true"></i>
                        <p>
                        Backup and recovery
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                          Settings
                        </p>
                      </a>
                    </li>
                    <?php } ?> 
                    <?php if (isset($_SESSION['userdata']['user_role'] ) && $_SESSION['userdata']['user_role'] == 'tour_guide') { ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=tg_booking" class="nav-link nav-books">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Bookings  <span class="badge badge-danger px-2 rounded"id="bookingCountDisplaytg" style="background-color: red !important;"></span>
                        </p>
                      </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=developer" class="nav-link nav-developer">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Developers
                        </p>
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

      <script>

$(document).ready(function() {
    // Function to fetch and update counts
    function fetchCounts() {
        // Fetch Booking Count
        $.ajax({
            type: 'GET',
            url: 'inc/getBookingCount.php',
            dataType: 'json',
            success: function(response) {
                var bookingCount = response.count;
                console.log('Booking Count:', bookingCount);
                $('#bookingCountDisplay').text(bookingCount);
            },
            error: function(error) {
                console.error('Error fetching booking count:', error);
            }
        });

        $.ajax({
            type: 'GET',
            url: 'inc/getBookingCounttg.php',
            dataType: 'json',
            success: function(response) {
                var bookingCounttg = response.count;
                console.log('Booking Count:', bookingCounttg);
                $('#bookingCountDisplaytg').text(bookingCounttg);
            },
            error: function(error) {
                console.error('Error fetching booking count:', error);
            }
        });
        // Fetch Inquiry Count
        $.ajax({
            type: 'GET',
            url: 'inc/getInquiryCount.php',
            dataType: 'json',
            success: function(response) {
                var inquiryCount = response.count;
                console.log('Inquiry Count:', inquiryCount);
                $('#inquiryCountDisplay').text(inquiryCount);
            },
            error: function(error) {
                console.error('Error fetching inquiry count:', error);
            }
        });

        // Fetch Review Count
        $.ajax({
            type: 'GET',
            url: 'inc/getReviewCount.php',
            dataType: 'json',
            success: function(response) {
                var rateCount = response.count;
                console.log('Review Count:', rateCount);
                $('#rateCountDisplay').text(rateCount);
            },
            error: function(error) {
                console.error('Error fetching review count:', error);
            }
        });
    }

    // Initial fetch on document ready
    fetchCounts();

    // Periodically fetch and update counts (every 2 seconds)
    setInterval(fetchCounts, 2000);
});

    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if(s!='')
        page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
     
    })
  </script>