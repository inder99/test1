<?php
    include 'header.php';
    include '../connect.php';    
?>
    
<?php
    if (!isset($_SESSION['valid'])) {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>
<div class="container">
<div id="main_body" class="row">
    <div id="main" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <center><h4>Access to Admin only</h4></center>
        <h3>Verify Student</h3>
             
<?php
/*******************************************   Student Verification   ***************************************************/
$retval = mysql_query("SELECT * FROM temp_tpc_students WHERE email_verified='Y' AND student_verified='N' ORDER BY branch, first_name");    
sif($retval ){
    $display_string = "<div class='table-responsive'>";	
    $display_string .= "<table class='table table-striped'>";
    $display_string .= "<tr>";
    $display_string .= "<th>S.no.</th>";
    $display_string .= "<th>Name</th>";
    $display_string .= "<th>RollNo</th>";    
    $display_string .= "<th>Branch</th>";
    $display_string .= "<th>Deptt</th>";
    $display_string .= "<th>CGPA</th>";    
    $display_string .= "<th>Reappear</th>";        
    $display_string .= "<th>12<sup>th</sup>Percent</th>";            
    $display_string .= "<th>10<sup>th</sup>Percent</th>";                
    $display_string .= "<th>Verify</th>";
    $display_string .= "<th>Update</th>";
    $display_string .= "</tr>";
    
    $i=0;
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
        $i++;
        echo "Hello";
        $designation="student";
        $status="update";
        $verify_link = "http://$_SERVER[HTTP_HOST]"."/tpc/admin/activate_status.php?id=" . $row["stu_id"] . "&email=" . $row["stu_email"] . "&status=verify";
        $update_link = "http://$_SERVER[HTTP_HOST]"."/tpc/admin/update_required.php?id=" . $row["stu_id"] . "&email=" . $row["stu_email"] . "&status=update";
	   $display_string .= "<tr>";
        $display_string .= "<td>$i</td>";
        $display_string .= "<td>$row[first_name] $row[last_name]</td>";        
        $display_string .= "<td>$row[rollno]</td>";
        $display_string .= "<td>$row[branch]</td>";
        $display_string .= "<td>$row[dept]</td>";        
        $display_string .= "<td>$row[cgpa]</td>";
        $display_string .= "<td>$row[reappear]</td>";
        $display_string .= "<td>$row[twelveth_marks]</td>";                
        $display_string .= "<td>$row[tenth_marks]</td>";                        
        
        $display_string .= "<td><a href='" . $verify_link . "'>Verify?</a></td>";        
        $display_string .= "<td><a href='" . $update_link . "'><span class='color_red'>Update?</span></a></td>";
        $display_string .= "</tr>";
    } 
    $display_string .= "</table>";
    $display_string .= "</div>";
    echo $display_string;
    echo "Fetched data successfully\n";
    mysql_free_result($retval);
}
/*******************************************   Student Verification Ends ***************************************************/
else{
    die('Could not get data: ' . mysql_error());
}

/*mysql_close($conn);*/
?>
    </div>        <!-- end col-lg col-md -->     
</div><!-- end main_body -->
</div><!-- end conatiner -->
<?php
    include 'footer.php';
?>