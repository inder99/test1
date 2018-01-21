<html>
<head>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<style>
body
{
 width:100%;
 margin:0 auto;
 padding:0px;
 font-family:helvetica;
 background-color:#0B3861;
}
#wrapper
{
 text-align:center;
 margin:0 auto;
 padding:0px;
 width:995px;
}
#output_image
{
 max-width:300px;
}
</style>
</head>
    
<body>

<?php
    include 'stu_header.php';

    if (isset($_SESSION['valid']))
	{
                $userid=$_SESSION['user'];
                $query="select * from tpc_students where stu_id='$userid'";
                $stu_profile=mysql_query($query); 
                
                $row_data=mysql_fetch_row($stu_profile);
                //print_r($row_data);
                
                echo "<br><br>";
                echo "<div class='container'><div class='row'><div class='col-md-10 col-md-offset-2'>";        
        
                if($row_data[31]!=NULL){
                echo "<form method='POST' class='upload-form' action='img_store.php' enctype='multipart/form-data'>
                            <div id='wrapper'>
                                <input type='file' name='myimage' class='upload-file' data-max-size='2048' accept='image/*'         onchange='preview_image(event)'>
                                <img id='output_image'/>    
                                <input type='submit' name='submit_image' value='Change Image'>    
                            </div>                            
                        </form>";
                    
                    //Fetch Image
                    $image_name=$row_data[31];
                    //$image_path=$row["imagepath"];
                    $folder="http://$_SERVER[HTTP_HOST]"."/tpc/uploads/";       
                    echo "<img src=".$folder."".$image_name." class='pull-right' width=150 height=150/>";                          
                }
                else{
                        echo "<form method='POST' class='upload-form' action='img_store.php' enctype='multipart/form-data'>
                                <div id='wrapper'>
                                    <input type='file' name='myimage' class='upload-file' data-max-size='2048' accept='image/*'           onchange='preview_image(event)'>
                                    <img id='output_image'/>    
                                    <input type='submit' name='submit_image' value='Upload Image'>    
                                </div>                            
                            </form>";
                }
        
                echo "<div class='table-responsive'>";
                echo "<table  class='table table-striped'>";                
                echo"<tr><td>First Name</td><td>$row_data[3]</td></tr>";
                echo"<tr><td>Last Name</td><td>$row_data[4]</td></tr>";
                echo"<tr><td>Father Name</td><td>$row_data[5]</td></tr>";
                echo"<tr><td>Mother Name</td><td>$row_data[6]</td></tr>";
                echo"<tr><td>Date of Birth</td><td>$row_data[7]</td></tr>";
                echo"<tr><td>Gender</td><td>$row_data[8]</td></tr>";
                echo"<tr><td>Category</td><td>$row_data[9]</td></tr>";
                echo"<tr><td>Mobile</td><td>$row_data[10]</td></tr>";
                echo"<tr><td>Roll No</td><td>$row_data[11]</td></tr>";
                echo"<tr><td>Course</td><td>$row_data[12]</td></tr>";
                echo"<tr><td>Branch</td><td>$row_data[13]</td></tr>";
                echo"<tr><td>Semester</td><td>$row_data[14]</td></tr>";
                echo"<tr><td>Department</td><td>$row_data[15]</td></tr>";
                echo"<tr><td>CGPA</td><td>$row_data[16]</td></tr>";
                echo"<tr><td>B.E. Passing Year</td><td>$row_data[17]</td></tr>";
                echo"<tr><td>12th percentage</td><td>$row_data[18]</td></tr>";        
                echo"<tr><td>12th Passing Year</td><td>$row_data[19]</td></tr>";
                echo"<tr><td>10th Percentage</td><td>$row_data[20]</td></tr>";        
                echo"<tr><td>10th Passing Year</td><td>$row_data[21]</td></tr>";
                echo"<tr><td>Projects</td><td>$row_data[22]</td></tr>";        
                echo"<tr><td>Address</td><td>$row_data[23]</td></tr>";        
                echo"<tr><td>Reappear</td><td>$row_data[24]</td></tr>";
                echo "</table>";
                echo "</div>";  //Div Responsive Table
                echo "</div></div></div>";        //Container, Row, Column-10 ends here
    }

        mysql_free_result($stu_profile);
?>
    </body>
</html>

<?php
    include('footer.php');
?>