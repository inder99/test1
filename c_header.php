<?php
    //depraced Warning 
    error_reporting(E_ALL ^ E_DEPRECATED);

    if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
    @ob_start();     
    ?>
    <?
     error_reporting(E_ALL);
     ini_set("display_errors", 1);
    ?>
<?php
    if (!isset($_SESSION['valid']) || $_SESSION['user']=="") {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>
     <!-- begin -->     
<head>
    <link rel="stylesheet" href="css/header-user-dropdown.css">
    <link rel="stylesheet" href="css/style.css">    
    <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
</head>

<header class="header-user-dropdown">
	<div class="header-limiter">
		<h1><a href="#">TPC<span> UIET</span></a></h1>
		<nav>
			<a href="c_signup_company.php">Enter Company</a>            
			<a href="c_placement_details.php">Company Details</a>            
			<a href="c_particular_stu.php">Particalar Student</a>            
            <a href="c_branchwise_details.php">BranchWise Detail</a>            
			<a href="c_analysis.php">Analysis<span class="header-new-feature">new</span></a>
<!--            
			<a href="#">Roles <span class="header-new-feature">new</span></a>
-->
		</nav>
		<div class="header-user-menu">
         <ul class="nav navbar-nav navbar-right">
           <!-- Begin Login -->             
           <li>
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
/*            echo '<img src="./images/2.jpg" alt="User Image"/>';*/
            echo '<a href="redirect.php?action=logout" class="highlight">Logout</a>';
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
	</div>
</header>

<script src="./js/jquery.min.js" type="text/javascript"></script>    
<script>
	$(document).ready(function(){
		var userMenu = $('.header-user-dropdown .header-user-menu');
		userMenu.on('touchend', function(e){
			userMenu.addClass('show');
			e.preventDefault();
			e.stopPropagation();
		});
		// This code makes the user dropdown work on mobile devices
		$(document).on('touchend', function(e){
			// If the page is touched anywhere outside the user menu, close it
			userMenu.removeClass('show');
		});
	});
</script>
