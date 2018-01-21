<?php
    if(function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }
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
        } 
        else 
        {
            $error = 'Message sent!';
             // echo"nsdsfsajhf".$error;
		   return true;
	   }
    }

if(isset($_SESSION['user'])!="")
{
    header("Location: stu_profile.php");
}

if(isset($_POST['submit'])){
    $message=NULL;    
	if($_POST['stu_password'] != $_POST['confirm_password']){ 
        $message = 'Passwords should be same<br>'; 
	}
    
	if(is_null($message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "SELECT stu_id FROM temp_tpc_students where stu_email = '" . $_POST["stu_email"] . "'";
		$count = $db_handle->numRows($query);

        $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b            
        
		if($count==0) {
            $timestamp=time();
            if($_POST["internship1"]=="" || $_POST["summer_first_year"]=="NULL"){
                $_POST["summer_first_year"]=NULL;
            }
			$query = "INSERT INTO temp_tpc_students (stu_email, stu_password,first_name, last_name,father_name,mother_name,dob, gender,category,mobile,rollno,course,branch,semester,dept,cgpa,be_pass_year,twelveth_marks,twelveth_year,tenth_marks,tenth_year,projects,certification,tech_used,internship_1,internship_2,internship_3,address,reappear,hash,timestamp_email,
            proj_research,proj_web_development,proj_android_app,proj_software_dev,proj_others,certi_linux,certi_database,certi_networking,certi_soft_skills,certi_others,tech_c,tech_cpp,tech_java,tech_android,tech_python,tech_front_end_dev,tech_back_end_dev,tech_sql,tech_embedded_prog,tech_matlab,tech_r_prog,tech_others,summer_first_year,summer_second_year,summer_third_year) 
            VALUES
			('" . strtolower($_POST["stu_email"]) . "', '" . md5(mysql_real_escape_string($_POST["stu_password"])) . "','" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "', '" . $_POST["father_name"] . "',  '" . $_POST["mother_name"] . "','" . $_POST["dob"] . "', '" . $_POST["gender"] . "','" . $_POST["category"] . "', '" . $_POST["mobile"] . "', '" . strtolower($_POST["rollno"]) . "','" . $_POST["course"] . "', '" . $_POST["branch"] . "','" . $_POST["semester"] . "', '" . $_POST["dept"] . "', '" . $_POST["cgpa"] . "', '" . $_POST["be_pass_year"] . "', '" . $_POST["twelveth_marks"] . "', '" . $_POST["twelveth_year"] . "', '" . $_POST["tenth_marks"] . "', '" . $_POST["tenth_year"] . "', '" . $_POST["projects"] . "', '" . $_POST["certification"] . "', '" . $_POST["tech_used"] . "', '" . $_POST["internship1"] . "', '" . $_POST["internship2"] . "', '" . $_POST["internship3"] . "','" . $_POST["address"] . "','" . $_POST["reappear"] . "' , '$hash','$timestamp'
            , '" . $_POST["proj_research"] . "', '" . $_POST["proj_web_development"] . "', '" . $_POST["proj_android_app"] . "', '" . $_POST["proj_software_dev"] . "', '" . $_POST["proj_others"] . "', '" . $_POST["certi_linux"] . "', '" . $_POST["certi_database"] . "', '" . $_POST["certi_networking"] . "', '" . $_POST["certi_soft_skills"] . "', '" . $_POST["certi_others"] . "', '" . $_POST["tech_c"] . "', '" . $_POST["tech_cpp"] . "', '" . $_POST["tech_java"] . "', '" . $_POST["tech_android"] . "', '" . $_POST["tech_python"] . "', '" . $_POST["tech_front_end_dev"] . "', '" . $_POST["tech_back_end_dev"] . "', '" . $_POST["tech_sql"] . "', '" . $_POST["tech_embedded_prog"] . "', '" . $_POST["tech_matlab"] . "', '" . $_POST["tech_r_prog"] . "', '" . $_POST["tech_others"] . "', '" . $_POST["summer_first_year"] . "', '" . $_POST["summer_second_year"] . "', '" . $_POST["summer_third_year"] . "'
            )";
            $current_id = $db_handle->insertQuery($query);
            if(!empty($current_id)) {
                
                $email = $_POST["stu_email"];
                $password = $_POST["stu_password"];
                $designation="student";

            /* localhost activation check starts*/
				$actual_link = "http://$_SERVER[HTTP_HOST]"."/tpc/activate.php?email=" . $email . "&hash=" . $hash . "&designation=" . $designation;                          
                $message1=" Thanks for signing up!<br>
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.<br><br>
                ------------------------<br>
                Username: $email<br>
                Password: $password<br>
                ------------------------<br>
                <br>
                Please click this link to activate your account:<br><a href='" . $actual_link . "'>" . $actual_link . "</a>
                <br>
                Your Account will be activated soon after the verfication of your details
                ";

                echo "Message  = " . $message1;
             /*ends localhost activation check*/            }
            
            /* start email code*/
                require_once('phpmailer/class.phpmailer.php');
                require_once('phpmailer/class.smtp.php');
                define('GUSER', 'inder@gmail.com'); // GMail username
                define('GPWD', 'inder'); // GMail password
                $from= 'inder@gmail.com';
				$actual_link = "http://$_SERVER[HTTP_HOST]"."/tpc/activate.php?email=" . $email . "&hash=" . $hash . "&designation=" . $designation;                                          
/*
				$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?email=" . $email . "&hash=" . $hash . "&designation=" . $designation;              
*/
                $from_name='From: Admin\r\n';
                $subject1="TPC Email Verification ";
                $body1= " 
                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.<br><br>
 
                Please click this link to activate your account:<br><a href='" . $actual_link . "'>" . $actual_link . "</a>
                <br>
                Your Account will be activated soon after the verfication of your details
                ";

                $to1= $email;                
                /**/
                /**/                
                smtpmailer( $to1, $from, $from_name , $subject1, $body1);

                ob_start();

                header('Refresh: 3; URL=redirect.php?action=loginpage');                
/*                header("Refresh: 5;Location: redirect.php?action=loginpage",TRUE,303);*/
                ob_end_flush();		
            
            /* ends email code*/
        }
	    else {
			$message = "User Email is already in use";	
		}
	}
    else{
        ?>
        <script>alert('error while registering you...');</script>
        <?php        
    }
}
?>
<html>
<head>
  <title>SignUp Student</title>
  <link rel="stylesheet" href="./signup/css/reset.min.css" type="text/css">
  <link rel="stylesheet" href="./signup/css/style.css" type="text/css">  
