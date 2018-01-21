<?php
    include_once './connect.php';

    if(isset($_GET['company_id']) && !empty($_GET['company_id']) && isset($_GET['student_id']) && !empty($_GET['student_id']) && isset($_GET['company_name']) && !empty($_GET['company_name'])){
        
        $student_id = mysql_escape_string($_GET['student_id']); // Set student ID variable        
        $company_id = mysql_escape_string($_GET['company_id']); // Set company ID variable        
        $comp_name = mysql_escape_string($_GET['company_name']); // Set company ID variable        
        
        $search = mysql_query("SELECT * FROM tpc_student_reg WHERE student_id='".$student_id."' AND company_id='".$company_id."' AND placed='Y'") or die(mysql_error()); 
        $match  = mysql_num_rows($search);        
        echo $match;
        if($match == 1 ){
                // We have a match, update the placed
            mysql_query("UPDATE tpc_student_reg SET placed='N' WHERE student_id='".$student_id."' AND company_id='".$company_id."' AND placed='Y'") or  die(mysql_error());
            echo '<div class="statusmsg">Delete Student Placed Successfully</div>';            
            header("Location: c_placement_details.php?action=comp_selected&id=" . $company_id . "&company_name=" . $comp_name);
        }            
        else{
                // No match -> invalid url or account has already been activated.
            echo '<script>alert("No match Found");</script>';            
            echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
        }        
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