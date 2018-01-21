<?php
    if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
    @ob_start();     
    ?>
    <?
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
    ?>
<?php
    if (!isset($_SESSION['valid']) || $_SESSION['user']=="" || $_SESSION['designation'] != "student"){
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title> 
<?php
    include('bootstrap.php');
    include('connect.php');
?>
    
    <link href="./css/header_style.css"  rel="stylesheet" type="text/css"> 
</head>
    
<body>
<?php
    $res=mysql_query("SELECT * FROM tpc_students WHERE stu_id=".$_SESSION['user']."");
    $userRow=mysql_fetch_array($res);
?>
    
<div class="navbar-wrapper header_height">
    <div class="container-fluid">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="./images/tpc.gif" alt="TPC" width="150" height="50"/></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav header_padding">
                        <li class="active"><a href="index.php">Profile</a></li>
                        <li><a href="stu_apply_company.php">Company Apply</a></li>                         
                        <li><a href="stu_placed.php">Placed</a></li>                
                        <li><a href="stu_prediction.php">Prediction &amp; Analysis</a></li>                                        
                        <li><a href="stu_upd_pass.php">Update Password</a></li>               
                    </ul>
         
         <ul class="nav navbar-nav navbar-right">
           <!-- Begin Login -->
           <li class="dropdown">
           <?php

        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) 
        {
         $inactive = 60 * 60 * 1;
            
            if (time() - $_SESSION['timeout'] > $inactive) 
            {
                $_SESSION['valid'] = false; 
                session_unset();
                session_destroy();
            } 
            else 
            {
            echo '<a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true"  aria-expanded="false">' . $userRow['first_name'] . '<span class="caret"></span></a>';                     
            echo '<ul class="dropdown-menu">';
            echo '<li><a href="redirect.php?action=logout">Logout</a></li>';
            echo '</ul>';
            }
       } 
        else 
        {
         echo '<a href="index.php">Login</a>';
       }
       
       ?>
           </li>
           <!-- End Login -->  
         </ul>
       </div>
       <!-- /.container-fluid --> 
            </div>
        </nav>
    </div>
</div>
</body>
</html>