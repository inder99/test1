<?php
    include_once './connect.php';

    if(isset($_GET['student_id']) && !empty($_GET['student_id']) && isset($_GET['debarred']) && !empty($_GET['debarred'])){
        if($_GET['debarred'] === "yes"){
            $student_id = mysql_escape_string($_GET['student_id']); // Set student ID variable        
            
            $search = mysql_query("SELECT * FROM tpc_students WHERE stu_id='".$student_id."' AND debarred='N'") or  die(mysql_error()); 
            $match  = mysql_num_rows($search);        
            $stu_row = mysql_fetch_array($search, MYSQL_ASSOC);
            echo $match;
            if($match == 1 ){
                // We have a match, update the placed
                mysql_query("UPDATE tpc_students SET debarred='Y' WHERE stu_id='".$student_id."' AND debarred='N'") or      die(mysql_error());
                echo '<div class="statusmsg">Debarred Student Successfully</div>';                      
            }            
            else{
                // No match -> invalid url or account has already been activated.
                echo '<script>alert("No match Found");</script>';            
                echo '<div class="statusmsg">No match Found</div>';
            }        
        }
        if($_GET['debarred'] === "no"){
            $student_id = mysql_escape_string($_GET['student_id']); // Set student ID variable        
            
            $search = mysql_query("SELECT * FROM tpc_students WHERE stu_id='".$student_id."' AND debarred='Y'") or  die(mysql_error()); 
            $match  = mysql_num_rows($search);        
            $stu_row = mysql_fetch_array($search, MYSQL_ASSOC);
            echo $match;
            if($match == 1 ){
                // We have a match, update the placed
                mysql_query("UPDATE tpc_students SET debarred='N' WHERE stu_id='".$student_id."' AND debarred='Y'") or      die(mysql_error());
                echo '<div class="statusmsg">Debarred Removed Successfully</div>';                      
            }            
            else{
                // No match -> invalid url or account has already been activated.
                echo '<script>alert("No match Found");</script>';            
                echo '<div class="statusmsg">No match Found</div>';
            }        
        }
    header("Location: c_particular_stu.php?rollno=" . $stu_row['rollno'] . "&branch=" . $stu_row['branch'] . "&signup=");          
    }
    else{
        // Invalid approach
        echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
        header('Location: redirect.php?action=invalid_permission');         
    }
?>

<html>
<head>
<title>PHP User Registration Form</title>
<link href="style.css" type="text/css" rel="stylesheet" />
<style>
.statusmsg{
    font-size: 12px; /* Set message font size  */
    padding: 3px; /* Some padding to make some more space for our text  */
    background: #EDEDED; /* Add a background color to our status message   */
    border: 1px solid #DFDFDF; /* Add a border arround our status message   */
}
</style>
    
</head>
<body>

<div class="message">Message</div>

</body>

</html>
		