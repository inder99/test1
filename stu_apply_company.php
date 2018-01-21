<!-- Include Header-->
<?php
    include 'stu_header.php';
?>

<!-- Ends Header-->
<html>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php

                if (isset($_SESSION['valid']))
                {
                    if(isset($_GET['action']) && $_GET['action']=="exceed"){
            ?>
                        <script>
                            alert('Package difference is less than 1.5 lakhs, Not Eligible to Apply\nType of the company is same as that of the company you placed in');
                        </script>
            <?php    
                    }//Ends If action package exceed
                    if(isset($_GET['action']) && $_GET['action']=="cgpa_lower"){
            ?>
                        <script>
                            alert('Your CGPA is lower than the CGPA required for the company\n So you are not Eligible to Apply');
                        </script>
            <?php    
                    }//Ends If action cgpa lower
                    if(isset($_GET['action']) && $_GET['action']=="not_eligible"){
            ?>
                        <script>
                            alert('You are not Eligible to Apply');
                        </script>
            <?php    
                    }//Ends If action Not Eligible
                
                    $userid=$_SESSION['user'];        
                    $today = date("Y-m-d");        
                    
                    $stu_retval = mysql_query("SELECT * FROM tpc_students where stu_id='$userid'");
                    $stu_row=mysql_fetch_array($stu_retval, MYSQL_ASSOC);        
        
                    $placed_student_query = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2,tpc_company as t3  WHERE t1.student_id=t2.stu_id AND t1.company_id=t3.comp_id AND stu_id='$userid' AND placed='Y'") or die(mysql_error());          
                    $num_of_placements = mysql_num_rows($placed_student_query);
                    $placed_student = mysql_fetch_array($placed_student_query, MYSQL_ASSOC);
        
                    //      $comp_retval = mysql_query("SELECT * FROM tpc_company where arrival_date>='$today'");        

                    $student_branch=$stu_row["branch"];
        
                    /* Displays at the top of the page*/
                    if($stu_row['debarred']=='Y')      
                        echo "<h4>You are <span class='color_red'><b>Debarred</b></span> FROM the Placement. Kindly contact the     Concerned Authority<h4><br>";   
                    if($num_of_placements>=2)              
                        echo "<br><h4>You are already placed in <b>".$num_of_placements." companies</b>,
                        You are <span class='color_red'><b>Not Eligible</b></span> to apply further</h4><br>";
                    if($placed_student['type']=="consultancy")      
                        echo "<h4>You are Placed in <b>Consultancy</b> Company, So you are <span class='color_red'><b>Not   Eligible</b></span> to apply further</h4>"; 
                    /* Ends Displays at the top of the page*/            

                    
                    $comp_retval = mysql_query("SELECT * FROM tpc_company where branch_$student_branch='Y'");
                    
                    //      echo $comp_retval;      
                    if($comp_retval){                                        
                        $display_string = "<div class='table-responsive'>";	
                        $display_string .= "<table class='table table-striped text_center'>";
                        $display_string .= "<caption>Companies Arriving</caption>";	                              
                        $display_string .= "<tr>";
                        $display_string .= "<th>S.no.</th>";
                        $display_string .= "<th>Company</th>";
                        $display_string .= "<th>Arrival (YYYY-MM-DD)</th>";                    
                        $display_string .= "<th>Type</th>";                              
                        $display_string .= "<th>CGPA</th>";
                        $display_string .= "<th>Package (in lakh)</th>";                             
                        $display_string .= "<th>Job Profile</th>";
                        $display_string .= "<th>Details</th>";                        
                        $display_string .= "<th>Apply</th>";                                
                        $display_string .= "</tr>";
                        
                        $i=0; //Serial number   
                        while($row = mysql_fetch_array($comp_retval, MYSQL_ASSOC))  
                        {   
                            $designation="student";     
                            $search = mysql_query("SELECT company_id, student_id FROM tpc_student_reg WHERE     company_id='".$row["comp_id"]."' AND   student_id='".$stu_row["stu_id"]."'") or die(mysql_error()); 
                            $match  = mysql_num_rows($search);        
                            if(!$match){                        
                                $i++; //Increment the counter of Serial Number Variable
                                $display_string .= "<tr>";
                                $display_string .= "<td>$i</td>";
                                $display_string .= "<td>$row[comp_name]</td>";
                                $display_string .= "<td>$row[arrival_date]</td>";               
                                $display_string .= "<td>$row[type]</td>";                            
                                $display_string .= "<td>$row[cgpa]</td>";                                           
                                $display_string .= "<td>$row[package]</td>";
                                $display_string .= "<td>$row[job_profile]</td>";              
                                
                                $details = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_prev_comp_details.php?id=".$row['c_ntid']."&branch=".$student_branch;
                                $display_string .= "<td><a id='details_company' class='color_green' href='" . $details .  "'>Details</a></td>";

                                
            /**********************         Not Elible to Apply for Company     *******************************/
                                
                                /*******   Type Consultancy or Debarred or Number of Placements >=2    ***************/
                                
                                if($placed_student['type']=="consultancy" || $stu_row['debarred']=='Y' || $num_of_placements>=2){
                                    $action="not_eligible";      
                                    $apply = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_apply_company.php?action=".$action;
                                    $display_string .= "<td><a id='apply_company' class='color_red' href='" . $apply .  "'>Apply</a></td>";              
                                }         
          
                                /***Package Difference greater than 1.5 and type of the companies is same  ************/
                                
                                else if(abs($row['package'] - $placed_student['package']) <= 1.5  &&    $row['type']==$placed_student['type']){
                                    $action="exceed";      
                                    $apply = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_apply_company.php?action=".$action; 
                                    $display_string .= "<td><a id='apply_company' class='color_red' href='" . $apply .  "'>Apply</a></td>"; 
                                    /*
                                    $pack_diff="exceed";
                                    $apply = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?package_diff=exceed";  
                                    echo  $apply;   
                                    */  
                                }   
                                
                                else if($row['cgpa'] > $stu_row['cgpa']){   
                                    $action="cgpa_lower";       
                                    $apply = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_apply_company.php?action=".$action;
                                    $display_string .= "<td><a id='apply_company' class='color_red' href='" . $apply .  "'>Apply</a></td>";                 
                                }                           
                                else{   
                                    $apply = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_applied_student.php?id=" . $row["comp_id"] .        "&rollno=" . $stu_row["rollno"] . "&designation=" . $designation;
                                    $display_string .= "<td><a id='apply_company' href='" . $apply . "'>Apply</a></td>";                  
                                }
                                $display_string .= "</tr>";
                            }
                        } /*Ends While lpp[ for fetching the entire company table for date greater and branch of student*/
                        $display_string .= "</table>";
                        $display_string .= "</div>";
                        echo $display_string;
                        //      echo "Fetched data successfully\n";
                        mysql_free_result($comp_retval);
                    }//ends If structure of schema for display on left side
                }//ends If structure of Valide Session
