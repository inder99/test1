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
    if (!isset($_SESSION['valid']) && $_SESSION['user']!="") {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>

<?php
    include('bootstrap.php');
    include('../connect.php');
?>
   </head>
<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Admin TPC UIET</title> 
</head>
    
<body>
<?php
include('bootstrap.php');
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
                    <a class="navbar-brand" href="index.php">TPC</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="verify.php" class="">Home</a></li>
                        <li><a href="check.php">Check</a></li>
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
            echo '<a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true"  aria-expanded="false">Admin<span class="caret"></span></a>';                     
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
            </div><!-- Ends Container -->
        </nav>
    </div>
</div>
<script src="../js/jquery.min.js" type="text/javascript"></script>    
<script src="../bt/js/bootstrap.min.js" type="text/javascript"></script>     
    </body>    