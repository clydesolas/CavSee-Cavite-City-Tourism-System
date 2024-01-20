<?php require_once 'config.php';
 $sqlEvents = "SELECT DISTINCT DATE_FORMAT(bl.schedule, '%Y-%c-%d') as schedule
 FROM book_list bl
 INNER JOIN packages p ON bl.package_id = p.id
 WHERE bl.status = 1
 AND p.id = '{$_GET['package_id']}'
 AND (
     SELECT SUM(bl2.book_pax)
     FROM book_list bl2
     WHERE bl2.status = 1 AND bl2.package_id = p.id
 ) >= p.pax";
$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($con));
$data = array();
while($rows = mysqli_fetch_assoc($resultset) ) {	
$data[] = $rows["schedule"];
}


?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> -->
    <style>
    .ui-state-holiday .ui-state-default {
    background-color: #D70040;
    pointer-events: auto;
    opacity: 1 !important;
    color: black;
}

.ui-state-disabled[title="Full"]{
     opacity: .9 !important;
}
.ui-datepicker-today a.ui-state-highlight {
    background-color: #f6f6f6;
    border: lightgray 1px solid;
}

.ui-datepicker-calendar a.ui-state-default { background: rgba(180, 248, 200, .6)
; }

#slots-full {
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid grey;
    clear: both;
    background-color: #D70040;
}
#slots-open {
    display: inline-block;
    height: 20px;
    width: 20px;
    border: 1px solid grey;
    clear: both;
    background-color: rgba(180, 248, 200, .6);
}
#slots-label {
    display: inline-block;
    padding-left: 10px;
}

@media (min-width: 1024px) {
    .calendardes{
    font-size: 23px;
    margin-bottom: 10px;
}
}
@media (min-width: 768px)  and (max-width: 1023px) {
    .calendardes{
    font-size: 15px;
    margin-bottom: 10px;
}
}
@media (max-width: 767px) {
    .calendardes{
    font-size: 22px;
    margin-bottom: 10px;
}
  }


    </style>
<div class="container">
    <form action="" id="book-form">
    <input name="package_id" type="hidden" required value="<?php echo $_GET['package_id'] ?>" >
    <?php date_default_timezone_set('Asia/Manila');echo "Today is: ". date('F j, Y');?>
    <div class="my-3">
    <label for="date" class="py-0 my-0 form-label"><span class="text-danger">*</span>Schedule Date:</label>
        <input type="date" autocomplete="off" style="cursor: pointer;"
        name="schedule" id="date" class="date form form-control my-0 datepicker" name='schedule' required>
    </div>
    
    <div class="my-3">
         <!-- Input field for Head Count -->
         <label for="head-count"  class="py-0 my-0 form-label"><span class="text-danger">*</span>Head Count: <span class="fs-6 fw-normal text-info" id="available-headcount-label"></span></label>
        <input type="number" class='form form-control my-0' id="head-count-input" required name='book_pax'>
    </div>
    <div class="mt-3 mb-2">
         <!-- Checkbox for Age Groups -->
         <label><span class="text-danger">*</span>Visitor Type/s:</label><br>
            <label class="fw-normal px-2"><input type="checkbox" name="visitor_type[]" value="Adult"> Adult</label>
            <label class="fw-normal px-2"><input type="checkbox" name="visitor_type[]" value="Baby"> Baby</label>
            <label class="fw-normal px-2"><input type="checkbox" name="visitor_type[]" value="Student"> Student</label>
            <label class="fw-normal px-2"><input type="checkbox" name="visitor_type[]" value="SeniorCitizen"> Senior Citizen</label>
    </div>
    <div class="my-2">
        <!-- Select option for Tourist Guides -->
        <label for="tourist-guide" class="py-0 my-0 form-label"><span class="text-danger">*</span>Tourist Guide:</label>
        <select class='form form-control p-2' name='tourguide_id' id='tourguide-select' disabled>
            <!-- You can include a placeholder option if needed -->
            <option value="" selected disabled>Select Tourist Guide</option>
        </select>
     </div>

<!-- Container for Terms and Conditions -->
<div class="terms-container mt-3">
    <label for="terms">
        <input type="checkbox" id="termsCheckbox" required>
        I have read and agree to the <a class="text-dark" href="#" id="showTermsLink1">Terms and Conditions</a>
    </label>
    <div class="terms-content1" style="display: none;">
        <h5>Terms and Conditions for this package</h5>
        <p><?php 
        $sql = "SELECT termsCondition FROM packages WHERE id = '{$_GET['package_id']}'";

        $result = mysqli_query($conn, $sql);
        
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $termsContent = $row['termsCondition'];
            echo $termsContent;
        } else {
            echo 'Terms and conditions not found or an error occurred.';
        }
        ?></p>
    </div>
</div>

        <div class="d-flex justify-content-end border-top py-2">
        <button type="submit" id="submit-btn" class="btn btn-primary mx-2">Submit</button>

        <button type="button" style="color: white; background-color: black; border-color: black"class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>

    </form>

 

