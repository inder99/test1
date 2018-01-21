<?php
    include 'stu_header.php';

    if (isset($_SESSION['valid']))
	{
                $userid=$_SESSION['user'];

        $upload_image=$_FILES["myimage"][ "name" ];
        $folder="/opt/lampp/htdocs/tpc/uploads/";
        move_uploaded_file($_FILES["myimage"]["tmp_name"], "$folder".$_FILES["myimage"]["name"]);
        echo $folder;
        echo "<br>Checking....<br><br>";
        echo $upload_image;
        
        $query = "UPDATE tpc_students SET imagename='$upload_image', imagepath='$folder' WHERE stu_id='$userid' ";
        echo $query;
        $check=mysql_query($query) or die(mysql_error());            
        header('Location: stu_profile.php');         
    }
?>