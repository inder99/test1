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
if(isset($_POST['year']) && !empty($_POST['branch_selected']) && !empty($_POST['branch_selected'])){
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
    $selected = $_POST['branch_selected'];

}
else{
    $selected = 'cse';
    $year = date('Y');
    include_once 'connect.php';
}


$branch_name = strtoupper($selected);

//$branches = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");
//           echo "Registered CSE are = " . $tot_reg_stu_branch[0];
//           echo "Placed CSE are = " . $tot_distinct_placed_branch[0];           
              echo "<br>";
              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<center class='color_brown'><h4><b>$branch_name  - Placement Analysis - $year</b></h4></center>"; 
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
/*              $display_string .= "<caption>Result Scenario</caption>";*/
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";   
              $display_string .= "<th>Company Name</th>";   
              $display_string .= "<th>Min CGPA</th>";
              $display_string .= "<th>Package</th>";
              $display_string .= "<th>Proj Research</th>";
              $display_string .= "<th>Proj Web Development</th>";
              $display_string .= "<th>Proj Android</th>";
              $display_string .= "<th>Proj Software Dev</th>";
              $display_string .= "<th>Proj Others</th>";
              $display_string .= "<th>Certi Linux</th>";
              $display_string .= "<th>Certi Database</th>";
              $display_string .= "<th>Certi Networking</th>";
              $display_string .= "<th>Certi Soft skills</th>";
              $display_string .= "<th>Certi others</th>";
              $display_string .= "<th>Lang C</th>";
              $display_string .= "<th>Lang CPP</th>";
              $display_string .= "<th>Lang Java</th>";
              $display_string .= "<th>Lang Android</th>";
              $display_string .= "<th>Lang Python</th>";
              $display_string .= "<th>Lang Front End Dev</th>";
              $display_string .= "<th>Lang Back End Dev</th>";
              $display_string .= "<th>Lang SQL</th>";
              $display_string .= "<th>Lang Embedded Prog</th>";
              $display_string .= "<th>Lang Matlab</th>";
              $display_string .= "<th>Lang R </th>";
              $display_string .= "<th>Lang Others</th>";
              $display_string .= "<th>Traing/Intern 2<sup>nd</sup></th>";
              $display_string .= "<th>Traing/Intern 3<sup>rd</sup></th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           


