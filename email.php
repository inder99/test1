<?php
    session_start();
    ob_start();
        
    
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

if(isset($_SESSION['user'])!=""){
    header("Location: about.php");
}

include('bootstrap.php');

?>

<?php
        
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
                ------------------------<br>

                ";


      /*ends localhost activation check*/
    
      require_once('phpmailer/class.phpmailer.php');
      require_once('phpmailer/class.smtp.php');
      define('GUSER', 'imannegi@gmail.com'); // GMail username
      define('GPWD', 'gjimt82'); // GMail password
      $from= 'imannegi@gmail.com';
				
      $from_name='From: Admin PU DataSet';
      $subject1="PU Dataset Email Verification ";
      $body1= " Password Reset Successfully!<br>
        Your account has been created, you can login with the following credentials <br><br>
                ------------------------<br>
                ";
    
                $to1= $email;                
                /**/
                /**/                
                smtpmailer( $to1, $from, $from_name , $subject1, $body1);

      ob_start();
      echo '<script>alert("Password Reset Successfully, You can now login");</script>';

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
<title>Email</title>

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
		
