<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header d-flex justify-content-end">
    <div class="btn-group" role="group" >
            <button type="button" class="btn btn-dark" >
            <a href="./?page=report/"  class="text-light"  style=""> <i class="nav-icon fas fa-th-list"></i>Booking List Report</a>
            </button>
                <button type="button" class="btn btn-dark  active disabled">
                <i class="nav-icon fas fa-comment-alt"></i> Rate & Review Report
            </button>
        </div>
	</div>
    <div class="container p-4">
    
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
                <col width="10%">
                <col width="10%">
                <col width="25%">
                <col width="15%">
                <col width="30%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>DateTime</th>
                    <th>Details</th>
                    <th>Rate</th>
                    <th>Feedback</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=1;
                    $qry = $conn->query("SELECT r.*,concat(u.firstname,' ',u.lastname) as name, p.title FROM `rate_review` r, `users` u, `packages` p WHERE u.id = r.user_id AND p.id = r.package_id order by r.date_created desc; ");
                    while($row= $qry->fetch_assoc()):
                        $row['review'] = strip_tags(stripslashes(html_entity_decode($row['review'])));
                ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("M j, Y h:ia",strtotime($row['date_created'])) ?></td>
                        <td>
                            <p class="m-0"><b>User:</b> <?php echo  ucwords($row['name']) ?></p>
                            <p class="m-0"><b>Package:</b> <?php echo  ucwords($row['title']) ?></p>
                        </td>
                        <td><p class="truncate-1 m-0"><?php echo $row['rate'] ?>/5</p></td>
                        <td><p class="truncate-1 m-0" title="<?php echo $row['review'] ?>"><?php echo $row['review'] ?></p></td>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
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
                form.setAttribute('action', 'report/generate_excel_review.php');
               }
            }
            function thisBtn2(){
               btn2 =  document.getElementById("btn2"); 
               form =  document.getElementById("form"); 
               if(btn2){
                form.setAttribute('action', 'report/generate_pdf_review.php');
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
            xhr.open("GET", "report_fetch.php?start_date=" + startDate + "&end_date=" + endDate, true);
            xhr.send();
        }
    }
    </script>

