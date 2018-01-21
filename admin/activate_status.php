<?php
    include_once '../connect.php';

    if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['status'])){
        
    $id = mysql_escape_string($_GET['id']); // Set ID variable         
    $email = mysql_escape_string($_GET['email']); // Set ID variable                
    $search = mysql_query("SELECT stu_id, stu_email, student_verified FROM temp_tpc_students WHERE stu_id='".$id."' AND stu_email='".$email."' AND student_verified='N'") or die(mysql_error()); 
    $match  = mysql_num_rows($search);        
        
    if($match == 1){
        /* Copy the data from temp table to the original table*/
                
        mysql_query("INSERT INTO tpc_students (stu_email,stu_password,first_name,last_name,father_name,mother_name,dob,gender,category,mobile,rollno,course,branch,semester,dept,cgpa,be_pass_year,twelveth_marks,twelveth_year,tenth_marks,tenth_year,projects,certification,tech_used,internship_1,internship_2,internship_3,address,reappear) 
        SELECT   stu_email,stu_password,first_name,last_name,father_name,mother_name,dob,gender,category,mobile,rollno,course,branch,semester,dept,cgpa,be_pass_year,twelveth_marks,twelveth_year,tenth_marks,tenth_year,projects,certification,tech_used,internship_1,internship_2,internship_3,address,reappear FROM temp_tpc_students WHERE stu_id='".$id."'") or  die(mysql_error());

        // As there is Foreign Key Constraint on that
        $orig_stu_id = mysql_query("SELECT stu_id FROM tpc_students ORDER BY stu_id DESC LIMIT 1") or die(mysql_error()); 
        $orig_stu_id_fetch=mysql_fetch_array($orig_stu_id);
        
        $original_id=$orig_stu_id_fetch["stu_id"];
        
        //Insert the Prediction part in the Predict Placement Table
        mysql_query("INSERT INTO tpc_predict_placement (p_stu_id,proj_research,proj_web_development,proj_android_app,proj_software_dev,proj_others,certi_linux,certi_database,certi_networking,certi_soft_skills,certi_others,tech_c,tech_cpp,tech_java,tech_android,tech_python,tech_front_end_dev,tech_back_end_dev,tech_sql,tech_embedded_prog,tech_matlab,tech_r_prog,tech_others,summer_first_year,summer_second_year,summer_third_year) 
        SELECT   '$original_id',proj_research,proj_web_development,proj_android_app,proj_software_dev,proj_others,certi_linux,certi_database,certi_networking,certi_soft_skills,certi_others,tech_c,tech_cpp,tech_java,tech_android,tech_python,tech_front_end_dev,tech_back_end_dev,tech_sql,tech_embedded_prog,tech_matlab,tech_r_prog,tech_others,summer_first_year,summer_second_year,summer_third_year FROM temp_tpc_students WHERE stu_id='".$id."'") or  die(mysql_error());
        
        echo mysql_affected_rows();
        /* Ends the copy of data to original table*/
        
        // Update the student_verfied Column
        mysql_query("UPDATE temp_tpc_students SET student_verified='Y' WHERE stu_id='".$id."' AND stu_email='".$email."' AND  student_verified='N'") or  die(mysql_error());
        
/*
        // Delete the student who is verified
        mysql_query("DELETE FROM temp_tpc_students WHERE student_verified='Y'") or  die(mysql_error());
*/
                
        echo '<div class="statusmsg">Verified</div>';                
        echo '<script>alert("Student Verified Successfully");</script>';
        header('Refresh: 1; URL=redirect.php?action=verified');
    }            
    else{
                // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
    } // ends student if
    else{
        // Invalid approach
        echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
        header('URL=redirect.php?action=invalid_permission');
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