/*
              $placement_topper = mysql_query("
              SELECT
              COUNT(*) total,
              SUM(t1.cgpa) cgpa,
              t2.package package, t2.comp_name comp_name,
              SUM(t4.proj_research) proj_research,SUM(t4.proj_web_development) proj_web_development,SUM(t4.proj_android_app) proj_android_app,SUM(t4.proj_software_dev) proj_software_dev,SUM(t4.proj_others) proj_others,SUM(t4.certi_linux) certi_linux, SUM(t4.certi_database) certi_database ,SUM(t4.certi_networking) certi_networking,SUM(t4.certi_soft_skills) certi_soft_skills,SUM(t4.certi_others) certi_others,SUM(t4.tech_c) tech_c,SUM(t4.tech_cpp) tech_cpp,SUM(t4.tech_java) tech_java ,SUM(t4.tech_android) tech_android ,SUM(t4.tech_python) tech_python ,SUM(t4.tech_front_end_dev) tech_front_end_dev ,SUM(t4.tech_back_end_dev) tech_back_end_dev ,SUM(t4.tech_sql) tech_sql ,SUM(t4.tech_embedded_prog) tech_embedded_prog ,SUM(t4.tech_matlab) tech_matlab ,SUM(t4.tech_r_prog) tech_r_prog ,SUM(t4.tech_others) tech_others, SUM(t4.summer_second_year) summer_second_year, SUM(t4.summer_third_year) summer_third_year
              FROM tpc_students as t1,tpc_company as t2,tpc_student_reg as t3, tpc_predict_placement t4 
              WHERE t1.stu_id=t3.student_id 
              and t1.stu_id=t4.p_stu_id 
              and t2.comp_id=t3.company_id 
              and t3.placed='Y' 
              and t1.branch='$selected' 
              and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t1.branch='$selected')
              and t2.type='core'
              GROUP BY t2.comp_name
              ORDER BY t2.package DESC, t2.comp_name") or die(mysql_error());
*/
              $analysis_percentage = mysql_query("
              SELECT
              COUNT(*) total,
              MIN(t1.cgpa) cgpa,
              t2.package package, t2.comp_name comp_name,
              ROUND((SUM(t4.proj_research)/COUNT(*))*100,2) proj_research,ROUND((SUM(t4.proj_web_development)/COUNT(*))*100,2) proj_web_development,ROUND((SUM(t4.proj_android_app)/COUNT(*))*100,2) proj_android_app,ROUND((SUM(t4.proj_software_dev)/COUNT(*))*100,2) proj_software_dev,ROUND((SUM(t4.proj_others)/COUNT(*))*100,2) proj_others,ROUND((SUM(t4.certi_linux)/COUNT(*))*100,2) certi_linux, ROUND((SUM(t4.certi_database)/COUNT(*))*100,2) certi_database ,ROUND((SUM(t4.certi_networking)/COUNT(*))*100,2) certi_networking,ROUND((SUM(t4.certi_soft_skills)/COUNT(*))*100,2) certi_soft_skills,ROUND((SUM(t4.certi_others)/COUNT(*))*100,2) certi_others,ROUND((SUM(t4.tech_c)/COUNT(*))*100,2) tech_c,ROUND((SUM(t4.tech_cpp)/COUNT(*))*100,2) tech_cpp,ROUND((SUM(t4.tech_java)/COUNT(*))*100,2) tech_java ,ROUND((SUM(t4.tech_android)/COUNT(*))*100,2) tech_android ,ROUND((SUM(t4.tech_python)/COUNT(*))*100,2) tech_python ,ROUND((SUM(t4.tech_front_end_dev)/COUNT(*))*100,2) tech_front_end_dev ,ROUND((SUM(t4.tech_back_end_dev)/COUNT(*))*100,2) tech_back_end_dev ,ROUND((SUM(t4.tech_sql)/COUNT(*))*100,2) tech_sql ,ROUND((SUM(t4.tech_embedded_prog)/COUNT(*))*100,2) tech_embedded_prog ,ROUND((SUM(t4.tech_matlab)/COUNT(*))*100,2) tech_matlab ,ROUND((SUM(t4.tech_r_prog)/COUNT(*))*100,2) tech_r_prog ,ROUND((SUM(t4.tech_others)/COUNT(*))*100,2) tech_others, ROUND((SUM(t4.summer_second_year)/COUNT(*))*100,2) summer_second_year, ROUND((SUM(t4.summer_third_year)/COUNT(*))*100,2) summer_third_year
              FROM tpc_students as t1,tpc_company as t2,tpc_student_reg as t3, tpc_predict_placement t4 
              WHERE t1.stu_id=t3.student_id 
              and t1.stu_id=t4.p_stu_id 
              and t2.comp_id=t3.company_id 
              and t3.placed='Y' 
              and t1.branch='$selected' 
              and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t1.branch='$selected')
              GROUP BY t2.comp_name
              ORDER BY t2.package DESC, t2.comp_name") or die(mysql_error());

