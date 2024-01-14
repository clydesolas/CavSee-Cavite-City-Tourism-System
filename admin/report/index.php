<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header d-flex justify-content-end ">
        <div class="btn-group" role="group" >
            <button type="button" class="btn btn-dark active disabled " >
            <i class="nav-icon fas fa-th-list"></i>Booking List Report
            </button>
                <button type="button" class="btn btn-dark">
                <a href="./?page=report/review_report"  class="text-light" style=""> <i class="nav-icon fas fa-comment-alt"></i> Rate & Review Report</a>
            </button>
        </div>
        
	</div>
    
    <div class="container p-4" >
    
        
        <form method="post" id="form">
                    <div class="row   justify-content-center">
                        <div class="col-sm-4">
                        <section class="row">
                            <div class="col-sm-6">
                                <label for="from">From: </label>
                                <input type="date" id="start_date" class="sd" name="start_date" value="<?php echo date('Y-m-d', strtotime('first day of January')) ?>" name="startDate" required onchange="fetchData()">
                            </div>
                            <div class="col-sm-6">
                                <label for="to">To:</label>
                                <input type="date" id="end_date" class="ed" name="end_date" value="<?php echo date('Y-m-d', strtotime('last day of December')) ?>" name="startDate" required onchange="fetchData()">
                            </div>
                        </section>
                        </div>
                        <div class="col-sm-2">
                        <section class="export">
                            <button class="btn btn-success btn-sm" type="submit" id="btn1" onclick="thisBtn1()" name="excel">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-file-earmark-arrow-down-fill"
                                    viewBox="0 0 16 16">
                                        <path
                                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                </svg>
                                Excel
                            </button>
                            <button class="btn2 btn btn-danger btn-sm" type="submit" id="btn2" onclick="thisBtn2()" name="pdf">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-file-earmark-arrow-down-fill"
                                    viewBox="0 0 16 16">
                                        <path
                                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z"/>
                                </svg>
                                Pdf
                            </button>
                        </section>
                        </div>
                        
                        
                    </div>
                    </form>
    </div>
	<div class="card-body">
        <div class="container-fluid">
        <table class="table table-stripped text-dark">
            <colgroup>
                <col width="5%">
                <col width="10">
                <col width="15">
                <col width="25">
                <col width="20">
                <col width="5">
                <col width="5">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>User</th>
                    <th>Package</th>
                    <th>Schedule</th>
                    <th>Status</th>
                   
                </tr>
            </thead>
            <tbody id="result-body">
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT b.*,p.title,concat(u.firstname,' ',u.lastname) as name FROM book_list b inner join `packages` p on p.id = b.package_id inner join users u on u.id = b.user_id order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("M j, Y h:ia",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo date("M j, Y",strtotime($row['schedule'])) ?></td>
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
                     
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
		</div>
	</div>
</div>
<script>
            function thisBtn1(){
               btn1 =  document.getElementById("btn1"); 
               form =  document.getElementById("form"); 
               if(btn1){
                form.setAttribute('action', 'report/generate_excel.php');
               }
            }
            function thisBtn2(){
               btn2 =  document.getElementById("btn2"); 
               form =  document.getElementById("form"); 
               if(btn2){
                form.setAttribute('action', 'report/generate_pdf.php');
               }
            }
     function fetchData() {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;
            var sd = document.getElementsByClassName("sd").value;
            var ed = document.getElementsByClassName("ed").value;
            sd = startDate;
                    ed = endDate;
                    console.log(sd);

            if(startDate && endDate){
            // Make AJAX request to fetch data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the result table with the fetched data
                    document.getElementById("result-body").innerHTML = xhr.responseText;
                    
                }
            };

            // Send the request to the server
            xhr.open("GET", "report/report_fetch.php?start_date=" + startDate + "&end_date=" + endDate, true);
            xhr.send();
        }
    }
    </script>

