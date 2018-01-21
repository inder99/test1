<?php
    include 'stu_header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
    <?    
    $msg = "";
    if (isset($_POST['update_submit']) && !empty($_POST['password'])) 
    {
        echo "INder";
        $userid=$_SESSION['user'];        
        
        $res=mysql_query("SELECT stu_id, stu_password, stu_email FROM tpc_students WHERE stu_id='$userid' ");
        $password_hash = md5(mysql_escape_string($_POST['password'])); // Set id variable        
        
        $row=mysql_fetch_array($res);
        if($row){
            mysql_query("UPDATE tpc_students SET stu_password='".$password_hash."' WHERE stu_id='".$id."' ") or  die(mysql_error());
            echo '<div class="statusmsg">Password Reset, activation through email</div>';
            echo '<p> Email Sent </p>';
            echo "<script>Email not registered, Please Register</script>";            
            
            mysql_free_result($res);
/*               echo '<script>alert("Email Sent");</script>';*/
            header('Location: stu_upd_pass_activate.php?email='.$row['stu_email']);            
                        
        }
     mysql_free_result($res);    
        //            echo "<script>Email not registered, Please Register</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<?php
    include ('bootstrap.php');
?>
</head>

<body>
    
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Update Password</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px">
                            <a href="index.php">Home</a>    
                        </div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="loginform" class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="on">
                                    

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="" type="password" class="form-control" name="password" placeholder="New Password">
                            </div>
                            
                            
                            <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <button type="submit" id="btn-login" class="btn btn-success btn-sm" name="update_submit">Submit</button>          
<!--                                      <a id="btn-login" href="#" class="btn btn-success">Login  </a>-->
        <!--                              <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>-->

                                    </div>
                                </div>        
                        </form>     
                        
                </div>                     
            </div>  
        </div>
    </div>    
    
</body>
</html>