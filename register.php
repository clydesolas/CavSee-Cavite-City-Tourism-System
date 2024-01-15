<?php 

require_once('config.php'); 

if (isset($_SESSION['userdata']['role']) &&  $_SESSION['userdata']['role'] == 'admin') {
 header ("location: admin/index.php"); 
 var_dump($_SESSION['userdata']['role']);
 }
 if (isset($_SESSION['userdata']['role']) &&  $_SESSION['userdata']['role'] !== 'admin') {
  header ("location: home.php"); 
  }
//   var_dump($_SESSION['userdata']['role']);
?>

<!DOCTYPE html>
<html lang="entered">
<?php require_once('inc/header.php') ?>
<head>
  <title> Sign In Form </title>
  <meta name="viewport" content="width= device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
  <body>
    <div class="container w-50 pt-4">

  <div class="card p-0 w-100  my-5 mx-5">
    <div class="card-header">
    <h3 class="text-center pb-0 mb-0">Create New Account</h3>
    </div>
    <div class="card-body p-0 m-0">
    <div class="alert" id="msg" style="display: none;"></div>
    <form action="" id="registration" class="p-0 m-0">
                <div class="form-group2 text-dark px-5 pt-2">
                    <label for="" class="control-label">Firstname</label>
                    <input type="text" class="form-control form-control-sm" name="firstname" required>
                </div>
                <div class="form-group2 text-dark px-5 pt-2">
                    <label for="" class="control-label">Lastname</label>
                    <input type="text" class="form-control form-control-sm form" name="lastname" required>
                </div>
                <div class="form-group2 text-dark px-5 pt-2">
                <label for="" class="control-label">Email <span id="msg3" style="display: none;"></span></label>
                <div class="input-group">
                    <input type="email" id="username" class="form-control form-control-sm form" name="username" required>
                    <div class="input-group-append">
                        <button class="" type="button" id="verifyEmailBtn">Send OTP</button>
                    </div>
                </div>
            </div>
            <input type="hidden"  id="otp" >
            <div class="form-group2 text-dark px-5 pt-2">
                <label for="" class="control-label">OTP <span id="msg2" style="display: none;"></span></label>
                <input type="text" class="form-control form-control-sm form" id="otpInput"  onchange="compareValues()" maxlength="6" required>
            </div>
                <div class="form-group2 text-dark px-5 pt-2">
                    <label for="" class="control-label">Password</label>
                    <input type="password" class="form-control form-control-sm form" min="8" name="password" required>
                </div>
                <div class="form-group d-flex justify-content-end mb-0 pb-0">
                    <button class="btn btn-primary btn-flat" id="submitreg" type="submit" name="submit"  style= "background-color: #212529; border: solid black;">Register</button>
                </div>
                <div class="text-center pt-0 mt-0 pb-3">
                <a class="text-dark" href="index.php">Go to login page</a>
                </div>

            </form>
    </div>
         
        </div>
  </div>
 

  </body>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  
  <script>
    
    $(function(){
        $('#registration').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=register",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log('error:'+err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully registered",'success')
                        setTimeout(function(){
                            window.location.href = "home.php";
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#registration').prepend(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })

            
        })

        var otpButton = $('#verifyEmailBtn');
        var otpInput = $('#username');

        // Initially disable the OTP button
        otpButton.prop('disabled', true);

        otpInput.on('input', function () {
            var email = otpInput.val();

            // Check if the entered value is a valid email
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                otpButton.prop('disabled', false);
                $('#msg3').css('display', 'inline-block');
                $('#msg3').css('color', 'green');
                $('#msg3').text(' ✓');
            } else {
                otpButton.prop('disabled', true);
                $('#msg3').css('display', 'inline-block');
                $('#msg3').css('color', 'red');
                $('#msg3').text(' (Inavlid format)');
            }
        });
           // Verify Email button click
           $('#verifyEmailBtn').click(function () {
            start_loader()
            var email = $('#username').val();
            var button = $(this);
            var timerSeconds = 5 * 60; // 5 minutes in seconds



            if (email) {
               

                $.ajax({
                    url: 'verify_email.php',  // Updated URL to point to the new PHP file
                    method: 'POST',
                    data: { email: email },
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 'Email already exist'){
                            $('#msg').css('display', 'block');
                            $('#msg').removeClass('alert-success');
                            $('#msg').addClass('alert-danger');
                            $('#msg').text('Email already taken');
                            end_loader()
                        }
                        if(response.status == 'success'){
                            button.prop('disabled', true);
                                updateButtonTimer();

                                var interval = setInterval(function () {
                                    timerSeconds--;

                                    if (timerSeconds <= 0) {
                                        clearInterval(interval);
                                        button.prop('disabled', false);
                                        button.text('Send OTP');
                                    } else {
                                        updateButtonTimer();
                                    }
                                }, 1000);
                        $('#msg').css('display', 'block');
                        $('#msg').removeClass('alert-danger');
                        $('#msg').addClass('alert-success');
                        $('#otp').val(response.otp);
                        $('#msg').text('6-digit OTP has been sent to your email, please verify your email to register');
                        end_loader()
                    }
                    },
                    error: function (err) {
                        console.log('Error: ' + JSON.stringify(err));
                        alert('An error occurred while processing the request.');
                        end_loader()

                    }
                });
            } else {
                alert('Please enter an email address.');
            }

            function updateButtonTimer() {
                button.text('OTP expires in ' + formatTime(timerSeconds));
            }

            function formatTime(seconds) {
                var minutes = Math.floor(seconds / 60);
                var remainingSeconds = seconds % 60;
                return minutes + ':' + (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
            }

            
        });
    });
    $('#otpInput').on('input', function () {
    compareValues();
});
$('#submitreg').prop('disabled', true);

function compareValues() {
    var value1 = $('#otp').val();
    var value2 = $('#otpInput').val();

    if (value1 === value2) {
        console.log('Values are equal');
        $('#otpInput').css('border', '3px solid green');
        $('#msg2').css('display', 'inline-block');
        $('#msg2').css('color', 'green');
        $('#msg2').text(' (Verified)');
        $('#submitreg').prop('disabled', false);

    } else {
        console.log('Values are not equal');
        $('#otpInput').css('border', '3px solid red');
        $('#msg2').css('display', 'inline-block');
        $('#msg2').css('color', 'red');
        $('#msg2').text(' (Incorrect)');
        $('#submitreg').prop('disabled', true);
        
    }
}

</script>
</html>

