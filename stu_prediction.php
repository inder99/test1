<html>
<head>
    
</head>
<body>
<?php
   include 'stu_header.php';
           /********************* Branch Wise Result Starts ***********************************/
//         $tot_reg_stu_branch_cse = mysql_num_rows($reg_stu_cse);                   


    /***************************   Year Selected     *************************************/
if(isset($_POST['year']) && isset($_POST['comp_type']) && isset($_SESSION['valid'])){
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
    $comp_type = $_POST['comp_type'];
}
else{
    $comp_type='core';
    $year = date('Y');
    include_once 'connect.php';
}
    $selected = 'cse';
    $year = date('Y');

$branch_name = strtoupper($selected);
//$branches = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");
//           echo "Registered CSE are = " . $tot_reg_stu_branch[0];
//           echo "Placed CSE are = " . $tot_distinct_placed_branch[0];           
              echo "<br>";
              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<center class='color_brown'><h4><b>Placement Prediction - $year</b></h4></center>"; 
              $display_string .= "<p class='color_red pull-right'>Disclaimer: Prediction is based only on the basis of previous year analysis and data that you filled</p>"; 
              $display_string .= "</br></br>";	               
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
/*              $display_string .= "<caption>Result Scenario</caption>";*/
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";   
              $display_string .= "<th>Company Name</th>";   
              $display_string .= "<th>Package</th>";
              $display_string .= "<th>Type</th>";
              $display_string .= "</tr>"; 
              $display_string .= "</thead>";           

              $analysis_percentage = mysql_query("
              SELECT
              COUNT(*) total,
              MIN(t1.cgpa) cgpa,
              t2.package package, t2.comp_name comp_name, t2.type type,
              ROUND((SUM(t4.proj_research)/COUNT(*))*100,2) proj_research,ROUND((SUM(t4.proj_web_development)/COUNT(*))*100,2) proj_web_development,ROUND((SUM(t4.proj_android_app)/COUNT(*))*100,2) proj_android_app,ROUND((SUM(t4.proj_software_dev)/COUNT(*))*100,2) proj_software_dev,ROUND((SUM(t4.proj_others)/COUNT(*))*100,2) proj_others,ROUND((SUM(t4.certi_linux)/COUNT(*))*100,2) certi_linux, ROUND((SUM(t4.certi_database)/COUNT(*))*100,2) certi_database ,ROUND((SUM(t4.certi_networking)/COUNT(*))*100,2) certi_networking,ROUND((SUM(t4.certi_soft_skills)/COUNT(*))*100,2) certi_soft_skills,ROUND((SUM(t4.certi_others)/COUNT(*))*100,2) certi_others,ROUND((SUM(t4.tech_c)/COUNT(*))*100,2) tech_c,ROUND((SUM(t4.tech_cpp)/COUNT(*))*100,2) tech_cpp,ROUND((SUM(t4.tech_java)/COUNT(*))*100,2) tech_java ,ROUND((SUM(t4.tech_android)/COUNT(*))*100,2) tech_android ,ROUND((SUM(t4.tech_python)/COUNT(*))*100,2) tech_python ,ROUND((SUM(t4.tech_front_end_dev)/COUNT(*))*100,2) tech_front_end_dev ,ROUND((SUM(t4.tech_back_end_dev)/COUNT(*))*100,2) tech_back_end_dev ,ROUND((SUM(t4.tech_sql)/COUNT(*))*100,2) tech_sql ,ROUND((SUM(t4.tech_embedded_prog)/COUNT(*))*100,2) tech_embedded_prog ,ROUND((SUM(t4.tech_matlab)/COUNT(*))*100,2) tech_matlab ,ROUND((SUM(t4.tech_r_prog)/COUNT(*))*100,2) tech_r_prog ,ROUND((SUM(t4.tech_others)/COUNT(*))*100,2) tech_others, ROUND((SUM(t4.summer_second_year)/COUNT(*))*100,2) summer_second_year, ROUND((SUM(t4.summer_third_year)/COUNT(*))*100,2) summer_third_year
              FROM tpc_students as t1,tpc_company as t2,tpc_student_reg as t3, tpc_predict_placement t4 
              WHERE t1.stu_id=t3.student_id 
              and t1.stu_id=t4.p_stu_id 
              and t2.comp_id=t3.company_id 
              and t3.placed='Y' 
              and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t1.branch='$selected')
              GROUP BY t2.comp_name
              ORDER BY t2.package DESC, t2.comp_name") or die(mysql_error());