//              echo mysql_num_rows($placement_topper);
              $i=0;// Counter Variable i                            
              while($row = mysql_fetch_array($analysis_percentage, MYSQL_ASSOC))
              {
                  
                      
                  $i=$i+1;//variable for S.No.                  
                  $display_string .= "<tbody>";      
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$row[comp_name]</td>";    
                  $display_string .= "<td>$row[cgpa]</td>";       
                  $display_string .= "<td>$row[package]</td>";       
                  $display_string .= "<td>$row[proj_research]</td>";
                  $display_string .= "<td>$row[proj_web_development]</td>";
                  $display_string .= "<td>$row[proj_android_app]</td>";
                  $display_string .= "<td>$row[proj_software_dev]</td>";
                  $display_string .= "<td>$row[proj_others]</td>";
                  $display_string .= "<td>$row[certi_linux]</td>";
                  $display_string .= "<td>$row[certi_database]</td>";
                  $display_string .= "<td>$row[certi_networking]</td>";
                  $display_string .= "<td>$row[certi_soft_skills]</td>";
                  $display_string .= "<td>$row[certi_others]</td>";
                  $display_string .= "<td>$row[tech_c]</td>";
                  $display_string .= "<td>$row[tech_cpp]</td>";
                  $display_string .= "<td>$row[tech_java]</td>";
                  $display_string .= "<td>$row[tech_android]</td>";
                  $display_string .= "<td>$row[tech_python]</td>";
                  $display_string .= "<td>$row[tech_front_end_dev]</td>";
                  $display_string .= "<td>$row[tech_back_end_dev]</td>";
                  $display_string .= "<td>$row[tech_sql]</td>";
                  $display_string .= "<td>$row[tech_embedded_prog]</td>";
                  $display_string .= "<td>$row[tech_matlab]</td>";
                  $display_string .= "<td>$row[tech_r_prog]</td>";
                  $display_string .= "<td>$row[tech_others]</td>";
                  $display_string .= "<td>$row[summer_second_year]</td>";
                  $display_string .= "<td>$row[summer_third_year]</td>";
                  
                  $display_string .= "</tr>";
                  $display_string .= "</tbody>";
             }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;
           mysql_free_result($analysis_percentage);




              echo "<br>";
              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<center class='color_green'><h4><b>$branch_name  - </b> Placement Toppers - $year</h4></center>"; 
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
/*              $display_string .= "<caption>Result Scenario</caption>";*/
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Name</th>";
              $display_string .= "<th>CGPA</th>";
              $display_string .= "<th>Package</th>";
              $display_string .= "<th>Type</th>";
              $display_string .= "<th>Proj Research</th>";
              $display_string .= "<th>Proj Web Development</th>";
              $display_string .= "<th>Proj Android</th>";
              $display_string .= "<th>Proj Software Dev</th>";
              $display_string .= "<th>Proj Others</th>";
              $display_string .= "<th>Certi Linux</th>";
              $display_string .= "<th>Certi Database</th>";
              $display_string .= "<th>Certi Networking</th>";
              $display_string .= "<th>Certi Soft skills</th>";
              $display_string .= "<th>Certi others</th>";
              $display_string .= "<th>Lang C</th>";
              $display_string .= "<th>Lang CPP</th>";
              $display_string .= "<th>Lang Java</th>";
              $display_string .= "<th>Lang Android</th>";
              $display_string .= "<th>Lang Python</th>";
              $display_string .= "<th>Lang Front End Dev</th>";
              $display_string .= "<th>Lang Back End Dev</th>";
              $display_string .= "<th>Lang SQL</th>";
              $display_string .= "<th>Lang Embedded Prog</th>";
              $display_string .= "<th>Lang Matlab</th>";
              $display_string .= "<th>Lang R </th>";
              $display_string .= "<th>Lang Others</th>";
              $display_string .= "<th>Traing/Intern 1<sup>st</sup></th>";
              $display_string .= "<th>Traing/Intern 2<sup>nd</sup></th>";
              $display_string .= "<th>Traing/Intern 3<sup>rd</sup></th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           


              $placement_topper = mysql_query("SELECT DISTINCT t1.stu_id,t1.first_name,t1.last_name,t1.cgpa,
              t2.comp_id,t2.package,t2.type,
              t3.placed,t3.company_id,t3.student_id, t4.proj_research,t4.proj_web_development,t4.proj_android_app,t4.proj_software_dev,t4.proj_others,t4.certi_linux,t4.certi_database,t4.certi_networking,t4.certi_soft_skills,t4.certi_others,t4.tech_c,t4.tech_cpp,t4.tech_java,t4.tech_android,t4.tech_python,t4.tech_front_end_dev,t4.tech_back_end_dev,t4.tech_sql,t4.tech_embedded_prog,t4.tech_matlab,t4.tech_r_prog,t4.tech_others,t4.summer_first_year,t4.summer_second_year,t4.summer_third_year
              FROM tpc_students as t1,tpc_company as t2,tpc_student_reg as t3, tpc_predict_placement t4 
              WHERE t1.stu_id=t3.student_id and t1.stu_id=t4.p_stu_id and t2.comp_id=t3.company_id and t3.placed='Y' and t1.branch='$selected' and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t1.branch='$selected')
              ORDER BY t2.package DESC") or die(mysql_error());
