<!-- Include Header-->
<?php
    include 'stu_header.php';
?>
<!-- Ends Header-->
<html>
<head>
    
</head>
<body>
<?php
           /********************* Branch Wise Result Starts ***********************************/
//         $tot_reg_stu_branch_cse = mysql_num_rows($reg_stu_cse);                   


    /***************************   Year Selected     *************************************/
if(isset($_GET['id']) && !empty($_GET['branch']) && !empty($_GET['id'])){
    //depraced Warning 
    error_reporting(E_ALL ^ E_DEPRECATED);    
    $id=$_GET['id'];
    $branch=$_GET['branch'];//I am not using branch specific result right now
    
/*
    include_once 'connect_2015.php';         
    include_once 'connect_2016.php';
*/
    include_once 'connect.php';
    
}
            
            $comp_name_query=mysql_query("select comp_name,package FROM tpc.tpc_company WHERE c_ntid='$id'");
            $company_name_fetch=mysql_fetch_array($comp_name_query);
            $comp_name=strtoupper($company_name_fetch["comp_name"]);
            $package = $company_name_fetch["package"];
            $year = date('Y');

              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<center class='color_orange'><h4>Students Placed in <b>$comp_name</b> - $year</h4></center>"; 
              $display_string .= "<center class='color_pink'><h4><b>Package</b> - $package Lacks Per Annum</h4></center>"; 
              $display_string .= "<table class='table table-striped text_center'>";
              $display_string .= "<caption>Result Scenario</caption>";
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Name</th>";           
              $display_string .= "<th>CGPA</th>";
              $display_string .= "<th>Branch</th>";
              $display_string .= "<th>Projects</th>";                    
              $display_string .= "<th>Certification</th>"; 
              $display_string .= "<th>Tech Used</th>";
              $display_string .= "<th>Internship(1)</th>";                    
              $display_string .= "<th>Internship(2)</th>";                    
              $display_string .= "<th>Internship(3)</th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           

//              

              $company_details = mysql_query("select DISTINCT t1.stu_id,t1.first_name,t1.last_name,t1.cgpa,t1.branch,t1.projects,t1.certification,t1.tech_used,t1.internship_1,t1.internship_2,t1.internship_3,t2.comp_id,t2.comp_name,t2.package,t3.student_id,t3.company_id,t3.placed 
              FROM tpc.tpc_students as t1, tpc.tpc_company as t2, tpc.tpc_student_reg as t3 where t1.stu_id=t3.student_id AND t2.comp_id=t3.company_id AND t3.placed='Y' AND t2.c_ntid='$id' ORDER BY t1.branch,t1.first_name") or die(mysql_error());

              echo mysql_num_rows($company_details);
              $i=0;// Counter Variable i                            
              while($row = mysql_fetch_array($company_details, MYSQL_ASSOC))
              {
                  $i=$i+1;//variable for S.No.                  
                  $display_string .= "<tbody>";              
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$row[first_name] $row[last_name]</td>";
                  $display_string .= "<td>$row[cgpa]</td>";
                  $display_string .= "<td>$row[branch]</td>";                  
                  $display_string .= "<td>$row[projects]</td>";            
                  $display_string .= "<td>$row[certification]</td>";                              
                  $display_string .= "<td>$row[tech_used]</td>";            
                  $display_string .= "<td>$row[internship_1]</td>";            
                  $display_string .= "<td>$row[internship_2]</td>";            
                  $display_string .= "<td>$row[internship_3]</td>";                  
                  $display_string .= "</tr>";
                  $display_string .= "</tbody>";
             }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;

?>
