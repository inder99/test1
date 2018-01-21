<?php
    if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
    @ob_start();     
    ?>
    <?
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
    ?>
   
   <!DOCTYPE html>
   <html lang="en">
     <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login</title>
   
   <?php
    include('bootstrap.php');

    ?>
<style>
   body {
     padding-top: 50px;
   }
   .starter-template {
     padding: 40px 15px;
     text-align: center;
   }
   </style>
   
   </head>
   
     <body>
   
       <div class="container">
   
         <div class="starter-template">
           <?php
                       $msg = '';
                       if (isset($_GET['action'])) {
                       if ($_GET['action'] == 'stu_succeed') {
                           $msg = 'Logged successfully...';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=stu_profile.php');
                       }
                       if ($_GET['action'] == 'stu_registered') {
                           $msg = 'Registered successfully...';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=stu_apply_company.php');
                       }                           
                           
                       if ($_GET['action'] == 'convenor_succeed') {
                           $msg = 'Logged successfully...';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=c_profile.php');
                       }                           
                       if ($_GET['action'] == 'loginpage') {
                           $msg = 'Registered successfully...';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=index.php');
                       }
                       else if ($_GET['action'] == 'timeover') {
                           session_unset();
                           session_destroy();
                           $msg = 'Inactivity so long, now sign-in again.';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=index.php');
                       }
                       else if ($_GET['action'] == 'logout') {
                           session_unset();
                           session_destroy();
                           $msg = 'Logged out. Now come back to homepage';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=index.php');
                       }
                       
                      else if ($_GET['action'] == 'invalid_permission') {
                           session_unset();
                           session_destroy();
                           $msg = 'Invalid permission. Come back to homepage...';
                           echo '<p class="lead">' . $msg . '</p>';
                           header('Refresh: 2; URL=index.php');
                       }
                      
                  } else {
                       header('Location: index.php');  
                   }
               ?>
         <h2 class="text-center"><a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); ?>" target="_self">Home <span class="glyphicon glyphicon-home"></span></a></h2>
         
         
         </div>
       </div><!-- /.container -->
     </body>
   </html>
   
