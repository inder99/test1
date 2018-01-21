<html>
<head>
    
</head>
<body>
<?php
    include 'c_header.php';
   include 'bootstrap.php';
           /********************* Branch Wise Result Starts ***********************************/
//         $tot_reg_stu_branch_cse = mysql_num_rows($reg_stu_cse);                   


    /***************************   Year Selected     *************************************/
if(isset($_POST['year'])){
    //depraced Warning 
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
    $year = date('Y');
    include_once 'connect.php';
}               
       
$tot_reg_stu_branch = [];
$tot_distinct_placed_branch= [];
$tot_placed_branch = [];
$branches = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");

//           echo "Registered CSE are = " . $tot_reg_stu_branch[0];
//           echo "Placed CSE are = " . $tot_distinct_placed_branch[0];           

              $display_string = "<div class='container'>";	                                         
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<center class='color_brown'><h4>Yearly Branch Wise Company Details - $year</h4></center>";
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Result Scenario</caption>";
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Branch</th>";
              $display_string .= "<th>No. of Companies</th>";
              $display_string .= "<th>Max Package (in lakhs)</th>";
              $display_string .= "<th>Min Package (in lakhs)</th>";                    
              $display_string .= "<th>Avg Package (in lakhs)</th>";                    
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
              
              $comp_stu_branch = mysql_query("select * from tpc_company where branch_$branches[$x]='Y'");
              $num_of_company = mysql_num_rows($comp_stu_branch);      
              
              $comp_max = mysql_query("select MAX(package) as max from tpc_company where branch_$branches[$x]='Y' GROUP BY branch_$branches[$x]");
              $comp_max_package=mysql_fetch_array($comp_max, MYSQL_ASSOC);

              $comp_min = mysql_query("select MIN(package) as min from tpc_company where branch_$branches[$x]='Y' GROUP BY branch_$branches[$x]");
              $comp_min_package=mysql_fetch_array($comp_min, MYSQL_ASSOC);
              
              // Companies Median Packages will act as an Average Package in Practical Scenario
              $comp_mid = mysql_query("SELECT x.package as mid from tpc_company x, tpc_company y where x.branch_$branches[$x]='Y' GROUP BY x.package HAVING SUM(SIGN(1-SIGN(y.package-x.package)))/COUNT(*) > .5 LIMIT 1");
              $comp_mid_package=@mysql_fetch_array($comp_mid, MYSQL_ASSOC);                  
              //  Source
              // https://stackoverflow.com/questions/1291152/simple-way-to-calculate-median-with-mysql
              
              
              /*
              $comp_avg = mysql_query("select AVG(package) as avg from tpc_company where branch_$branches[$x]='Y' GROUP BY branch_$branches[$x]");
              $comp_avg_package=mysql_fetch_array($comp_avg, MYSQL_ASSOC);              
              $avg_median=round($comp_mid_package['mid'], 2);
              */
              
              $display_string .= "<td>$num_of_company</td>";
              $display_string .= "<td>$comp_max_package[max]</td>";              
              $display_string .= "<td>$comp_min_package[min]</td>";
              $display_string .= "<td>$comp_mid_package[mid]</td>";

              /*************************************************/
              $reg_stu = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]'") or die(mysql_error());
              $tot_reg_stu_branch= mysql_num_rows($reg_stu);      
           
              $placed_distinct = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]' AND placed='Y'") or die(mysql_error());
              $tot_distinct_placed_branch= mysql_num_rows($placed_distinct);

              $placed_stu_offers = mysql_query("SELECT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND branch='$branches[$x]' AND placed='Y'") or die(mysql_error());
              $tot_placed_branch= mysql_num_rows($placed_stu_offers);        
              
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


        echo "    
        <div class='container'>            
        <!-- Select Year -->
        <div style='margin-top:50px;' class='mainbox col-md-offset-3 col-md-6'>
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Select Year</div>
                    </div>     

                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='c_branchwise_details.php' method='POST' autocomplete='on'>
                                    
                        <div class='form-group'>
                            <label for='rollno' class='col-sm-3 control-label'>Year</label>
                            <div class='col-sm-9'>
                                <div class='controls'>
                                    <div class='input-prepend'>
                                        <select  name='year' class='form-control'' >
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
       

           
           /********************* Ends Branch Wise Result***********************************/
?>