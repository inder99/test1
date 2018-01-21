<?php
    session_start();
    ob_start();
    include_once 'connect.php';

    /* Delete those entries from temp table whose email is not verified withing 24 hours of Registration*/
    if (function_exists('date_default_timezone_set'))
    {
        date_default_timezone_set('Asia/Calcutta');
    }
    $current_time = time();
    $limit = 24*60*60;
    mysql_query("DELETE FROM temp_tpc_students WHERE '$current_time' - timestamp_email > '$limit'") or  die(mysql_error());
    /* Ends Delete those entries from temp table whose email is not verified withing 24 hours of Registration*/

    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
    
   <?php
    if(isset($_SESSION['user'])!="")                                        
    {
        if($_SESSION['designation'] == "student")
            header("Location: stu_profile.php");
        if($_SESSION['designation'] == "convenor")
            header("Location: c_profile.php");
    }
    $msg = "";
    if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) 
    {
        $email = strtolower(mysql_real_escape_string($_POST['email']));
        $upass = md5(mysql_real_escape_string($_POST['password']));
        
        if($_POST['designation'] === "student"){ 
            $res=mysql_query("SELECT stu_id,stu_email,stu_password FROM tpc_students WHERE stu_email='$email'");
            $row=@mysql_fetch_array($res);
            if(!$row)
                echo "Student not verified by Admin <br>";
            if($row['stu_password']==$upass)
            {
                $_SESSION['user'] = $row['stu_id'];
                $_SESSION['designation'] = "student";                
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                header('Location: redirect.php?action=stu_succeed');
            }
            else
            {
                $msg="Wrong Email or Password";
                echo $msg;
            }
        }
        if($_POST['designation'] === "convenor"){ 
            
            if($_POST['email']=="admin" && $_POST['password']=="admin")                
            {
                $_SESSION['user'] = "convenor";
                $_SESSION['designation'] = "convenor";
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                header('Location: redirect.php?action=convenor_succeed');
            }
            else
            {
                $msg="convenor Wrong Email or Password";
                echo $msg;
            }
        }        
        
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
                        <div class="panel-title">Student LogIn</div>
<!--
                        <div style="float:right; font-size: 80%; position: relative; top:-10px">
                            <a href="forgot_index.php">Forgot password?</a>    
                        </div>
-->
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="loginform" class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="on">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email" onblur="return ValidateEmail();" autofocus required>                                        
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                            </div>
                            
                            <div class="form-group margin_designation">
                                <label for="sel1">Designation</label>
                                <select class="form-control" id="sel1" name="designation">
                                    <option value="student">Student</option>
                                    <option value="convenor">Convenor</option>
                                </select>
                            </div>                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                        <button type="submit" id="btn-login" class="btn btn-success btn-sm" name="login">Sign in</button>          
<!--                                      <a id="btn-login" href="#" class="btn btn-success">Login  </a>-->
        <!--                              <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>-->

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="stu_signup_student.php">
                                            Sign Up Here?
                                        </a>                                            
                                        </div>
                                        <div style="float:right; font-size: 80%; position: relative;">
                                            <a href="./admin/">Admin</a>    
                                        </div>                                        
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        
    </div>
    
<script src="js/jquery.min.js" type="text/javascript"></script>    
<script src="bt/js/bootstrap.min.js"></script>
    
</body>
</html>