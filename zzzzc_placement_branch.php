<html>
<head>
    
</head>
<body>
<?php
    include 'c_header.php';
   include 'bootstrap.php';
           /********************* Branch Wise Result Starts ***********************************/
//         $tot_reg_stu_branch_cse = mysql_num_rows($reg_stu_cse);                   
        echo "    
        <div class='container'>            
        <!-- Select Year -->
        <div style='margin-top:50px;' class='mainbox col-md-3'>                            
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Select Year</div>
                    </div>     

                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='c_placement_branch.php' method='POST' autocomplete='on'>
                                    
                        <div class='form-group'>
                            <label for='rollno' class='col-sm-3 control-label'>Year</label>
                            <div class='col-sm-9'>
                                <div class='controls'>
                                    <div class='input-prepend'>
                                        <select  name='year' class='form-control'>
                                            <option value='2017'>2017</option>
                                            <option value='2016'>2016</option>
                                            <option value='2015'>2015</option>                                                    
                                        </select>             
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class='form-group last'>
                            <div class='col-md-9 col-md-offset-1'>
                                <button type='submit' class='btn btn-success btn-sm' name='search'>Search</button>
                            </div>
                        </div>
                            
                    </form>     
                    
                </div>                     
            </div>  
        </div>    
        <!--  Ends year Column Here-->
";       
       
    /***************************   Year Selected     *************************************/
if(isset($_POST['year'])){
// Depreciate the errors
    error_reporting(E_ALL ^ E_DEPRECATED);
    
    $year = mysql_real_escape_string($_POST['year']); // Set Year variable                      
           
    if($year == '2015'){
           include_once 'connect_2015.php';
    }         
    else if($year == '2016'){
           include_once 'connect_2016.php';
    }
    else{
        include_once 'connect.php';
    }        
    
}

else{
    $year = 2017;
  include_once 'connect.php';
}        
           /********************* Branch Wise Result Starts ***********************************/
//         $tot_reg_stu_branch_cse = mysql_num_rows($reg_stu__cse);                   

           $tot_reg_stu_branch = [];
           $tot_distinct_placed_branch= [];
           $tot_placed_branch = [];
           $branches = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");

           // CSE 
/*
           $reg_stu__cse = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='cse'") or die(mysql_error());
           $tot_reg_stu_branch[0]= mysql_num_rows($reg_stu__cse);        
           
           $placed_distinct_cse = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='cse' AND placed='Y'") or die(mysql_error());
           $tot_distinct_placed_branch[0]= mysql_num_rows($placed_distinct_cse);        

           $placed_cse = mysql_query("SELECT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='cse' AND placed='Y'") or die(mysql_error());
           $tot_placed_branch[0]= mysql_num_rows($placed_cse);        

Similarly other
*/       //end BIO


//           echo "Registered CSE are = " . $tot_reg_stu_branch[0];
//           echo "Placed CSE are = " . $tot_distinct_placed_branch[0];           

              $display_string = "<div class='container'>";	                                         
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-md-9'>";	                              
              $display_string .= "<center><h4>Branch Wise Details - $year</h4></center>";	              
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Result Scenario</caption>";
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Branch</th>";
              $display_string .= "<th>Total Registered</th>";
              $display_string .= "<th>Total Unique Placed</th>";                    
              $display_string .= "<th>Total offers</th>";                    
              $display_string .= "<th>Percentage</th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           
           
          for ($x = 0; $x <= 5; $x++) {              
              $i=$x+1;//variable for S.No.
              $display_string .= "<tbody>";              
              $display_string .= "<tr>";
              $display_string .= "<td>$i</td>";
              $display_string .= "<td>$branches[$x]</td>";              
              $branches[$x]=strtolower($branches[$x]);
              
              $reg_stu = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]'") or die(mysql_error());
              $tot_reg_stu_branch= mysql_num_rows($reg_stu);      
           
              $placed_distinct = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]' AND placed='Y'") or die(mysql_error());
              $tot_distinct_placed_branch= mysql_num_rows($placed_distinct);

              $placed_stu = mysql_query("SELECT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]' AND placed='Y'") or die(mysql_error());
              $tot_placed_branch= mysql_num_rows($placed_stu);        
              
              if($tot_reg_stu_branch!=0){
                  $temp=($tot_distinct_placed_branch/$tot_reg_stu_branch)*100;
                  $percent_branch_placed = round($temp,2);                  
                  //$percent_branch_placed = round(($tot_distinct_placed_branch[$x]/$tot_reg_stu_branch[$x])*100 , 2);
              }
              else
                  $percent_branch_placed= 0;
              
              $display_string .= "<td>$tot_reg_stu_branch</td>";
              $display_string .= "<td>$tot_distinct_placed_branch</td>";
              $display_string .= "<td>$tot_placed_branch</td>";              
              $display_string .= "<td>$percent_branch_placed %</td>";                        
              $display_string .= "</tr>";                            
              $display_string .= "</tbody>";                            
           }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;
           /********************* Ends Branch Wise Result***********************************/
?>