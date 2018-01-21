<?php
    include 'stu_header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="placed/js/alphabet.js"></script>
    <style>
      .animate_placed{
          position:fixed;   
          top:180px;
      }
    </style>
</head>
<body>
<?php

    if (isset($_SESSION['valid']))
	{
        $userid=$_SESSION['user'];
        $placed_students = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2,tpc_company as t3 WHERE t1.student_id=t2.stu_id AND t1.company_id=t3.comp_id AND stu_id='$userid' AND placed='Y'") or die(mysql_error());            
           
        $num_of_placements = mysql_num_rows($placed_students);
        echo "<center><h4>Number of Placements = $num_of_placements</h4></center>";       
           
          if($placed_students && $num_of_placements>0){
              $display_string = "<div class='container'>";	                              
              $display_string = "<div class='row'>";	                                            
              $display_string .= "<div class='col-md-8 col-md-offset-2'>";	                              
              $display_string .= "<div class='table-responsive'>";	
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Placed in Company</caption>";	                              
              $display_string .= "<tr>";
              $display_string .= "<th>S.no.</th>";              
              $display_string .= "<th>Company Name</th>";
              $display_string .= "<th>Type</th>";
              $display_string .= "<th>Job Profile</th>"; 
              $display_string .= "<th>Internship</th>";               
              $display_string .= "<th>Package (in lacks)</th>"; 
              
              $display_string .= "</tr>"; 
    
//        $stu_row=mysql_fetch_array($registed_students, MYSQL_ASSOC);
              $i=0; //Increment the counter
                while($row = mysql_fetch_array($placed_students, MYSQL_ASSOC))
                {
                    $i++;
                    $display_string .= "<tr>";
                    $display_string .= "<td>$i</td>";                    
                    $display_string .= "<td>$row[comp_name]</td>";
                    $display_string .= "<td>$row[type]</td>";
                    $display_string .= "<td>$row[job_profile]</td>";                    
                    $display_string .= "<td>$row[stipend]</td>";                    
                    $display_string .= "<td>$row[package]</td>";                                        
                    $display_string .= "<td><img src='images/placed.gif' alt='placed' class='placed_img'/></td>";                                        
                    $display_string .= "</tr>";                
                } 
              $display_string .= "</table>";
              $display_string .= "</div>";      
              $display_string .= "<canvas id='myCanvas' class='animate_placed'></canvas>";              
              $display_string .= "</div></div></div>";                                      

              echo $display_string;
              //      echo "Fetched data successfully\n";
              mysql_free_result($placed_students);
            }//end of IF Placed students
    }
?>
    <script type="text/javascript" src="placed/js/bubbles.js"></script>
    <script type="text/javascript" src="placed/js/main.js"></script>                  
</body>    
</html>    

<?php
    include('footer.php');
?>