//              echo mysql_num_rows($placement_topper);
                $userid=$_SESSION['user'];
                $query="select * from tpc_predict_placement as t1 where t1.p_stu_id='$userid'";
                $stu_profile=mysql_query($query);                 
                $row_data=mysql_fetch_array($stu_profile);

              $i=0;// Counter Variable i                            
              while($row = mysql_fetch_array($analysis_percentage, MYSQL_ASSOC))
              {
                 $count=0;
                  if ($row["proj_research"] >= 0.5 and !$row_data["proj_research"]){
                      $count++;
                  }
                  if ($row["proj_web_development"] >= 0.5 and !$row_data["proj_web_development"]){
                      $count++;                  
                  }
                  if ($row["proj_android_app"] >= 0.5 and !$row_data["proj_android_app"]){
                      $count++;                  
                  }
                  if ($row["proj_software_dev"] >= 0.5 and !$row_data["proj_software_dev"]){
                      $count++;                  
                  }
                  if ($row["proj_others"] >= 0.5 and !$row_data["proj_others"]){
                      $count++;                  
                  }
                  if ($row["certi_linux"] >= 0.5 and !$row_data["certi_linux"]){
                      $count++;                  
                  }
                  if ($row["certi_database"] >= 0.5 and !$row_data["certi_database"]){
                      $count++;
                  }
                  if ($row["certi_networking"] >= 0.5 and !$row_data["certi_networking"]){
                      $count++;
                  }
                  if ($row["certi_soft_skills"] >= 0.5 and !$row_data["certi_soft_skills"]){
                      $count++;
                  }
                  if ($row["certi_others"] >= 0.5 and !$row_data["certi_others"]){
                      $count++;
                  }
                  if ($row["tech_c"] >= 0.5 and !$row_data["tech_c"]){
                      $count++;
                  }
                  if ($row["tech_cpp"] >= 0.5 and !$row_data["tech_cpp"]){
                      $count++;
                  }
                  if ($row["tech_java"] >= 0.5 and !$row_data["tech_java"]){
                      $count++;
                  }
                  if ($row["tech_android"] >= 0.5 and !$row_data["tech_android"]){
                      $count++;
                  }
                  if ($row["tech_python"] >= 0.5 and !$row_data["tech_python"]){
                      $count++;                  
                  }
                  if ($row["tech_front_end_dev"] >= 0.5 and !$row_data["tech_front_end_dev"]){
                      $count++;                  
                  }
                  if ($row["tech_back_end_dev"] >= 0.5 and !$row_data["tech_back_end_dev"]){
                      $count++;                  
                  }
                  if ($row["tech_sql"] >= 0.5 and !$row_data["tech_sql"]){
                      $count++;                  
                  }
                  if ($row["tech_embedded_prog"] >= 0.5 and !$row_data["tech_embedded_prog"]){
                      $count++;                  
                  }
                  if ($row["tech_matlab"] >= 0.5 and !$row_data["tech_matlab"]){
                      $count++;                  
                  }
                  if ($row["tech_r_prog"] >= 0.5 and !$row_data["tech_r_prog"]){
                      $count++;                  
                  }
                  if ($row["tech_others"] >= 0.5 and !$row_data["tech_others"]){
                      $count++;                  
                  }
                  if ($row["summer_second_year"] >= 0.5 and !$row_data["summer_second_year"]){
                      $count++;                  
                  }
                  if ($row["summer_third_year"] >= 0.5 and !$row_data["summer_third_year"]){
                      $count++;                  
                  }

                  $display_string .= "<tbody>";                        
                  if(floatval($count/24) > 0.8){  
                      $i=$i+1;//variable for S.No.                                          
                      $display_string .= "<tr>";                      
                      $display_string .= "<td>$i</td>";
                      $display_string .= "<td>$row[comp_name]</td>";
                      $display_string .= "<td>$row[package]</td>";     
                      $display_string .= "<td>$row[type]</td>";    
                      $display_string .= "</tr>";
                  }
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
              $display_string .= "<center class='color_brown'><h4><b>Placement Analysis - $year</b></h4></center>"; 
              $display_string .= "<div class='table-responsive'>";	           
              $display_string .= "<table class='table table-striped text_center'>";
/*              $display_string .= "<caption>Result Scenario</caption>";*/
              $display_string .= "<thead>";           
              $display_string .= "<tr>";
              $display_string .= "<th>S.No</th>";   
              $display_string .= "<th>Company Name</th>";   
              $display_string .= "<th>Min. CGPA</th>";
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

              $placement_topper = mysql_query("
              SELECT
              COUNT(*) total,
              MIN(t1.cgpa) cgpa,
              t2.package package, t2.comp_name comp_name,
              SUM(t4.proj_research) proj_research,SUM(t4.proj_web_development) proj_web_development,SUM(t4.proj_android_app) proj_android_app,SUM(t4.proj_software_dev) proj_software_dev,SUM(t4.proj_others) proj_others,SUM(t4.certi_linux) certi_linux, SUM(t4.certi_database) certi_database ,SUM(t4.certi_networking) certi_networking,SUM(t4.certi_soft_skills) certi_soft_skills,SUM(t4.certi_others) certi_others,SUM(t4.tech_c) tech_c,SUM(t4.tech_cpp) tech_cpp,SUM(t4.tech_java) tech_java ,SUM(t4.tech_android) tech_android ,SUM(t4.tech_python) tech_python ,SUM(t4.tech_front_end_dev) tech_front_end_dev ,SUM(t4.tech_back_end_dev) tech_back_end_dev ,SUM(t4.tech_sql) tech_sql ,SUM(t4.tech_embedded_prog) tech_embedded_prog ,SUM(t4.tech_matlab) tech_matlab ,SUM(t4.tech_r_prog) tech_r_prog ,SUM(t4.tech_others) tech_others, SUM(t4.summer_second_year) summer_second_year, SUM(t4.summer_third_year) summer_third_year
              FROM tpc_students as t1,tpc_company as t2,tpc_student_reg as t3, tpc_predict_placement t4 
              WHERE t1.stu_id=t3.student_id 
              and t1.stu_id=t4.p_stu_id 
              and t2.comp_id=t3.company_id 
              and t3.placed='Y' 
              and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y' and t7.type='$comp_type')
              GROUP BY t2.comp_name
              ORDER BY t2.package DESC, t2.comp_name") or die(mysql_error());

    
//              echo mysql_num_rows($placement_topper);
                
              $i=0;// Counter Variable i                            
              while($row = mysql_fetch_array($placement_topper, MYSQL_ASSOC))
              {
                  $i=$i+1;//variable for S.No.                  
                  $display_string .= "<tbody>";      
                  $display_string .= "<tr>";
                  $display_string .= "<td>$i</td>";
                  $display_string .= "<td>$row[comp_name]</td>";    
                  $display_string .= "<td>$row[cgpa]</td>";       
                  $display_string .= "<td>$row[package]</td>";       
                  $display_string .= "<td>$row[proj_research]/$row[total]</td>";
                  $display_string .= "<td>$row[proj_web_development]/$row[total]</td>";
                  $display_string .= "<td>$row[proj_android_app]/$row[total]</td>";
                  $display_string .= "<td>$row[proj_software_dev]/$row[total]</td>";
                  $display_string .= "<td>$row[proj_others]/$row[total]</td>";
                  $display_string .= "<td>$row[certi_linux]/$row[total]</td>";
                  $display_string .= "<td>$row[certi_database]/$row[total]</td>";
                  $display_string .= "<td>$row[certi_networking]/$row[total]</td>";
                  $display_string .= "<td>$row[certi_soft_skills]/$row[total]</td>";
                  $display_string .= "<td>$row[certi_others]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_c]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_cpp]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_java]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_android]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_python]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_front_end_dev]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_back_end_dev]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_sql]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_embedded_prog]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_matlab]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_r_prog]/$row[total]</td>";
                  $display_string .= "<td>$row[tech_others]/$row[total]</td>";
                  $display_string .= "<td>$row[summer_second_year]/$row[total]</td>";
                  $display_string .= "<td>$row[summer_third_year]/$row[total]</td>";
                  
                  $display_string .= "</tr>";
                  $display_string .= "</tbody>";
             }
           
           $display_string .= "</table>";
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;
           mysql_free_result($placement_topper);

//$branches = array("CSE", "ECE", "MECH","IT", "EEE", "BIO");
//           echo "Registered CSE are = " . $tot_reg_stu_branch[0];
//           echo "Placed CSE are = " . $tot_distinct_placed_branch[0];           
              echo "<br>";
              echo "<hr>";    
              $display_string = "<div class='container'>"; 
              $display_string .= "<div class='row'>";//start row 1	                                         
              $display_string .= "<div class='col-lg-12 col-md-12 col-sm-12'>";
              $display_string .= "<h2 class='color_pink'>Type : $comp_type</h2>";
              $display_string .= "<center class='color_green'><h4><b>Company Wise Analysis - $year</b></h4></center>"; 

/*              $display_string .= "<caption>Result Scenario</caption>";*/

              $per_placement_topper = mysql_query("
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
              and t2.package >= ALL (select t7.package from tpc_students as t6,tpc_company as t7,tpc_student_reg as t8 where t6.stu_id=t1.stu_id and t6.stu_id=t8.student_id and t7.comp_id=t8.company_id and t8.placed='Y')
              and t2.type='$comp_type'

              GROUP BY t2.comp_name
              ORDER BY t2.package DESC, t2.comp_name") or die(mysql_error());

//              echo mysql_num_rows($placement_topper);
//              $display_string .= "<h2 class='color_pink'>Type : $comp_type</h2>";*/	           

              while($row = mysql_fetch_array($per_placement_topper, MYSQL_ASSOC))
              {
                  $good_pro=array();
                  $suggested_pro=array();      
                  $recommended_pro=array();

                  $good_tech=array();
                  $suggested_tech=array();      
                  $recommended_tech=array();

                  $good_certi=array();
                  $suggested_certi=array();      
                  $recommended_certi=array();

                  $good_intern=array();
                  $suggested_intern=array();      
                  $recommended_intern=array();
                                                      
                  if ($row["proj_research"] >=50 and $row["proj_research"] <70)
                      array_push($good_pro, "Research");
                  if ($row["proj_research"] >=70 and $row["proj_research"] <90)
                      array_push($suggested_pro, "Research");
                  if ($row["proj_research"] >=90)
                      array_push($recommended_pro, "Research");

                  if ($row["proj_web_development"] >=50 and $row["proj_web_development"] <70)
                      array_push($good_pro , "Web Dev");
                  if ($row["proj_web_development"] >=70 and $row["proj_web_development"] <90)
                      array_push($suggested_pro , "Web Dev");
                  if ($row["proj_web_development"] >=90)
                      array_push($recommended_pro , "Web Dev");
                  
                  if ($row["proj_android_app"] >=50 and $row["proj_android_app"] <70)
                      array_push($good_pro , "Android Dev");
                  if ($row["proj_android_app"] >=70 and $row["proj_android_app"] <90)
                      array_push($suggested_pro , "Android Dev");
                  if ($row["proj_android_app"] >=90)
                      array_push($recommended_pro , "Android Dev");
                  
                  if ($row["proj_software_dev"] >=50 and $row["proj_software_dev"] <70)
                      array_push($good_pro , "S/W Dev");
                  if ($row["proj_software_dev"] >=70 and $row["proj_software_dev"] <90)
                      array_push($suggested_pro , "S/W Dev");
                  if ($row["proj_software_dev"] >=90)
                      array_push($recommended_pro , "S/W Dev");
                  
                  
                  if ($row["proj_others"] >=50 and $row["proj_others"] <70)
                      array_push($good_pro , "Other");
                  if ($row["proj_others"] >=70 and $row["proj_others"] <90)
                      array_push($suggested_pro , "Other");
                  if ($row["proj_others"] >=90)
                      array_push($recommended_pro , "Other");
                  
                  
                  if ($row["certi_linux"] >=50 and $row["certi_linux"] <70)
                      array_push($good_certi , "Red Hat");
                  if ($row["certi_linux"] >=70 and $row["certi_linux"] <90)
                      array_push($suggested_certi , "Red Hat");
                  if ($row["certi_linux"] >=90)
                      array_push($recommended_certi , "Red Hat");
                  
                  if ($row["certi_database"] >=50 and $row["certi_database"] <70)
                      array_push($good_certi , "DBMS");
                  if ($row["certi_database"] >=70 and $row["certi_database"] <90)
                      array_push($suggested_certi , "DBMS");
                  if ($row["certi_database"] >=90)
                      array_push($recommended_certi , "DBMS");
                  
                  if ($row["certi_networking"] >=50 and $row["certi_networking"] <70)
                      array_push($good_certi , "N/W CCNA");
                  if ($row["certi_networking"] >=70 and $row["certi_networking"] <90)
                      array_push($suggested_certi , "N/W CCNA");
                  if ($row["certi_networking"] >=90)
                      array_push($recommended_certi , "N/W CCNA");
                  
                  if ($row["certi_soft_skills"] >=50 and $row["certi_soft_skills"] <70)
                      array_push($good_certi , "Soft Skills");
                  if ($row["certi_soft_skills"] >=70 and $row["certi_soft_skills"] <90)
                      array_push($suggested_certi , "Soft Skills");
                  if ($row["certi_soft_skills"] >=90)
                      array_push($recommended_certi , "Soft Skills");
                  
                  
                  if ($row["certi_others"] >=50 and $row["certi_others"] <70)
                      array_push($good_certi , "Others");
                  if ($row["certi_others"] >=70 and $row["certi_others"] <90)
                      array_push($suggested_certi , "Others");
                  if ($row["certi_others"] >=90)
                      array_push($recommended_certi , "Others");
                  
                  
                  if ($row["tech_c"] >=50 and $row["tech_c"] <70)
                      array_push($good_tech , "C");
                  if ($row["tech_c"] >=70 and $row["tech_c"] <90)
                      array_push($suggested_tech , "C");
                  if ($row["tech_c"] >=90)
                      array_push($recommended_tech , "C");
                  
                  if ($row["tech_cpp"] >=50 and $row["tech_cpp"] <70)
                      array_push($good_tech , "C++");
                  if ($row["tech_cpp"] >=70 and $row["tech_cpp"] <90)
                      array_push($suggested_tech , "C++");
                  if ($row["tech_cpp"]>=90)
                      array_push($recommended_tech , "C++");
                  
                  if ($row["tech_java"] >=50 and $row["tech_java"] <70)
                      array_push($good_tech , "Java");
                  if ($row["tech_java"] >=70 and $row["tech_java"] <90)
                      array_push($suggested_tech , "Java");
                  if ($row["tech_java"] >=90)
                      array_push($recommended_tech , "Java");
                      
                  if ($row["tech_android"] >=50 and $row["tech_android"] <70)
                      array_push($good_tech , "Android");
                  if ($row["tech_android"] >=70 and $row["tech_android"] <90)
                      array_push($suggested_tech , "Android");
                  if ($row["tech_android"] >=90)
                      array_push($recommended_tech , "Android");
                     
                  if ($row["tech_python"] >=50 and $row["tech_python"] <70)                      
                      array_push($good_tech , "Python");
                  if ($row["tech_python"] >=70 and $row["tech_python"] <90)
                      array_push($suggested_tech , "Python");
                  if ($row["tech_python"] >=90)
                      array_push($recommended_tech , "Python");
                  
                  if ($row["tech_front_end_dev"] >=50 and $row["tech_front_end_dev"] <70)
                      array_push($good_tech , "Front End Web");
                  if ($row["tech_front_end_dev"] >=70 and $row["tech_front_end_dev"] <90)
                      array_push($suggested_tech , "Front End Web");
                  if ($row["tech_front_end_dev"] >=90)
                      array_push($recommended_tech , "Front End Web");
                  
                  
                  if ($row["tech_back_end_dev"] >=50 and $row["tech_back_end_dev"] <70)
                      array_push($good_tech , "Back End Web");
                  if ($row["tech_back_end_dev"] >=70 and $row["tech_back_end_dev"] <90)
                      array_push($suggested_tech , "Back End Web");
                  if ($row["tech_back_end_dev"] >=90)
                      array_push($recommended_tech , "Back End Web");
                  
                  if ($row["tech_sql"] >=50 and $row["tech_sql"] <70)
                      array_push($good_tech , "SQL");
                  if ($row["tech_sql"] >=70 and $row["tech_sql"] <90)
                      array_push($suggested_tech , "SQL");
                  if ($row["tech_sql"] >=90)
                      array_push($recommended_tech , "SQL");
                  
                  if ($row["tech_embedded_prog"] >=50 and $row["tech_embedded_prog"] <70)
                      array_push($good_tech , "Embedded Prog");
                  if ($row["tech_embedded_prog"] >=70 and $row["tech_embedded_prog"] <90)
                      array_push($suggested_tech , "Embedded Prog");
                  if ($row["tech_embedded_prog"] >=90)
                      array_push($recommended_tech , "Embedded Prog");
                  
                  if ($row["tech_matlab"] >=50 and $row["tech_matlab"] <70)
                      array_push($good_tech , "Matlab");
                  if ($row["tech_matlab"] >=70 and $row["tech_matlab"] <90)
                      array_push($suggested_tech , "Matlab");
                  if ($row["tech_matlab"] >=90)
                      array_push($recommended_tech , "Matlab");
                  
                  if ($row["tech_r_prog"] >=50 and $row["tech_r_prog"] <70)
                      array_push($good_tech , "R Prog");
                  if ($row["tech_r_prog"] >=70 and $row["tech_r_prog"] <90)
                      array_push($suggested_tech , "R Prog");
                  if ($row["tech_r_prog"] >=90)
                      array_push($recommended_tech , "R Prog");
                  
                  if ($row["tech_others"] >=50 and $row["tech_others"] <70)
                      array_push($good_tech , "Others");
                  if ($row["tech_others"] >=70 and $row["tech_others"] <90)
                      array_push($suggested_tech , "Others");
                  if ($row["tech_others"] >=90)
                      array_push($recommended_tech , "Others");

                  if ($row["summer_second_year"] >=50 and $row["summer_second_year"] <70)
                      array_push($good_intern , "Yes");
                  if ($row["summer_second_year"] >=70 and $row["summer_second_year"] <90)
                      array_push($suggested_intern , "Yes");
                  if ($row["summer_second_year"] >=90)
                      array_push($recommended_intern , "Yes");

                  if ($row["summer_third_year"] >=50 and $row["summer_third_year"] <70)
                      array_push($good_intern , "Yes");
                  if ($row["summer_third_year"] >=70 and $row["summer_third_year"] <90)
                      array_push($suggested_intern , "Yes");
                  if ($row["summer_third_year"] >=90)
                      array_push($recommended_intern , "Yes");
                                    
/*
                  $good_pro = rtrim(implode(',', $good_pro), ',');
                  $good_tech = rtrim(implode(',', $good_tech), ',');
                  $good_certi = rtrim(implode(',', $good_certi), ',');
                  $good_intern = rtrim(implode(',', $good_intern), ',');                  
*/                  
                                    
                  $display_string .= "<div class='table-responsive'>";	           
                  $display_string .= "<table class='table table-striped text_center'>";                  
                  $display_string .= "<center><h3>$row[comp_name]</h3>";
                  $display_string .= "<div class='headline_underline'></div>";                  
                  $display_string .= "<h4>Min. CGPA: $row[cgpa], Package: $row[package] Lakh</h4></center>";
                  $display_string .= "<thead>";           
                  $display_string .= "<tr>";
                  $display_string .= "<th></th>";
                  $display_string .= "<th scope='col'>Projects</th>";   
                  $display_string .= "<th scope='col'>Tech_Used</th>";                  
                  $display_string .= "<th scope='col'>Certification</th>";                  
                  $display_string .= "<th scope='col'>Internship</th>";
                  $display_string .= "</tr>"; 
                  $display_string .= "</thead>";           

                  $display_string .= "<tbody>";      

                  /****************** First Row Good to Have ******************/                  
                  
                  $display_string .= "<tr>";
                  $display_string .= "<th scope='row'>Good to Have</th>";                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($good_pro); $i++){
                      $display_string .= "$good_pro[$i]";
                      if($i < (count($good_pro) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($good_tech); $i++){
                      $display_string .= "$good_tech[$i]";
                      if($i < (count($good_tech) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($good_certi); $i++){
                      $display_string .= "$good_certi[$i]";
                      if($i < (count($good_certi) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($good_intern); $i++){
                      $display_string .= "$good_intern[$i]";
                      if($i < (count($good_intern) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";                  
                  $display_string .= "</tr>";
                  
                  /********************   Second Row Suggested **************/ 
                  
                  $display_string .= "<tr>";
                  $display_string .= "<th scope='row'>Suggested</th>";                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($suggested_pro); $i++){
                      $display_string .= "$suggested_pro[$i]";
                      if($i < (count($suggested_pro) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($suggested_tech); $i++){
                      $display_string .= "$suggested_tech[$i]";
                      if($i < (count($suggested_tech) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($suggested_certi); $i++){
                      $display_string .= "$suggested_certi[$i]";
                      if($i < (count($suggested_certi) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($suggested_intern); $i++){
                      $display_string .= "$suggested_intern[$i]";
                      if($i < (count($suggested_intern) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";                  
                  $display_string .= "</tr>";

                  
                  /***************** Third Row Recommended *****************/ 
                  
                  $display_string .= "<tr>";
                  $display_string .= "<th scope='row'>Recommended</th>";
                  $display_string .= "<td>";
                  for($i = 0; $i < count($recommended_pro); $i++){
                      $display_string .= "$recommended_pro[$i]";
                      if($i < (count($recommended_pro) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($recommended_tech); $i++){
                      $display_string .= "$recommended_tech[$i]";
                      if($i < (count($recommended_tech) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($recommended_certi); $i++){
                      $display_string .= "$recommended_certi[$i]";
                      if($i < (count($recommended_certi) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";
                  
                  $display_string .= "<td>";
                  for($i = 0; $i < count($recommended_intern); $i++){
                      $display_string .= "$recommended_intern[$i]";
                      if($i < (count($recommended_intern) -1)){
                          $display_string .= ", ";
                      }
                  }
                  $display_string .= "</td>";                  
                  $display_string .= "</tr>";
                  
                  $display_string .= "</tbody>";
                  $display_string .= "</table>";
                  $display_string .= "</div>";//end div table responsive
             }
           
           $display_string .= "</div>";//end col-md-6
           $display_string .= "</div>";//end row 1
           $display_string .= "</div>";//end container           
           echo $display_string;
           mysql_free_result($per_placement_topper);


  
        echo "    
        <div class='container'>            
        <!-- Select Year -->
        <div style='margin-top:50px;' class='mainbox col-md-offset-3 col-md-6'>
            <div class='panel panel-info' >            
                    <div class='panel-heading'>
                        <div class='panel-title'>Select Year</div>
                    </div>     
                    
                    <div style='padding-top:30px' class='panel-body' >
                        <form id='loginform' class='form-horizontal' role='form' action='stu_analysis.php' method='POST' autocomplete='on'>
                                    
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
                            <label for='rollno' class='col-sm-3 control-label'>Type of Company</label>
                            <div class='col-sm-9'>
                                <div class='controls'>
                                    <div class='input-prepend'>
                                        <select name='comp_type' class='form-control'>
                                            <option value='core'>Core</option>
                                            <option value='non-core'>Non-Core</option>        
                                            <option value='consultancy'>Consultancy</option>
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