//              echo mysql_num_rows($placement_topper);
              $i=0;// Counter Variable i                            
              while($row = mysql_fetch_array($placement_topper, MYSQL_ASSOC))
              {
                  /* Categorizing CGPA Range*/
                  if($row["cgpa"] >= 9)
                      $cgpa_range = "Excellant";
                  else if($row["cgpa"] >= 8 && $row["cgpa"] < 9)
                      $cgpa_range = "Good";
                  else if($row["cgpa"] >= 7 && $row["cgpa"] < 8)
                      $cgpa_range = "Average";
                  else
                      $cgpa_range = "Poor";
                  /* Ends Categorizing CGPA Range*/                  
                  
                 /* Categorizing Package Range*/      
                  if($row["package"] >= 10)
                      $package_modified = "A+";
                  else if($row["package"] >= 8 && $row["package"] < 10)
                      $package_modified = "A";
                  else if($row["package"] >= 7 && $row["package"] < 8)
                      $package_modified = "B+";
                  else if($row["package"] >= 6 && $row["package"] < 7)
                      $package_modified = "B";
                  else if($row["package"] >= 5 && $row["package"] < 6)
                      $package_modified = "C+";
                  else if($row["package"] >= 4 && $row["package"] < 5)
                      $package_modified = "C";
                  else if($row["package"] >= 3 && $row["package"] < 4)
                      $package_modified = "D+";
                  else if($row["package"] >= 1 && $row["package"] < 3)
                      $package_modified = "D";      
                  else
                      $package_modified = "";
                 /* Ends Categorizing Package Range*/
                      
                  $i=$i+1;//variable for S.No.                  
                  $display_string .= "<tbody>";      
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$row[first_name] $row[last_name]</td>";
                  $display_string .= "<td>$cgpa_range</td>";
                  $display_string .= "<td>$package_modified</td>";
                  $display_string .= "<td>$row[type]</td>";
                  $display_string .= "<td>$row[proj_research]</td>";
                  $display_string .= "<td>$row[proj_web_development]</td>";
                  $display_string .= "<td>$row[proj_android_app]</td>";
                  $display_string .= "<td>$row[proj_software_dev]</td>";
                  $display_string .= "<td>$row[proj_others]</td>";
                  $display_string .= "<td>$row[certi_linux]</td>";
                  $display_string .= "<td>$row[certi_database]</td>";
                  $display_string .= "<td>$row[certi_networking]</td>";
                  $display_string .= "<td>$row[certi_soft_skills]</td>";
                  $display_string .= "<td>$row[certi_others]</td>";
                  $display_string .= "<td>$row[tech_c]</td>";
                  $display_string .= "<td>$row[tech_cpp]</td>";
                  $display_string .= "<td>$row[tech_java]</td>";
                  $display_string .= "<td>$row[tech_android]</td>";
                  $display_string .= "<td>$row[tech_python]</td>";
                  $display_string .= "<td>$row[tech_front_end_dev]</td>";
                  $display_string .= "<td>$row[tech_back_end_dev]</td>";
                  $display_string .= "<td>$row[tech_sql]</td>";
                  $display_string .= "<td>$row[tech_embedded_prog]</td>";
                  $display_string .= "<td>$row[tech_matlab]</td>";
                  $display_string .= "<td>$row[tech_r_prog]</td>";
                  $display_string .= "<td>$row[tech_others]</td>";
                  $display_string .= "<td>$row[summer_first_year]</td>";
                  $display_string .= "<td>$row[summer_second_year]</td>";
                  $display_string .= "<td>$row[summer_third_year]</td>";
                  $display_string .= "</tr>";
                  $display_string .= "</tbody>";
             }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;
           mysql_free_result($placement_topper);
              
              echo "<br><hr>";
              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<center class='color_blue'><h4><b>$branch_name  - </b> Academics Toppers - $year</h4></center>";
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
/*              $display_string .= "<caption>Result Scenario</caption>";*/
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";           
              $display_string .= "<th>Name</th>";
              $display_string .= "<th>CGPA</th>";
              $display_string .= "<th>Package</th>";
              $display_string .= "<th>Type</th>";
              $display_string .= "<th>Proj Research</th>";
              $display_string .= "<th>Proj Web Development</th>";
              $display_string .= "<th>Proj Android</th>";
              $display_string .= "<th>Proj Software Dev</th>";
              $display_string .= "<th>Proj Others</th>";
              $display_string .= "<th>Certi Linux</th>";
              $display_string .= "<th>Certi Database</th>";
              $display_string .= "<th>Certi Networking</th>";
              $display_string .= "<th>Certi Soft skills</th>";
              $display_string .= "<th>Certi others</th>";
              $display_string .= "<th>Lang C</th>";
              $display_string .= "<th>Lang CPP</th>";
              $display_string .= "<th>Lang Java</th>";
              $display_string .= "<th>Lang Android</th>";
              $display_string .= "<th>Lang Python</th>";
              $display_string .= "<th>Lang Front End Dev</th>";
              $display_string .= "<th>Lang Back End Dev</th>";
              $display_string .= "<th>Lang SQL</th>";
              $display_string .= "<th>Lang Embedded Prog</th>";
              $display_string .= "<th>Lang Matlab</th>";
              $display_string .= "<th>Lang R </th>";
              $display_string .= "<th>Lang Others</th>";
              $display_string .= "<th>Traing/Intern 1<sup>st</sup></th>";
              $display_string .= "<th>Traing/Intern 2<sup>nd</sup></th>";
              $display_string .= "<th>Traing/Intern 3<sup>rd</sup></th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           


              $acedamic_topper = mysql_query("
              SELECT * FROM
              (
              SELECT t1.stu_id,t1.first_name,t1.last_name,t1.cgpa,
              t2.comp_id,t2.package,t2.type,
              t3.placed,t3.company_id,t3.student_id, t4.proj_research,t4.proj_web_development,t4.proj_android_app,t4.proj_software_dev,t4.proj_others,t4.certi_linux,t4.certi_database,t4.certi_networking,t4.certi_soft_skills,t4.certi_others,t4.tech_c,t4.tech_cpp,t4.tech_java,t4.tech_android,t4.tech_python,t4.tech_front_end_dev,t4.tech_back_end_dev,t4.tech_sql,t4.tech_embedded_prog,t4.tech_matlab,t4.tech_r_prog,t4.tech_others,t4.summer_first_year,t4.summer_second_year,t4.summer_third_year
              FROM tpc_students as t1 
              JOIN tpc_student_reg as t3 ON t1.stu_id=t3.student_id 
              JOIN tpc_company as t2 ON t2.comp_id=t3.company_id 
              JOIN tpc_predict_placement as t4 ON t4.p_stu_id=t1.stu_id
              WHERE t3.placed='Y' and t1.branch='$selected' and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t1.branch='$selected')
              
              UNION
              
              SELECT t1.stu_id,t1.first_name,t1.last_name,t1.cgpa,
              NULL,NULL,NULL,
              t3.placed,NULL,t3.student_id, t4.proj_research,t4.proj_web_development,t4.proj_android_app,t4.proj_software_dev,t4.proj_others,t4.certi_linux,t4.certi_database,t4.certi_networking,t4.certi_soft_skills,t4.certi_others,t4.tech_c,t4.tech_cpp,t4.tech_java,t4.tech_android,t4.tech_python,t4.tech_front_end_dev,t4.tech_back_end_dev,t4.tech_sql,t4.tech_embedded_prog,t4.tech_matlab,t4.tech_r_prog,t4.tech_others,t4.summer_first_year,t4.summer_second_year,t4.summer_third_year
              FROM tpc_students as t1 
              LEFT JOIN tpc_student_reg as t3 ON t1.stu_id=t3.student_id 
              JOIN tpc_predict_placement as t4 ON t4.p_stu_id=t1.stu_id              
              WHERE t1.branch='$selected' and t1.stu_id NOT IN (select student_id from tpc_student_reg as t5 where t5.placed='Y' )
              ) a
              GROUP BY first_name
              ORDER BY cgpa DESC;
                          ") or die(mysql_error());
              //echo mysql_num_rows($placement_topper);
              $i=0;// Counter Variable i                             
              while($row = mysql_fetch_array($acedamic_topper, MYSQL_ASSOC))
              {
                  /* Categorizing CGPA Range*/
                  if($row["cgpa"] >= 9)
                      $cgpa_range = "Excellant";
                  else if($row["cgpa"] >= 8 && $row["cgpa"] < 9)
                      $cgpa_range = "Good";
                  else if($row["cgpa"] >= 7 && $row["cgpa"] < 8)
                      $cgpa_range = "Average";
                  else
                      $cgpa_range = "Poor";
                  /* Ends Categorizing CGPA Range*/                  
                  
                 /* Categorizing Package Range*/      
                  if($row["package"] >= 10)
                      $package_modified = "A+";
                  else if($row["package"] >= 8 && $row["package"] < 10)
                      $package_modified = "A";
                  else if($row["package"] >= 7 && $row["package"] < 8)
                      $package_modified = "B+";
                  else if($row["package"] >= 6 && $row["package"] < 7)
                      $package_modified = "B";
                  else if($row["package"] >= 5 && $row["package"] < 6)
                      $package_modified = "C+";
                  else if($row["package"] >= 4 && $row["package"] < 5)
                      $package_modified = "C";
                  else if($row["package"] >= 3 && $row["package"] < 4)
                      $package_modified = "D+";
                  else if($row["package"] >= 1 && $row["package"] < 3)
                      $package_modified = "D";      
                  else
                      $package_modified = "";
                 /* Ends Categorizing Package Range*/
                                        
                  $i=$i+1;//variable for S.No.                  
                  $display_string .= "<tbody>";              
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$row[first_name] $row[last_name]</td>";
                  $display_string .= "<td>$cgpa_range</td>";
                  $display_string .= "<td>$package_modified</td>";
                  $display_string .= "<td>$row[type]</td>";
                  $display_string .= "<td>$row[proj_research]</td>";
                  $display_string .= "<td>$row[proj_web_development]</td>";
                  $display_string .= "<td>$row[proj_android_app]</td>";
                  $display_string .= "<td>$row[proj_software_dev]</td>";
                  $display_string .= "<td>$row[proj_others]</td>";
                  $display_string .= "<td>$row[certi_linux]</td>";
                  $display_string .= "<td>$row[certi_database]</td>";
                  $display_string .= "<td>$row[certi_networking]</td>";
                  $display_string .= "<td>$row[certi_soft_skills]</td>";
                  $display_string .= "<td>$row[certi_others]</td>";
                  $display_string .= "<td>$row[tech_c]</td>";
                  $display_string .= "<td>$row[tech_cpp]</td>";
                  $display_string .= "<td>$row[tech_java]</td>";
                  $display_string .= "<td>$row[tech_android]</td>";
                  $display_string .= "<td>$row[tech_python]</td>";
                  $display_string .= "<td>$row[tech_front_end_dev]</td>";
                  $display_string .= "<td>$row[tech_back_end_dev]</td>";
                  $display_string .= "<td>$row[tech_sql]</td>";
                  $display_string .= "<td>$row[tech_embedded_prog]</td>";
                  $display_string .= "<td>$row[tech_matlab]</td>";
                  $display_string .= "<td>$row[tech_r_prog]</td>";
                  $display_string .= "<td>$row[tech_others]</td>";
                  $display_string .= "<td>$row[summer_first_year]</td>";
                  $display_string .= "<td>$row[summer_second_year]</td>";
                  $display_string .= "<td>$row[summer_third_year]</td>";
                  
/*

                  if($row["comp_name"]==NULL){
                      $display_string .= "<td>NULL</td>";                  
                      $display_string .= "<td>NULL</td>";                              
                  }

                  if($row["placed"]=='Y'){
                      $display_string .= "<td>$row[comp_name]</td>";                  
                      $display_string .= "<td>$row[package]</td>";                              
                  }
                  else{
                      $display_string .= "<td>---</td>";                 
                      $display_string .= "<td>---</td>";                 
                  }
*/
                  $display_string .= "</tr>";
                  $display_string .= "</tbody>";
             }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;

           mysql_free_result($acedamic_topper);

        echo "    
        <div class='container'>            
        <!-- Select Year -->
        <div style='margin-top:50px;' class='mainbox col-md-offset-3 col-md-6'>
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Select Year</div>
                    </div>     
                    
                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='c_prediction.php' method='POST' autocomplete='on'>
                                    
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
                                
                        <div class='form-group'>
                            <label for='rollno' class='col-sm-3 control-label'>Branch</label>
                            <div class='col-sm-9'>
                                <div class='controls'>
                                    <div class='input-prepend'>
                                        <select name='branch_selected' class='form-control'>
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