</head>
<body>
<form  id="msform" name="student_reg" class="ms_form_left" method="post" action="">
<?php if(isset($message)) { ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Account Setup</li>
            <li>Personal Details</li>            
            <li>Academics</li>
        </ul>
    
        <fieldset>
            <h2 class="fs-title">Student Registration</h2>
            <h3 class="fs-subtitle">This is step 1</h3>
            <label style="text-align:left;">Email<span class="color_red">*</span></label>
            <input type="email" name="stu_email" placeholder="Email" value="<?php if(isset($_POST['stu_email'])) echo $_POST['stu_email']; ?>" onblur="ValidateEmail(this);" autofocus required/>                         
            <label class="align_left">Password<span class="color_red">*</span></label>
            <input type="password" name="stu_password" placeholder="Password" value="<?php if(isset($_POST['stu_password'])) echo $_POST['stu_password']; ?>" onblur="ValidatePassword(this);" required/>            
            <label class="align_left">Confirm Password<span class="color_red">*</span></label>                        
            <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php if(isset($_POST['confirm_password'])) echo $_POST['confirm_password']; ?>"  onblur="ConfirmPassword(this);" required/>

<!--
            <label class="align_left">Choose a file to upload: </label>                        
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> 1000KB
            <input name="uploadedfile" type="file" /><br />           
-->
            
            <input type="button" name="next" class="next action-button" value="Next"/>
                        
            
        </fieldset>
    
        <!-- /***************************   Personal Details   ***********************************************/   -->
        
        <fieldset>
            <h2 class="fs-title">Personal Details</h2>
            <h3 class="fs-subtitle">Your Personal Info</h3>
            <!--   Student Designation Field-->
            <label class="align_left">First Name<span class="color_red">*</span></label>
            <input type="text" name="first_name" placeholder="First Name"  value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" maxlength="20" autofocus required/>
            <label class="align_left">Last Name</label>            
            <input type="text" name="last_name" placeholder="Last Name"  value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>"  maxlength="20"/>
            <label class="align_left">Father's Name<span class="color_red">*</span></label>            
            <input type="text" name="father_name" placeholder="(Don't include Mr./Sh.)"  value="<?php if(isset($_POST['father_name'])) echo $_POST['father_name']; ?>"  maxlength="30" required/>        
            <label class="align_left">Mother Name<span class="color_red">*</span></label>            
            <input type="text" name="mother_name" placeholder="(Don't include Smt.)"  value="<?php if(isset($_POST['mother_name'])) echo $_POST['mother_name']; ?>"  maxlength="30" required/>
            <label class="align_left">Date of Birth<span class="color_red">*</span></label>            
            <input type="date" name="dob" placeholder="YYYY-MM-DD"  value="<?php if(isset($_POST['dob'])) echo $_POST['dobl']; ?>"  required/>            
            <label class="align_left">Gender<span class="color_red">*</span></label>                    
            <select  name="gender"  value="<?php if(isset($_POST['gender'])) echo $_POST['gender']; ?>" >
                <option value="M">MALE</option>
                <option value="F">FEMALE</option>
                <option value="T">OTHERS</option>
            </select>                        
            
            <label class="align_left">Category<span class="color_red">*</span></label>                    
            <select  name="category"  value="<?php if(isset($_POST['category'])) echo $_POST['category']; ?>" >
                <option value="Unreserved">Unreserved</option>
                <option value="OBC">OBC</option>                
                <option value="SC">SC</option>
                <option value="ST">ST</option>
                <option value="Others">Others</option>
            </select>                        
            
            <label class="align_left">12th Percentage<span class="color_red">*</span></label>            
            <input type="tel" name="twelveth_marks" placeholder="Don't include '%'" value="<?php if(isset($_POST['twelveth_marks'])) echo $_POST['twelveth_marks']; ?>"  onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" required/>
            <label class="align_left">12th Passing year<span class="color_red">*</span></label>            
            <input type="tel"  name="twelveth_year" placeholder="2014"  value="<?php if(isset($_POST['twelveth_year'])) echo $_POST['twelveth_year']; ?>" onKeyDown="if(this.value.length==4 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/>
            
            <label class="align_left">10th Percentage<span class="color_red">*</span></label>            
            <input type="tel"  name="tenth_marks" placeholder="Don't include '%'"  value="<?php if(isset($_POST['tenth_marks'])) echo $_POST['tenth_marks']; ?>" onKeyDown="if(this.value.length==5 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/>    
            <label class="align_left">10th Passing Year<span class="color_red">*</span></label>            
            <input type="tel"  name="tenth_year" placeholder="2012"  value="<?php if(isset($_POST['tenth_year'])) echo $_POST['tenth_year']; ?>" onKeyDown="if(this.value.length==4 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/> 

            <label class="align_left">Mobile<span class="color_red">*</span></label>            
            <input type="tel" name="mobile" placeholder="Don't include +91 / 0"  value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']; ?>"  onKeyDown="if(this.value.length==10 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;" required/>
            
            <label class="align_left">Address<span class="color_red">*</span></label>                  
            <textarea name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"  maxlenght="120" required>
            </textarea>   
            
            
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        
        <!-- /***************************   Academics   ***********************************************/  -->
        
        <fieldset>        
            <h2 class="fs-title">Academics</h2>
            <h3 class="fs-subtitle">Your Academics Details</h3>
            
            <label class="align_left">Roll No<span class="color_red">*</span></label>            
            <input type="text"  name="rollno" placeholder="Roll No"  value="<?php if(isset($_POST['rollno'])) echo $_POST['rollno']; ?>"  maxlength="9" autofocus required/>
            
            <label class="align_left">Course<span class="color_red">*</span></label>                    
            <select  name="course"  value="<?php if(isset($_POST['course'])) echo $_POST['course']; ?>" >
                <option value="be">B.E.</option>
                <option value="me">M.E.</option>
            </select>                        
            
            <label class="align_left">Branch<span class="color_red">*</span></label>                                    
            <select  name="branch" value="<?php if(isset($_POST['branch'])) echo $_POST['branch']; ?>" >
                <option value="cse">CSE</option>
                <option value="ece">ECE</option>
                <option value="mech">MECH</option>
                <option value="it">IT</option>                                                
                <option value="eee">EEE</option>
                <option value="bio">BIO</option>
            </select>            
            
            <label class="align_left">Semester<span class="color_red">*</span></label>                                    
            <select name="semester" value="<?php if(isset($_POST['semester'])) echo $_POST['semester']; ?>" >
                <option value="Sixth">Sixth</option>                
                <option value="fourth">Fourth</option>     
            </select>                         
            
            <label class="align_left">Department<span class="color_red">*</span></label>                                    
            <select name="dept" value="<?php if(isset($_POST['dept'])) echo $_POST['dept']; ?>" >
                <option value="uiet">UIET, Panjab Unviersity</option>
                <option value="uiect">UICET, Panjab Unviersity</option>
                <option value="uiect">CCET</option>
            </select>
            
            <label>CGPA<span class="color_red">*</span></label>            
            <input type="tel" name="cgpa" placeholder="CGPA"  value="<?php if(isset($_POST['be_pass_year'])) echo $_POST['be_pass_year']; ?>"  onKeyDown="if(this.value.length==4 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"/><br>                        
            
            <label class="align_left">B.E. Passing Year <span class="color_red">*</span></label>
            <input type="tel" name="be_pass_year" placeholder="2018" value="<?php if(isset($_POST['be_pass_year'])) echo $_POST['be_pass_year']; ?>"  onKeyDown="if(this.value.length==4 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;" required/><br>                  
            
            <label class="align_left">Projects<span class="color_red">*</span></label>
            <textarea name="projects" value="<?php if(isset($_POST['projects'])) echo $_POST['projects']; ?>" maxlenght="150" required>            
            </textarea>

            <label class="color_violet">Project Category</label><br><br>            
            <br>
            <div class="selectall">
                <div class="checkbox">
                    <label>Research</label><input type="checkbox" class="branch_checkbox" name="proj_research" value="Y"  checked>
                </div>
                <div class="checkbox">
                    <label>Web Development</label><input type="checkbox" class="branch_checkbox" name="proj_web_development" value="Y"    checked>
                </div>
                <div class="checkbox">
                    <label>Android Application</label><input type="checkbox" class="branch_checkbox" name="proj_android_app" value="Y"  checked  >
                </div>
                <div class="checkbox">
                    <label>Software Development</label><input type="checkbox" class="branch_checkbox"  name="proj_software_dev" value="Y" checked >
                </div>            
                <div class="checkbox">
                    <label>Others</label><input type="checkbox" class="branch_checkbox" name="proj_others" value="Y" checked >
                </div>
            </div>    
            <br>            
            
            <label class="align_left">Certification (If any)</label>         
            <textarea name="certification" value="<?php if(isset($_POST['certification'])) echo $_POST['certification']; ?>" maxlenght="100">            
            </textarea>            
            
            <label class="color_violet">Certification Category</label><br><br>            
            <br>
            <div class="selectall">
                <div class="checkbox">
                    <label>Linux</label><input type="checkbox" class="branch_checkbox" name="certi_linux" value="Y"  checked>
                </div>
                <div class="checkbox">
                    <label>Database</label><input type="checkbox" class="branch_checkbox" name="certi_database" value="Y"    checked>
                </div>
                <div class="checkbox">
                    <label>Networking</label><input type="checkbox" class="branch_checkbox" name="certi_networking" value="Y"  checked  >
                </div>
                <div class="checkbox">
                    <label>Soft Skills</label><input type="checkbox" class="branch_checkbox"  name="certi_soft_skills" value="Y" checked >
                </div>            
                <div class="checkbox">
                    <label>Others</label><input type="checkbox" class="branch_checkbox" name="certi_others" value="Y" checked >
                </div>
            </div>    
            <br>            
            
            <label class="align_left">Technology Used<span class="color_red">*</span></label>                  
            <textarea name="tech_used" value="<?php if(isset($_POST['tech_used'])) echo $_POST['tech_used']; ?>" maxlenght="100" required>            
            </textarea>
            
            <label class="color_violet">Technology Used</label><br><br>            
            <div class="selectall">
                <div class="checkbox">
                    <label>C</label><input type="checkbox" class="branch_checkbox" name="tech_c" value="Y"  checked>
                </div>
                <div class="checkbox">
                    <label>CPP</label><input type="checkbox" class="branch_checkbox" name="tech_cpp" value="Y"    checked>
                </div>
                <div class="checkbox">
                    <label>Java</label><input type="checkbox" class="branch_checkbox" name="tech_java" value="Y"  checked  >
                </div>
                <div class="checkbox">
                    <label>Android</label><input type="checkbox" class="branch_checkbox"  name="tech_android" value="Y" checked >
                </div>            
                <div class="checkbox">
                    <label>Python</label><input type="checkbox" class="branch_checkbox" name="tech_python" value="Y" checked >
                </div>
                <div class="checkbox">
                    <label>Front End Development</label><input type="checkbox" class="branch_checkbox" name="tech_front_end_dev" value="Y"  checked>
                </div>
                <div class="checkbox">
                    <label>Back End Development</label><input type="checkbox" class="branch_checkbox" name="tech_back_end_dev" value="Y"    checked>
                </div>
                <div class="checkbox">
                    <label>SQL (Database)</label><input type="checkbox" class="branch_checkbox" name="tech_sql" value="Y"  checked  >
                </div>
                <div class="checkbox">
                    <label>Embedded Programming</label><input type="checkbox" class="branch_checkbox"  name="tech_embedded_prog" value="Y" checked >
                </div>            
                <div class="checkbox">
                    <label>Matlab</label><input type="checkbox" class="branch_checkbox" name="tech_matlab" value="Y"  checked  >
                </div>
                <div class="checkbox">
                    <label>R Programming</label><input type="checkbox" class="branch_checkbox"  name="tech_r_prog" value="Y" checked >
                </div>            
                <div class="checkbox">
                    <label>Others</label><input type="checkbox" class="branch_checkbox" name="tech_others" value="Y" checked >
                </div>
                
            </div>    
            <br>            
            <br>
            <label class="align_left">Intership/Training (After First Year) Details</label>
            <select name="summer_first_year" value="<?php if(isset($_POST['summer_first_year'])) echo $_POST['summer_first_year']; ?>" >
                <option value="0"></option>
                <option value="1">Training</option>
                <option value="2">Internship</option>
            </select>            
            <textarea name="internship1" placeholder="Name of Institute" value="" maxlenght="100"> 
            </textarea>
            
            <br>
            <br>
            <label class="align_left">Intership/Training (After Second Year) Details</label>
            <select name="summer_second_year" value="<?php if(isset($_POST['summer_first_year'])) echo $_POST['summer_first_year']; ?>" >
                <option value="0">Training</option>
                <option value="1">Internship</option>
            </select>    
            <textarea name="internship2" value="<?php if(isset($_POST['internship2'])) echo $_POST['internship2']; ?>" maxlenght="100" required>            
            </textarea>

            <br>
            <br>
            <label class="align_left">Intership/Training (After Third Year) Details</label>
            <select name="summer_third_year" value="<?php if(isset($_POST['summer_first_year'])) echo $_POST['summer_first_year']; ?>" >
                <option value="0">Training</option>
                <option value="1">Internship</option>
            </select>            
            <textarea name="internship3" value="<?php if(isset($_POST['internship3'])) echo $_POST['internship3']; ?>" maxlenght="100" required>            
            </textarea>                
            
            
            <label class="align_left">Reappear<span class="color_red">*</span></label>                                    
            <select name="reappear"  value="<?php if(isset($_POST['reappear'])) echo $_POST['reappear']; ?>" required>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">>2</option>
            </select>            
            <input type="button" name="previous" class="previous action-button" value="Previous" />
<!--            <input type="button" name="submit" class="submit action-button" value="Submit" />-->
            <input type="submit" name="submit" value="Register" class="btnRegister bg_green">
            <!--<input type="submit" name="submit" value="Register" class="btnRegister">
            <button type="submit" class="submit action-button" name="signup">Sign Up</button>            -->
        </fieldset>
    
</form>
<script src='./js/jquery.min.js'></script>
<script src='./js/javascript.js'></script>
<script language="javascript" type="text/javascript">
      
$("form").submit(function () {

    var this_master = $(this);

    this_master.find('input[type="checkbox"]').each( function () {
        var checkbox_this = $(this);


        if( checkbox_this.is(":checked") == true ) {
            checkbox_this.attr('value','1');
        } else {
            checkbox_this.prop('checked',true);
            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
            checkbox_this.attr('value','0');
        }
    })
})      
    </script>    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="./signup/js/index.js"></script>    
</body>
</html>
