<hr>
<div class="container">
  <?php 
    $files = array();
    $packages = $conn->query("SELECT * FROM `packages` order by rand() ");
    while($row = $packages->fetch_assoc()){
      if(!is_dir(base_app.'uploads/package_'.$row['id']))
      continue;
      $fopen = scandir(base_app.'uploads/package_'.$row['id']);
      foreach($fopen as $fname){
        if(in_array($fname,array('.','..')))
          continue;
        $files[]= validate_image('uploads/package_'.$row['id'].'/'.$fname);
      }
    }

    $packageData = array();
    $packages = $conn->query("SELECT p.id, p.title, AVG(rr.rate) as average_rating
                            FROM `packages` p
                            LEFT JOIN `rate_review` rr ON p.id = rr.package_id
                            GROUP BY p.id, p.title
                            ORDER BY rand()");
    
    if ($packages === false) {
        echo "Error in the SQL query: " . $conn->error;
    } else {
        while ($row = $packages->fetch_assoc()) {
            $packageData[] = $row;
        }
    
        if (empty($packageData)) {
            echo "No data found.";
        } else {
            $packageDataJSON = json_encode($packageData);
        }
    }

    $totalReviewQuery = $conn->query("SELECT COUNT(id) as total_reviews FROM `rate_review` ");
    $totalReviewResult = $totalReviewQuery->fetch_assoc();
    $totalReviews = $totalReviewResult['total_reviews'];

    $totalUser = $conn->query("SELECT COUNT(id) as users FROM `users` WHERE role != 'admin' ");
    $totalUserResult = $totalUser->fetch_assoc();
    $totalUsers = $totalUserResult['users'];

    $totalBook = $conn->query("SELECT COUNT(id) as book FROM `book_list`");
    $totalBookResult = $totalBook->fetch_assoc();
    $totalBooks = $totalBookResult['book'];

    $totalPkg = $conn->query("SELECT COUNT(id) as packages FROM `packages`");
    $totalPkgResult = $totalPkg->fetch_assoc();
    $totalPkgs = $totalPkgResult['packages'];

    $totalBookPie = $conn->query("SELECT COUNT(id) as book, status FROM `book_list` GROUP BY status");
    $bookData2 = array();
    
        while ($row = $totalBookPie->fetch_assoc()) {
          $statusLabel = $statusLabel = ($row['status'] == 0) ? 'Pending' :
          (($row['status'] == 1) ? 'Confirmed' :
          (($row['status'] == 2) ? 'Cancelled' :
          (($row['status'] == 3) ? 'Done' : '')));

            $bookData2[$statusLabel] = $row['book'];
        }
    
        $databook = json_encode($bookData2);

        $totalBookRev = $conn->query("SELECT COUNT(a.id) as rate, b.title as name FROM rate_review a, packages b WHERE a.package_id = b.id  GROUP BY package_id");
        $bookData3 = array();
        
            while ($row = $totalBookRev->fetch_assoc()) {
              $statusLabel =$row['name'];
              $bookData3[$statusLabel] = $row['rate'];
            }
        
            $databook3 = json_encode($bookData3);  

?>

  <div class="row">
    <div class="col-sm-6" >
      <div class="card p-2">
          <div id="tourCarousel"  class="carousel slide" style="max-height: 247px;"  data-ride="carousel" data-interval="3000">
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
      </div>
    </div>
    <div class="col-sm-6">
    <a href="?page=report/review_report">
      <div class="card">
        <canvas id="barChart" width="400" height="200"></canvas>
      </div>
    </a>
  </div>

  
</div>
<div class="row">
<div class="col-sm-6" >
  <a href="?page=books/">
      <div class="card pb-3" style="height: 230px;">
        <div class="card-body mb-3">
        <h5 class="d-flex justify-content-left">Booking Status Count</h5>
        <canvas id="bookChart"></canvas>
        </div>
      </div>
   </a>
    </div>
    <div class="col-sm-3">
    <a href="?page=report/">
      <div class="card" style="height: 230px;">
      <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 230px;">
         <h1 style="font-size:45px"><?php echo $totalBooks ?></h1> 
         <h5 >Total Booking Count</h5>
        </div>
      </div>
    </a>
    </div>
    <div class="col-sm-3">
    <div class="card">
        <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 230px;">
            <h1  style="font-size:45px"><?php echo $totalUsers ?></h1>
            <h5>Total Registered Users</h5>
        </div>
    </div>
    </div>
    <div class="col-sm-6" >
    <a href="?page=packages/">
      <div class="card pb-3" style="height: 230px;">
        <div class="card-body mb-3">
        <h5 class="d-flex justify-content-left">Packages Review Count</h5>
        <canvas id="bookChart2"></canvas>
        </div>
      </div>
    </a>
    </div>
    <div class="col-sm-3">
    <a href="?page=packages/">
      <div class="card">
      <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 230px;">
         <h1 style="font-size:45px"><?php echo $totalPkgs ?></h1> 
         <h5>Total Packages</h5>
        </div>
      </div>
    </a>
    </div>

    
    <div class="col-sm-3">
    <a href="?page=review/">
      <div class="card">
      <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 230px;">
         <h1 style="font-size:45px"><?php echo $totalReviews ?></h1> 
         <h5>Total Reviews Count</h5>
        </div>
      </div>
    </a>
    </div>
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var packageData = <?php echo $packageDataJSON; ?>;
    var packageNames = packageData.map(function (item) { return item.title; });
    var ratings = packageData.map(function (item) { return item.average_rating; });
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: packageNames,
            datasets: [{
                label: 'Average Rating',
                data: ratings,
                backgroundColor: 'rgba(75, 192, 192, 0.8)', 
                borderColor: 'rgba(75, 192, 192, 1)', 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5 
                }
            }
        }
    });



    var bookData = <?php echo $databook; ?>;
    var ctx = document.getElementById('bookChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(bookData),
            datasets: [{
                data: Object.values(bookData),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                        display: true,
                        position: 'left'
                    },
        }
    });

    
    var bookData3 = <?php echo $databook3; ?>;
    var ctx3 = document.getElementById('bookChart2').getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'pie',
        data: {
            labels: Object.keys(bookData3),
            datasets: [{
                data: Object.values(bookData3),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                        display: true,
                        position: 'left'
                    },
        }
    });
  });
</script>