</div>
<script>
    function checkRequiredFields() {
        var schedule = $('#date').val();
        var headCount = $('#head-count-input').val();
        var touristGuide = $('#tourguide-select').val();
        var termsCheckbox = $('#termsCheckbox').val();

        // Check if any required field is empty
        if (!schedule || !headCount || !touristGuide|| !termsCheckbox) {
            $('#submit-btn').prop('disabled', true);
        } else {
            $('#submit-btn').prop('disabled', false);
        }
    }

    // Disable the submit button initially
    $('#submit-btn').prop('disabled', true);

    // Check required fields on input/change
    $('#date, #head-count-input, #tourguide-select').on('input change', function () {
        checkRequiredFields();
    });


   // Show/hide terms container
   $('#showTermsLink1').click(function (e) {
            e.preventDefault();
            $('.terms-content1').slideToggle();
        });

     $("#date").attr( 'readOnly' , 'true' );
    function IsEmpty() {
    if (document.forms['apt'].question.value === "") {
        alert("empty");
        return false;
    }
    return true;
    }

    $('#tourguide-select').prop('disabled', true);
    $('#head-count-input').prop('disabled', true);
   
    var fullEvents = <?php echo json_encode($data) ?>;
 console.log(fullEvents);
    var dateToday = new Date();
    $(function() {
        $( "#date" ).datepicker({
            beforeShowDay: highLight,
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            minDate: dateToday,
            onSelect: function(dateText, inst) {
            var packageId = $("input[name='package_id']").val();
            var selectedDate = $.datepicker.formatDate("yy-mm-dd", new Date(dateText));
             // Fetch available tourist guides for the selected date
             $.ajax({
                url: 'fetch_tourist_guide_info.php',
                method: 'POST',
                data: { package_id: packageId, selected_date: selectedDate },
                dataType: 'json',
                success: function (resp) {
                    if (resp.status == 'success') {
                        // Enable the select dropdown
                        $('#tourguide-select').prop('disabled', false);
                        $('#tourguide-select').prop('required', true);
                        $('#tourguide-select').empty();
                        $('#tourguide-select').append('<option value="" selected disabled>Select Tourist Guide</option>');
                        // Populate the select dropdown with options
                        $.each(resp.tourGuides, function (index, tourGuide) {
                            var na = tourGuide.isBooked == 1?"(Not Available)":"";
                            var option = $("<option>")
                                .attr("value", tourGuide.id)
                                .text(tourGuide.name+" "+na)
                                .prop('disabled', tourGuide.isBooked == 1);

                            $('#tourguide-select').append(option);
                        });
                    } else {
                        console.log(resp);
                        alert_toast('An error occurred while fetching available tourist guides', 'error');
                    }
                },
                error: function(err) {
                    console.log(err);
                    alert_toast('An error occurred', 'error');
                }
            });
            // Fetch available headcount for the selected date
            $.ajax({
                url: 'fetch_available_headcount.php',
                method: 'POST',
                data: { package_id: packageId, selected_date: selectedDate },
                dataType: 'json',
                success: function(resp) {
                    if (resp.status == 'success') {
                            $('#head-count-input').attr('max', resp.available_headcount).attr('title', 'Maximum Head Count: ' + resp.available_headcount);
                            $('#head-count-input').prop('disabled', false);
                            $('#head-count-input').prop('required', true);

                            // Monitor user input to ensure it doesn't exceed the maximum
                            $('#head-count-input').on('input', function () {
                                var enteredValue = parseInt($(this).val()) || 0; 

                                // Ensure the entered value is within the allowed range
                                if (enteredValue > resp.available_headcount) {
                                    $(this).val(resp.available_headcount); // Reset value to the maximum if it exceeds
                                }
                            });

                        // Display available head count beside the label
                        $('#available-headcount-label').text('Available Population: ' + resp.available_headcount);
                    } else {
                        console.log(resp);
                        alert_toast('An error occurred while fetching available headcount', 'error');
                    }
                },
                error: function(err) {
                    console.log(err);
                    alert_toast('An error occurred', 'error');
                }
            });
        }
  
        });
        function highLight(date) {
        for (var i = 0; i < fullEvents.length; i++) {
            if (new Date(fullEvents[i]).toString() == date.toString()) {
                return [false, 'ui-state-holiday'];
            }
        }
    
        return [true];
   
        
    } 
      
    });
    $(function(){
        $('#book-form').submit(function(e){
            e.preventDefault();
            
            var ageGroups = [];
            $("input[name='visitor_type[]']:checked").each(function() {
                ageGroups.push($(this).val());
            });
            var concatenatedAgeGroups = ageGroups.join(',');

            // Add concatenated age groups to the form data
            $(this).append('<input type="hidden" name="pax_type" value="' + concatenatedAgeGroups + '">');
            $("input[name='visitor_type[]']").removeAttr("name");
            if(ageGroups.length === 0) {
                e.preventDefault();
                alert_toast("Visitor type field is empty", 'error');
            }
            else{
                start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=book_tour",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                error: err => {
                    console.log(err);
                    alert_toast("an error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        alert_toast("Book Request Successfully sent.");
                        $('.modal').modal('hide');
                    } else {
                        console.log(resp);
                        alert_toast("an error occurred", 'error');
                    }
                    end_loader();
                }
            })
        }
           
        })
    })
</script>
