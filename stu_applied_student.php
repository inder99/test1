<?php
    if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
    @ob_start();     
    ?>
    <?
     error_reporting(E_ALL);
     ini_set("display_errors", 1);

    include('bootstrap.php');
    include('connect.php');

    ?>
<?php
    if (!isset($_SESSION['valid']) || $_SESSION['user']=="" || $_SESSION['designation'] != "student") {
        header('Location: redirect.php?action=invalid_permission'); 
    } 
?>

<?php
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $userid=$_SESSION['user'];            
    $comp_id = @mysql_real_escape_string($_GET['id']); // Set company id variable    
    
    $stu_retval = mysql_query("select * from tpc_students where stu_id='$userid'");
    $comp_retval = mysql_query("select * from tpc_company where comp_id='$comp_id'");
    
    $stu_row=@mysql_fetch_array($stu_retval, MYSQL_ASSOC);    
    $comp_row=@mysql_fetch_array($comp_retval, MYSQL_ASSOC);        
    
    $email = mysql_real_escape_string($stu_row['stu_email']); // Set email variable    
    $comp_name=mysql_real_escape_string($comp_row['comp_name']); // Set company name variable    
    $rollno=mysql_real_escape_string($stu_row['rollno']); // Set company name variable        
        
    $search = mysql_query("SELECT company_id, student_id FROM tpc_student_reg WHERE company_id='".$comp_id."' AND student_id='".$userid."' ") or die(mysql_error()); 
    
    $match  = mysql_num_rows($search);        
        
    if(!$match){
        mysql_query("INSERT INTO tpc_student_reg(company_id,student_id) VALUES('$comp_id' , '$userid')") or  die(mysql_error());           
                // We have a match, activate the account
        echo '<div class="statusmsg">Registered Successfully for the company</div>';
        //echo '<script>alert("Registered Successfully");</script>';    it's a repetion script , addition also does not matter
        mysql_free_result($search);
        header('Refresh: 1; URL=redirect.php?action=stu_registered');                                
    }
    /* Else is not required as companies applied not displayed on Left Side 
    
    else{
                // No match                
        echo '<div class="statusmsg">You have already applied</div>';
        echo '<script>alert("You have already applied");</script>';
        header('Refresh: 1; URL=apply_company.php?action=stu_registered');                                
    }
    */        
        
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
        $message=" Registered Successfully for the company<br>

                ------------------------<br>
                Roll No: $rollno<br>
                Company Name: $comp_name<br>
                ------------------------<br>
                Go Back to the Home Page of TPC <br><a href='http://$_SERVER[HTTP_HOST]"."/tpc/'>TPC UIET</a>
                ";

                echo "Message  = " . $message;
      /*ends localhost activation check*/
    
      require_once('phpmailer/class.phpmailer.php');
      require_once('phpmailer/class.smtp.php');
      define('GUSER', 'imannegi@gmail.com'); // GMail username
      define('GPWD', 'gjimt82'); // GMail password
      $from= 'imannegi@gmail.com';
				
      $from_name='From: TPC UIET Panjab University Chandigarh';
      $subject1="Applied successfully";
      $body1= "  Registered Successfully for the company<br>

                ------------------------<br>
                Roll No: $rollno<br>
                Company Name: $comp_name<br>
                ------------------------<br>
                Go Back to the Home Page of TPC <br><a href='http://$_SERVER[HTTP_HOST]"."/tpc/'>TPC UIET</a>
                ";
    
                $to1= $email;                
                /**/
                /**/                
                smtpmailer( $to1, $from, $from_name , $subject1, $body1);

      ob_start();
      echo '<script>alert("Email Sent, Successfully Applied for the Company");</script>';
      header('Refresh: 1; URL=redirect.php?action=stu_registered');                
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
<title>Student Registeration</title>
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