<?php
include ('stu_header.php');
?>

<?php
if(isset($_GET['email']) && !empty($_GET['email']))
{
    $email = mysql_real_escape_string($_GET['email']); // Set email variable
        
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
        $message=" Password Reset Successfully!<br>
        Your account has been created, you can login with the following credentials <br><br>
                ------------------------<br>
                Username: $email<br>
                
                Go Back to the Home Page of Panjab Unversity Data Set<br><a href='http://$_SERVER[HTTP_HOST]"."/tpc/'>TPC UIET Panjab University</a>
                ";

                echo "Message  = " . $message;
      /*ends localhost activation check*/
    
      require_once('phpmailer/class.phpmailer.php');
      require_once('phpmailer/class.smtp.php');
      define('GUSER', 'imannegi@gmail.com'); // GMail username
      define('GPWD', 'gjimt82'); // GMail password
      $from= 'imannegi@gmail.com';
				
      $from_name='From: Admin TPC UIET Panjab University';
      $subject1="password reset Successfully";
      $body1= " Password Reset Successfully!<br>
        You can login with the following credentials <br><br>
                Go Back to the Home Page of Panjab Unversity Data Set<br><a href='http://$_SERVER[HTTP_HOST]"."/tpc/'>TPC UIET Panjab University</a>
                ";
    
                $to1= $email;                
                /**/
                /**/                
                smtpmailer( $to1, $from, $from_name , $subject1, $body1);

      ob_start();
      echo '<script>alert("Password Reset Successfully, You can now login");</script>';
      header('Refresh: 1; URL=stu_apply_company.php');                
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
<title>Update Password</title>
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
		