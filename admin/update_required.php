<?php
    if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
    @ob_start();     
    ?>
    <?
     error_reporting(E_ALL);
     ini_set("display_errors", 1);

    include('bootstrap.php');
    include('../connect.php');

    ?>
<?php
    if (!isset($_SESSION['valid']) || $_SESSION['user']!="admin") {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>

<?php
    if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['status']) && !empty($_GET['status']))
    {
    $stu_id = @mysql_real_escape_string($_GET['id']); // Set student id variable    
    $stu_email = @mysql_real_escape_string($_GET['email']); // Set student email variable    
    $status = @mysql_real_escape_string($_GET['status']); // Set company id variable        
    
    if($status == "update")
        mysql_query("DELETE FROM temp_tpc_students WHERE stu_id=$stu_id") or die(mysql_error());
    if($status == "delete")    
        mysql_query("DELETE FROM tpc_students WHERE stu_id=$stu_id") or die(mysql_error());

        
    mysql_affected_rows();
        
?>
        <script>
            var reason = prompt("Fill the discrepancy in the form : ", "Error in the form is");            
        </script>    
        <?php $reason= "<script>document.writeln(reason);</script>"; 
        echo $reason
        ?>        

        <?        
                    
    function smtpmailer($to, $from, $from_name, $subject, $body) { 
        global $error;
        $mail = new PHPMailer();  // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465; 
        $mail->Username = GUSER;  
        $mail->Password = GPWD;           
        $mail->SetFrom($from, $from_name);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        
        if(!$mail->Send()) {
            $error = 'Mail error: '.$mail->ErrorInfo; 
            // echo "sdsdfsdfsdf".$error;
            return false;
        } else {
            $error = 'Message sent!';
            // echo"nsdsfsajhf".$error;
            return true;
        }
        echo $error;
    }/*function ends here*/

        
     /* localhost activation check starts*/
        $message=" You need to fill the form again. We found the discrepancy in your form

                ------------------------<br>
                Email: $stu_email<br>
                
                Reason:   $reason<br>
                ------------------------<br>
                ";
        ?>
        <?
        echo "Message  = " . $message;
      /*ends localhost activation check*/
    
      require_once('phpmailer/class.phpmailer.php');
      require_once('phpmailer/class.smtp.php');
      define('GUSER', 'imannegi@gmail.com'); // GMail username
      define('GPWD', 'gjimt82'); // GMail password
      $from= 'imannegi@gmail.com';
				
      $from_name='From: TPC UIET Panjab University Chandigarh';
      $subject1="Applied successfully";
      $body1= " You need to fill the form again. We found the discrepancy in your form

                ------------------------<br>
                Email: $stu_email<br>
                
                Reason:   $reason<br>
                ------------------------<br>
                ";
    
        $to1= $stu_email;
                /**/
                /**/                
        smtpmailer( $to1, $from, $from_name , $subject1, $body1);

      ob_start();
      echo '<script>alert("Student Deleted successfully");</script>';
      header('Refresh: 1; URL=redirect.php?action=delete_student');                
/*                header("Refresh: 5;Location: redirect.php?action=loginpage",TRUE,303);*/
      ob_end_flush();		
}
else{
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}
?>

<html>
<head>
<title>Invalid Signup</title>
<link href="style.css" type="text/css" rel="stylesheet" />
<style>
.statusmsg{
    font-size: 12px; /* Set message font size  */
    padding: 3px; /* Some padding to make some more space for our text  */
    background: #EDEDED; /* Add a background color to our status message   */
    border: 1px solid #DFDFDF; /* Add a border arround our status message   */
}
</style>
    
</head>
<body>

<div class="message">Message</div>

</body>
</html>