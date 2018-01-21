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
    /***************************  Select Company Starts  ************************************/
    if(!isset($_GET['action']))
	{
      $today = date("Y-m-d");        
      $company_name = mysql_query("SELECT DISTINCT comp_id,arrival_date,comp_name,comp_email,type,package,stipend FROM tpc_student_reg as t1,tpc_company as t2 WHERE t1.company_id=t2.comp_id ORDER BY comp_name") or die(mysql_error());         
//      $num_rows = mysql_num_rows($company_name);        
//      echo $num_rows;        
      if($company_name ){                                        
        $display_string = "<div class='container'><div class='row'><div class='col-md-12'>";	  
        $display_string .= "<div class='table-responsive'>";	
        $display_string .= "<br>";	  
        $display_string .= "<table class='table table-striped text_center'>";
        $display_string .= "<caption>Companies Arrived in  <b>$year</b></caption>";    
        $display_string .= "<tr>";
        $display_string .= "<th>S.no.</th>";
        $display_string .= "<th>Arrival Date</th>";                    
        $display_string .= "<th>Name</th>";
//        $display_string .= "<th>Email</th>";          
        $display_string .= "<th>Type</th>";
        $display_string .= "<th>Package (Lakhs)</th>";          
        $display_string .= "<th>Stipend (Rupees)</th>";          
        $display_string .= "<th>Tot. Students Appeared</th>";          
        $display_string .= "<th>Tot. Students Placed</th>";                              
        $display_string .= "<th>Male Placed</th>";                              
        $display_string .= "<th>Female Placed</th>";  
        $display_string .= "<th>CSE</th>";    
        $display_string .= "<th>ECE</th>"; 
        $display_string .= "<th>MECH</th>";
        $display_string .= "<th>IT</th>";                    
        $display_string .= "<th>EEE</th>";                    
        $display_string .= "<th>BIO</th>";
          
        $display_string .= "</tr>";
    
        $i=0;// Counter Variable i                            
        while($row = mysql_fetch_array($company_name, MYSQL_ASSOC))
        {
            $i++;
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?action=comp_selected&id=" . $row["comp_id"] . "&company_name=" . $row["comp_name"] . "&year=" . $year;
            $display_string .= "<tr>";
            $display_string .= "<td>$i</td>";
            $display_string .= "<td>$row[arrival_date]</td>";
            $display_string .= "<td><a href='" . $actual_link . "'>$row[comp_name]</a></td>";
/*            $display_string .= "<td>$row[comp_email]</td>";*/
            $display_string .= "<td>$row[type]</td>";
            $display_string .= "<td>$row[package]</td>";
            $display_string .= "<td>$row[stipend]</td>";            
            
            //Total Registered Students
            $tot_reg_student = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']."") or die(mysql_error());
            $tot_reg_stu_count= mysql_num_rows($tot_reg_student);                               
            //Ends Total Registered Students            

            //Total Placed Students            
            $tot_placed_student = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' ") or die(mysql_error());
            $tot_placed_stu_count= mysql_num_rows($tot_placed_student);                               
            //Ends Total Placed Students                        

            $tot_male_appeared = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND gender='M'") or die(mysql_error());
            $tot_male_appeared_count= mysql_num_rows($tot_male_appeared);

            $tot_male_placed = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND gender='M' AND placed = 'Y' ") or die(mysql_error());
            $tot_male_placed_count= mysql_num_rows($tot_male_placed);
            
            $tot_female_appeared = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND gender='F'") or die(mysql_error());
            $tot_female_appeared_count= mysql_num_rows($tot_female_appeared);
            
            $tot_female_placed = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND gender='F' AND placed = 'Y' ") or die(mysql_error());
            $tot_female_placed_count= mysql_num_rows($tot_female_placed);
            
            if($tot_male_appeared_count==0){
                $percent_male_placed=0;
            }
            else{
                $percent_male_placed=round(($tot_male_placed_count/$tot_male_appeared_count)*100 , 2);                            
            }
            
            if($tot_female_appeared_count==0){
                $percent_female_placed=0;
            }
            else{
                $percent_female_placed=round(($tot_female_placed_count/$tot_female_appeared_count)*100 , 2);            
            }
            
            
            //CSE Placed Students in that company
            $cse_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'cse'") or die(mysql_error());
            $cse_placed_stu_count= mysql_num_rows($cse_placed_student);                               
            //Ends CSE Placed Students                        

            //ECE Placed Students in that company
            $ece_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'ece'") or die(mysql_error());
            $ece_placed_stu_count= mysql_num_rows($ece_placed_student);                               
            //Ends ECE Placed Students                        

            //MECH Placed Students in that company
            $mech_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'mech'") or die(mysql_error());
            $mech_placed_stu_count= mysql_num_rows($mech_placed_student); 
            //Ends MECH Placed Students                        
            
            //IT Placed Students in that company
            $it_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'it'") or die(mysql_error());
            $it_placed_stu_count= mysql_num_rows($it_placed_student); 
            //Ends IT Placed Students                        
            
            //EEE Placed Students in that company
            $eee_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'eee'") or die(mysql_error());
            $eee_placed_stu_count= mysql_num_rows($eee_placed_student); 
            //Ends EEE Placed Students          

            //BIO Placed Students in that company
            $bio_placed_student = mysql_query("SELECT stu_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND t1.company_id=".$row['comp_id']." AND placed = 'Y' AND branch = 'bio'") or die(mysql_error());
            $bio_placed_stu_count= mysql_num_rows($bio_placed_student); 
            //BIO EEE Placed Students          
            
            $display_string .= "<td>$tot_reg_stu_count</td>";
            $display_string .= "<td>$tot_placed_stu_count</td>";                        
            $display_string .= "<td>$percent_male_placed %</td>";
            $display_string .= "<td>$percent_female_placed %</td>";              
                
            $display_string .= "<td>$cse_placed_stu_count</td>";                        
            $display_string .= "<td>$ece_placed_stu_count</td>"; 
            $display_string .= "<td>$mech_placed_stu_count</td>";                        
            $display_string .= "<td>$it_placed_stu_count</td>";                        
            $display_string .= "<td>$eee_placed_stu_count</td>";                        
            $display_string .= "<td>$bio_placed_stu_count</td>";                        
            
            $display_string .= "</tr>";
        }
         
        $display_string .= "</table>";
        $display_string .= "</div>";
        $display_string .= "</div></div></div>";          
        echo $display_string;
//      echo "Fetched data successfully\n";
        mysql_free_result($company_name);
     }
        
  }
    /***************************   Ends Select Company   ************************************/

    /***************************   Company Selected     *************************************/
   if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['company_name']) && !empty($_GET['company_name'])){
       
       if(isset($_GET['year'])){
           //depraced Warning 
           error_reporting(E_ALL ^ E_DEPRECATED);        
           $year = mysql_real_escape_string($_GET['year']); // Set Year variable                      
           
           if($year == '2015')
               include_once 'connect_2015.php';
           else if($year == '2016')
               include_once 'connect_2016.php';
           else
               include_once 'connect.php';
       }
       
       if($_GET['action']=="comp_selected"){           
           echo "Company Selected";
           $comp_id = mysql_real_escape_string($_GET['id']); // Set company id variable    
           $comp_name = mysql_real_escape_string($_GET['company_name']); // Set company id variable               
           
           $registered_students = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND company_id='$comp_id' GROUP BY rollno") or die(mysql_error());                               
           $num_reg_students = mysql_num_rows($registered_students);              
           
           $reg_stu_not_placed = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND company_id='$comp_id' AND placed='N' GROUP BY rollno ORDER BY branch, first_name ASC") or die(mysql_error());                    
                      
//      echo $num_rows;        

          if($reg_stu_not_placed){
              $display_string = "<div class='container'>";	         
              $display_string .= "<center><h3>Company Name : $comp_name - $year</h3></center><br>";    
              $display_string .= "<div class='row'>";//start row 1          
              $display_string .= "<div class='col-md-6'>";            
              $display_string .= "<div class='table-responsive'>";	
              $display_string .= "<table class='table table-striped'>";
              $display_string .= "<caption>Students Registered for $comp_name</caption>";	                                 
              $display_string .= "<h4>Total number of Student Registered = $num_reg_students</h4>";     
              $display_string .= "<tr>";
              $display_string .= "<th>S.no.</th>";
              $display_string .= "<th>Name</th>";
              $display_string .= "<th>Roll No</th>";                    
              $display_string .= "<th>Branch</th>";
              if($year == '2017')//so that previous year details not be modified
                    $display_string .= "<th>Placed</th>";                    
              
              $display_string .= "</tr>"; 
    
//        $stu_row=mysql_fetch_array($reg_stu_not_placed, MYSQL_ASSOC);
             $i=0;// Counter Variable i        
                while($row = mysql_fetch_array($reg_stu_not_placed, MYSQL_ASSOC))
                {
//                    $designation="student";
                    $i++;
                    $placed = "http://$_SERVER[HTTP_HOST]"."/tpc/c_student_placed.php?student_id=" . $row["stu_id"] . "&company_id=" . $comp_id. "&company_name=" . $comp_name;                                                                          
                    $display_string .= "<tr class='table-success'>";
                    $display_string .= "<td>$i</td>";
                    $display_string .= "<td>$row[first_name] $row[last_name]</td>";
                    $display_string .= "<td>$row[rollno]</td>";
                    $display_string .= "<td>$row[branch]</td>";
                    if($year == '2017')
                        $display_string .= "<td><a href='" . $placed . "'>Placed?</a></td>";                                      
                    $display_string .= "</tr>";
                } 
              $display_string .= "</table>";
              $display_string .= "</div>";
              $display_string .= "</div>";// end col-md-6
              echo $display_string;
              //      echo "Fetched data successfully\n";
              mysql_free_result($reg_stu_not_placed);
            }//end of if registerd students
           
          /********************* Placed Students Column Starts here **************************************/
           
           $placed_students = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND company_id='$comp_id' AND placed='Y' GROUP BY rollno ORDER BY branch, first_name ASC") or die(mysql_error());                               
           
           $num_of_students_placed = mysql_num_rows($placed_students);                   
           //echo num_of_students_placed;        
           
           if($num_reg_students!=0){
               $temp=($num_of_students_placed/$num_reg_students)*100;
               $percent_total_placed = round($temp,2);
              //$percent_total_placed = round(($num_of_students_placed/$num_reg_students)*100 , 2);                         
           }
           else
              $percent_total_placed= 0;
           
          if($placed_students){
              $display_string = "<div class='col-md-6'>";	                              
              $display_string .= "<h4>Number of Student Placed = $num_of_students_placed ($percent_total_placed %)</h4>";
              $display_string .= "<div class='table-responsive'>";	
              $display_string .= "<table class='table table-inverse'>";
              $display_string .= "<caption>Students Placed</caption>";	                                                          
              $display_string .= "<tr>";
              $display_string .= "<th>S.no.</th>";
              $display_string .= "<th>Name</th>";
              $display_string .= "<th>Roll No</th>";                    
              $display_string .= "<th>Branch</th>";
              if($year == '2017')
                  $display_string .= "<th>Delete</th>";                                  
              $display_string .= "</tr>"; 
    
             $i=0; //sno variable        
                while($row = mysql_fetch_array($placed_students, MYSQL_ASSOC))
                {
                    $i++;
                    $placed_delete = "http://$_SERVER[HTTP_HOST]"."/tpc/c_student_placed_delete.php?student_id=" . $row["stu_id"] . "&company_id=" . $comp_id. "&company_name=" . $comp_name;                                                                                            
                    $display_string .= "<tr>";
                    $display_string .= "<td>$i</td>";
                    $display_string .= "<td>$row[first_name] $row[last_name]</td>";
                    $display_string .= "<td>$row[rollno]</td>";
                    $display_string .= "<td>$row[branch]</td>";
                    if($year == '2017')
                        $display_string .= "<td><a href='" . $placed_delete . "' class='color_red'>Delete ?</a></td>";            
                    
                    $display_string .= "</tr>";                
                } 
              $display_string .= "</table>";
              $display_string .= "</div>";
              $display_string .= "</div>";// end col-md-6                        
              echo $display_string;
              //      echo "Fetched data successfully\n";
              mysql_free_result($placed_students);
            }//end of IF Placed students
           
           /********************* Ends Placed Students Column here**************************************/
           
           /********************* Branch Wise Result Starts ***********************************/
//         $num_reg_stu_branch_cse = mysql_num_rows($registered_students_cse);                   
           
           $num_reg_stu_branch = [];
           $num_placed_stu_branch= [];
           $branches_upp = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");
//           echo "Registered CSE are = " . $num_reg_stu_branch[0];
//           echo "Placed CSE are = " . $num_placed_stu_branch[0];           
           
           /******   Take care of the . in display string*******/
              $display_string  = "<div class='col-md-6' >";
              $display_string .= "<h4>Branch Wise Details(Only Eligible)</h4>";	              
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Result Scenario</caption>";
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Branch</th>";
              $display_string .= "<th>Total Registered</th>";
              $display_string .= "<th>Total Placed</th>";                    
              $display_string .= "<th>Percentage</th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           
              $display_string .= "<tbody>";                         
          for ($x = 0; $x <= 5; $x++) {              
              //$percent_total_placed = round(($num_of_students_placed/$num_reg_students)*100 , 2);                         
              $branches[$x]=strtolower($branches_upp[$x]);            
              
              $branch_eligible_q = mysql_query("SELECT branch_$branches[$x] FROM tpc_company as t1 WHERE comp_id='$comp_id' AND branch_$branches[$x]='Y'") or die(mysql_error());              
              $branch_eligible= mysql_num_rows($branch_eligible_q);
              
              if($branch_eligible){
                  $i=$x+1;//variable for S.No.
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$branches_upp[$x]</td>";  
              
                  $registered_students = mysql_query("SELECT DISTINCT student_id FROM tpc_student_reg as t1, tpc_students as t2 WHERE t1.student_id=t2.stu_id AND company_id='$comp_id' AND branch='$branches[$x]'") or die(mysql_error());
                  $num_reg_stu_branch= mysql_num_rows($registered_students);
           
                  $placed_students = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2 WHERE         t1.student_id=t2.stu_id AND company_id='$comp_id' AND branch='$branches[$x]' AND placed='Y'") or die(mysql_error());
                  $num_placed_stu_branch= mysql_num_rows($placed_students);        

                  if($num_reg_stu_branch!=0){
                      $temp=($num_placed_stu_branch/$num_reg_stu_branch)*100;
                      $percent_branch_placed = round($temp,2);                  
                      //$percent_branch_placed = round(($num_placed_stu_branch[$x]/$num_reg_stu_branch[$x])*100 , 2);
                  }
                  else
                      $percent_branch_placed= 0;
              
                  $display_string .= "<td>$num_reg_stu_branch</td>";
                  $display_string .= "<td>$num_placed_stu_branch</td>";
                  $display_string .= "<td>$percent_branch_placed %</td>";                        
                  $display_string .= "</tr>";                            
              }//Ends Branch Eligible If
          }
           $display_string .= "</tbody>";                         
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 2
           $display_string .= "</div>";//end container           
           echo $display_string;
           
           /********************* Ends Branch Wise Result***********************************/
           
       }//end if action comp_selected
    }
   /***************************** End Company Selected *************************************/
        echo "    
        <div class='container'>            
        <div class='row'>            
        <!-- Select Year -->
        <div style='margin-top:20px;' class='mainbox col-md-4 col-md-offset-4'>                            
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Select Year</div>
                    </div>     

                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='c_placement_details.php' method='POST' autocomplete='on'>
                                    
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
        </div>    
        <!--  Ends year Column Here-->
";       
?>
</body>    
</html>