?>
        </div>
        
        <!--  Applied Companies  -->
        <div class="col-md-4">
<?php
if (isset($_SESSION['valid']))
{
    $userid=$_SESSION['user'];        
    $today = date("Y-m-d");        
        
    $comp_applied=mysql_query("SELECT * FROM tpc_student_reg as t1,tpc_company as t2,tpc_students as t3 WHERE t1.student_id=t3.stu_id AND t1.company_id = t2.comp_id AND branch_$student_branch='Y' AND stu_id='$userid'");

      if($comp_applied){                  
        $display_string = "<div class='table-responsive'>";	
        $display_string .= "<table class='table table-striped text_center'>";
        $display_string .= "<caption>Companies Applied</caption>";	                    
        $display_string .= "<tr>";
        $display_string .= "<th>S.no.</th>";
        $display_string .= "<th>Company</th>";
        $display_string .= "<th>Package</th>";          
        $display_string .= "<th>Type</th>";                    
        $display_string .= "<th>Details</th>";                              
        $display_string .= "</tr>";
    
        $i=0; //Serial number                      
        while($row = mysql_fetch_array($comp_applied,MYSQL_ASSOC))
        {
              $i++; 
              $display_string .= "<tr>";
              $display_string .= "<td>$i</td>";
              $display_string .= "<td>$row[comp_name]</td>";
              $display_string .= "<td>$row[package]</td>";              
              $display_string .= "<td>$row[type]</td>";                            
              $details = "http://$_SERVER[HTTP_HOST]"."/tpc/stu_prev_comp_details.php?id=".$row['c_ntid']."&branch=".$student_branch;
              $display_string .= "<td><a id='details_company' class='color_green' href='" . $details .  "'>Details</a></td>";
            
              $display_string .= "</tr>";
        }// Ends While loop 
        $display_string .= "</table>";
        $display_string .= "</div>";
        echo $display_string;
      }
//      echo "Fetched data successfully\n";
        mysql_free_result($comp_applied);
     // Ends If structure for displaying table at Right Side    
  }//Ends If structure for Valid session        
        

/*      
... This method is also correct but above one is more efficient

      $comp_retval = mysql_query("SELECT * FROM tpc_company where arrival_date>='$today' AND branch_$student_branch='Y'");
      $stu_retval = mysql_query("SELECT stu_id FROM tpc_students where stu_id='$userid'");

      if($comp_retval ){                                                  
        $display_string = "<div class='table-responsive'>";	
        $display_string .= "<table class='table table-striped text_center'>";
        $display_string .= "<caption>Companies Applied</caption>";	                    
        $display_string .= "<tr>";
        $display_string .= "<th>S.no.</th>";
        $display_string .= "<th>Company</th>";
        $display_string .= "<th>Package</th>";          
        $display_string .= "<th>Type</th>";                    
        $display_string .= "</tr>";
    
        $stu_row=mysql_fetch_array($stu_retval, MYSQL_ASSOC);
        $i=0; //Serial number                      
        while($row = mysql_fetch_array($comp_retval, MYSQL_ASSOC))
        {
          $designation="student";   
          $search = mysql_query("SELECT company_id, student_id FROM tpc_student_reg WHERE company_id='".$row["comp_id"]."' AND   student_id='".$stu_row["stu_id"]."'") or die(mysql_error()); 
          $match  = mysql_num_rows($search);        
          if($match){                        
              $i++; 
              $display_string .= "<tr>";
              $display_string .= "<td>$i</td>";
              $display_string .= "<td>$row[comp_name]</td>";
              $display_string .= "<td>$row[package]</td>";              
              $display_string .= "<td>$row[type]</td>";                            
              $display_string .= "</tr>";
           }
        }// Ends While loop 
        $display_string .= "</table>";
        $display_string .= "</div>";
        echo $display_string;
//      echo "Fetched data successfully\n";
        mysql_free_result($comp_retval);
     }// Ends If structure for displaying table at Right Side
*/

?>
            </div>        
        </div>
    </div>    
</body>
</html>

