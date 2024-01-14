<?php 

require_once('config.php'); 
$query1 = "SET time_zone = '+08:00'";
$conn->query($query1);
// Query to update bookings with status 1 (Confirmed) and passed schedule
$updateConfirmedQuery = "UPDATE `book_list` SET status = 3 WHERE status = 1 AND schedule < CURDATE()";
$conn->query($updateConfirmedQuery);
// Query to update bookings with status 0 (Pending) and passed schedule
$updateQuery = "UPDATE `book_list` SET status = 2, remark = 'Booking declined' WHERE status = 0 AND schedule < CURDATE()";
$conn->query($updateQuery);


// if (isset($_SESSION['userdata']['role']) &&  $_SESSION['userdata']['role'] == 'admin') {
//  header ("location: admin/index.php"); 
//  var_dump($_SESSION['userdata']['role']);
//  }
//  if (isset($_SESSION['userdata']['role']) &&  $_SESSION['userdata']['role'] !== 'admin') {
//   header ("location: home.php"); 
//   }
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
    <form id="login-form">

      <div class="login-box">

        <h1> Sign In </h1>

        <div class="textbox">
           
          <input type="email" id="username" placeholder="Email" name="username" value="" required> 

        </div>
        <div class="textbox">
          <input type="password" id="password" placeholder="Password" name="password" value=""  required>
        </div>
          
        <input class="btn" type="submit" name="submit" value="Sign in">
        <a href="register.php">Create  an account?</a>
      </div>

    </form>

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
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        alert_toast("Account succesfully registered",'success')
                        setTimeout(function(){
                            location.reload()
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
        $('#login-form').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Login.php?f=login_user",
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
                        alert_toast("Login Successfully",'success')
                        setTimeout(function(){
                          window.location.href = "home.php";
                        },2000)
                    }else if(resp.status == 'incorrect'){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text("Incorrect Credentials.")
                        $('#login-form').prepend(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
        })
    })
</script>
</html>


