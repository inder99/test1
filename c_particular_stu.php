<html>
<head>
    
</head>
<body>
<?php
    include 'c_header.php';
   include 'bootstrap.php';
?>

<?php
//    if(isset($_GET['action']) && !empty($_GET['action']) && isset($_GET['id']) && !empty($_GET['id']))

    /***************************  Select Company Starts  ************************************/
    if(!isset($_GET['action']))
	{
        echo "    
        <div class='container'>    
        
        <!-- Hello  Select Company Column-->
        <div id='loginbox' style='margin-top:50px;' class='mainbox col-md-6'>                            
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Search Student</div>
                    </div>     

                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='c_particular_stu.php?' method='GET' autocomplete='on'>
                                    
                        <div class='form-group'>
                            <label for='rollno' class='col-sm-3 control-label'>Roll No</label>
                            <div class='col-sm-9'>
                                <input class='form-control' name='rollno' placeholder='ue112233' required='true' type='text'>
                            </div>
                        </div>
                                
                        <div class='form-group'>
                            <label for='rollno' class='col-sm-3 control-label'>Branch</label>
                            <div class='col-sm-9'>
                                <div class='controls'>
                                    <div class='input-prepend'>
                                        <select  name='branch' class='form-control'>
                                            <option value='cse'>CSE</option>
                                            <option value='ece'>ECE</option>        
                                            <option value='mech'>MECH</option>
                                            <option value='it'>IT</option>        
                                            <option value='eee'>EEE</option>
                                            <option value='bio'>BIO</option>                                                    
                                        </select>             
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
                                <button type='submit' class='btn btn-success btn-sm' name='signup'>Search</button>
                                <div class='reset'>
                                    <a href='c_particular_stu.php'>Reset</a>
                                </div>
                            </div>
                        </div>
                            
                    </form>     
                    
                </div>                     
            </div>  
        </div>    
        <!--  Ends Select Company Column Here-->
";       
    }
    /***************************   Ends Select Roll No , Student   ************************************/

    /***************************   Student Selected     *************************************/
   if(isset($_GET['rollno']) && !empty($_GET['rollno']) && isset($_GET['year']) && !empty($_GET['year']) && isset($_GET['branch']) && !empty($_GET['branch']) && isset($_GET['signup'])){
       
           //depraced Warning 
    error_reporting(E_ALL ^ E_DEPRECATED);

//           echo "Student Selected";
        $rollno = strtolower(mysql_real_escape_string($_GET['rollno'])); // Set company rollno variable    
        $branch = mysql_real_escape_string($_GET['branch']); // Set company branch variable               
        $year = mysql_real_escape_string($_GET['year']); // Set Year variable                      
           
        if($year == '2017'){
               include_once 'connect.php';
        }
       
       if($year == '2016'){
               include_once 'connect_2016.php';
        }         
       if($year == '2015'){
               include_once 'connect_2015.php';
        }       
       
       
           $query = mysql_query("SELECT * FROM tpc_students as t1 WHERE rollno='$rollno' AND branch='$branch'") or die(mysql_error());   
           $stu_check = mysql_num_rows($query);    
           
       if($stu_check==1){ 
           $select_student = mysql_fetch_array($query, MYSQL_ASSOC);       
           $stu_id=$select_student['stu_id'];
       
           $stu_placed_query = mysql_query("SELECT * FROM tpc_student_reg as t1, tpc_students as t2, tpc_company as t3 WHERE t2.stu_id='$stu_id' AND t1.student_id=t2.stu_id AND t1.company_id=t3.comp_id AND placed='Y' ORDER BY arrival_date") or die(mysql_error());           
           $num_stu_placed = mysql_num_rows($stu_placed_query); 
       
//      echo $num_rows;        
          echo "<br><br>";              
          if($num_stu_placed > 0){
              $display_string = "<div class='col-md-6'>";                          
              $display_string .= "<center><h4><b>Student Name :</b> $select_student[first_name] $select_student[last_name]</h4></center>";   
              $display_string .= "<div class='table-responsive'>";	
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Placement Details</caption>";     
              if($select_student["imagename"]!=NULL){
                    $image_name=$select_student["imagename"];
                        //$image_path=$row["imagepath"];
                    $folder="http://$_SERVER[HTTP_HOST]"."/tpc/uploads/";    
                    $display_string .= "<center><img src=".$folder."".$image_name." width=150 height=150 alt='$select_student[first_name] $select_student[last_name]'/></center>";
                    $display_string .= "<br>";              
                }
              $display_string .= "<tr>";
              $display_string .= "<th>S.no.</th>";
              $display_string .= "<th>Company Name</th>";
              $display_string .= "<th>Package</th>";                    
              $display_string .= "<th>Type</th>";
              $display_string .= "</tr>"; 
    
//        $stu_row=mysql_fetch_array($reg_stu_not_placed, MYSQL_ASSOC);
             $i=0;// Counter Variable i        
                while($row = mysql_fetch_array($stu_placed_query, MYSQL_ASSOC))
                {
//                    $designation="student";
                    $i++;
                    $display_string .= "<tr>";
                    $display_string .= "<td>$i</td>";
                    $display_string .= "<td>$row[comp_name]</td>";
                    $display_string .= "<td>$row[package]</td>";
                    $display_string .= "<td>$row[type]</td>";
                    $display_string .= "</tr>";                
                } 
              
              $display_string .= "</table>";
              $display_string .= "</div>";
              $display_string .= "</div>";// end col-md-6                        
              echo $display_string;
              //      echo "Fetched data successfully\n";
              $display_string .= "</div>";// end container                                      
            }//end of if registerd students
       else{
        echo "<center><h4>Not placed </h4></center><br><br>";   
       }//end of if else registerd students
       
      if($select_student['debarred']=='N'){
           $debarred = "http://$_SERVER[HTTP_HOST]"."/tpc/c_stu_debarred.php?student_id=" . $stu_id . "&debarred=yes";
           echo "<center><a href='" . $debarred . "' class='color_red''>Want to Debar Student?</a></center>";
      }
      else{
           $debarred = "http://$_SERVER[HTTP_HOST]"."/tpc/c_stu_debarred.php?student_id=" . $stu_id . "&debarred=no";     
           echo "<center><a href='" . $debarred . "'>Remove Debarred?</a></center>";
      }
     mysql_free_result($stu_placed_query);              
   }//end of if student check
else{
    echo "<center><h3 style='margin-top:100px;'>Please fill the correct Information</h3></center><br><br>";   
}//end of if else student check
       
} // end of if get_rollno get_year

    /***************************   Student Selected     *************************************/


?>
</body>    
</html>