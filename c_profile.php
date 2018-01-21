<?php
    session_start();
    ob_start();
        
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

if(isset($_SESSION['user'])=="")
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title> 
    <style>
        .navbar .nav > li > a{
         padding:15px !important;   
        }
    </style>    
</head>
    
<body>
<?php
    include('c_header.php');
    include('c_signup_company.php');
?>

</body>
</html>