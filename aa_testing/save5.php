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

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$res2=mysql_query("SELECT * FROM author, users WHERE author.user_id=".$_SESSION['user']);
/*var_dump($res2);*/
$userRow2=mysql_fetch_array($res2);

?>

<?php
    if (!isset($_SESSION['valid'])) {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
 ?>
<!--if the person is newly signin then allow him in fill the registration form-->
<?php
/*    echo " username = " ;
    echo $res2;*/
/*empty($userRow2['Designation'])==="h"*/
   if (empty($userRow2)){
           header('Location: profile.php'); 
    }
?>
     <div id="main_body" class="row">
       <div id="main" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <label><?php echo $userRow['username']; ?></label>
              hi' <?php echo $userRow['username']; ?>&nbsp;<a href="redirect.php?action=logout">Logout</a>
        </div>
    </div>

       <div id="sidebar" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?php
           include 'sidebar.php';
           ?>
       </div>
       <!-- end sidebar --> 
     
   <?php
   include 'footer.php';
   ?>
