<?php
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){
        
        $email = mysql_escape_string($_GET['email']); // Set email variable
        $hash = mysql_escape_string($_GET['hash']); // Set hash variable        
        
        $query = "UPDATE temp_tpc_students SET email_verified='Y' WHERE stu_email='".$email."' AND hash='".$hash."' AND  email_verified='N'";
	$result = $db_handle->updateQuery($query);
		if(!empty($result)) {
			$message = "Email is Verified\nPending Verification Admin Level";
	                echo '<script>alert("Pending Verification Admin Level");</script>';
	                header('Refresh: 1; URL=redirect.php?action=loginpage');                                		
		} else {
			$message = "Problem in account activation.";
		}
	}
    else{
        echo "Not Success";    
    }
?>
<html>
<head>
<title>PHP User Registration Form</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php if(isset($message)) { ?>
<div class="message"><?php echo $message; ?></div>
<? echo '<script>alert($message)</script>'?>
<?php } ?>
</body></html>
		
