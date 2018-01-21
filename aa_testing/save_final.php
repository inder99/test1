<?php
if(count($_POST)>0) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
	if(empty($_POST[$key])) {
	$message = ucwords($key) . " field is required";
	break;
	}
	}
	/* Password Matching Validation */
	if($_POST['stu_password'] != $_POST['confirm_password']){ 
	$message = 'Passwords should be same<br>'; 
	}

	/* Email Validation 
	if(!isset($message)) {
	if (!filter_var($_POST["stu_email"], FILTER_VALIDATE_EMAIL)) {
	$message = "Invalid UserEmail";
	}
	}
*/
	/* Validation to check if gender is selected 
	if(!isset($message)) {
	if(!isset($_POST["gender"])) {
	$message = " Gender field is required";
	}
	}
*/
    
	/* Validation to check if Terms and Conditions are accepted 
	if(!isset($message)) {
	if(!isset($_POST["terms"])) {
	$message = "Accept Terms and conditions before submit";
	}
	}
*/
	if(!isset($message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "SELECT * FROM test3 where stu_email = '" . $_POST["stu_email"] . "'";
		$count = $db_handle->numRows($query);
		
		if($count==0) {
			$query = "INSERT INTO test3 (stu_email, stu_password,first_name, last_name,father_name,mother_name,dob, gender,mobile,rollno,course,branch,semester,dept,cgpa,be_pass_year,twelveth_marks,twelveth_year,tenth_marks,tenth_year,projects,address,reappear) VALUES
			('" . $_POST["stu_email"] . "', '" . md5($_POST["stu_password"]) . "','" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "', '" . $_POST["father_name"] . "',  '" . $_POST["mother_name"] . "','" . $_POST["dob"] . "', '" . $_POST["gender"] . "', '" . $_POST["mobile"] . "', '" . $_POST["rollno"] . "','" . $_POST["course"] . "', '" . $_POST["branch"] . "','" . $_POST["semester"] . "', '" . $_POST["dept"] . "', '" . $_POST["cgpa"] . "', '" . $_POST["be_pass_year"] . "', '" . $_POST["twelveth_marks"] . "', '" . $_POST["twelveth_year"] . "', '" . $_POST["tenth_marks"] . "', '" . $_POST["tenth_year"] . "', '" . $_POST["projects"] . "','" . $_POST["address"] . "','" . $_POST["reappear"] . "')";
            $current_id = $db_handle->insertQuery($query);
			/*if(!empty($current_id)) {
				$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."activate.php?id=" . $current_id;
				$toEmail = $_POST["userEmail"];
				$subject = "User Registration Activation Email";
				$content = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
				$mailHeaders = "From: Admin\r\n";
				if(mail($toEmail, $subject, $content, $mailHeaders)) {
					$message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";	
				}
				unset($_POST);
			} else {
				$message = "Problem in registration. Try Again!";	
			}*/
		} else {
			$message = "User Email is already in use.";	
		}
	}
}
?>
<html>
<head>
  <title>SignUp Student</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./signup/css/style.css">  
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
            <h2 class="fs-title">Create your account</h2>
            <h3 class="fs-subtitle">This is step 1</h3>
            <label style="text-align:left;">Email</label>
            <input type="email" name="stu_email" placeholder="Email" value="<?php if(isset($_POST['stu_email'])) echo $_POST['stu_email']; ?>" onblur="ValidateEmail(this);" autofocus required/>                         
            <label class="align_left">Password</label>
            <input type="password" name="stu_password" placeholder="Password" value="<?php if(isset($_POST['stu_password'])) echo $_POST['stu_password']; ?>" onblur="ValidatePassword(this);" required/>
            <label class="align_left">Confirm Password</label>            
            <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php if(isset($_POST['confirm_password'])) echo $_POST['confirm_password']; ?>"  onblur="ConfirmPassword(this);" required/>
            <input type="button" name="next" class="next action-button" value="Next"/>
            
        </fieldset>
    
        <!-- /***************************   Personal Details   ***********************************************/   -->
        
        <fieldset>
            <h2 class="fs-title">Personal Details</h2>
            <h3 class="fs-subtitle">Your Personal Info</h3>
            <!--   Student Designation Field-->
            <label class="align_left">First Name</label>
            <input type="text" name="first_name" placeholder="First Name"  value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" maxlength="20" autofocus required/>
            <label class="align_left">Last Name</label>            
            <input type="text" name="last_name" placeholder="Last Name"  value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>"  maxlength="20"/>
            <label class="align_left">Father's Name</label>            
            <input type="text" name="father_name" placeholder="(Don't include Mr./Sh.)"  value="<?php if(isset($_POST['father_name'])) echo $_POST['father_name']; ?>"  maxlength="35" required/>        
            <label class="align_left">Mother Name</label>            
            <input type="text" name="mother_name" placeholder="(Don't include Smt.)"  value="<?php if(isset($_POST['mother_name'])) echo $_POST['mother_name']; ?>"  maxlength="35" required/>
            <label class="align_left">Date of Birth</label>            
            <input type="date" name="dob" placeholder="Date of Birth"  value="<?php if(isset($_POST['dob'])) echo $_POST['dobl']; ?>"  required/>            
            <label class="align_left">Gender</label>                    
            <select  name="gender"  value="<?php if(isset($_POST['gender'])) echo $_POST['gender']; ?>" >
                <option value="M">MALE</option>
                <option value="F">FEMALE</option>
                <option value="T">OTHERS</option>
            </select>                        
            <label class="align_left">Mobile</label>            
            <input type="tel" name="mobile" placeholder="Don't include +91 / 0"  value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']; ?>"  onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" required/>
            
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        
        <!-- /***************************   Academics   ***********************************************/  -->
        
        <fieldset>        
            <h2 class="fs-title">Academics</h2>
            <h3 class="fs-subtitle">Your Academics Details</h3>
            <label class="align_left">Roll No</label>            
            <input type="text"  name="rollno" placeholder="Roll No"  value="<?php if(isset($_POST['rollno'])) echo $_POST['rollno']; ?>"  maxlength="9" autofocus required/>
            <label class="align_left">Course</label>                    
            <select  name="course"  value="<?php if(isset($_POST['course'])) echo $_POST['course']; ?>" >
                <option value="be">B.E.</option>
                <option value="me">M.E.</option>
            </select>                        
            <label class="align_left">Branch</label>                                    
            <select  name="branch" value="<?php if(isset($_POST['branch'])) echo $_POST['branch']; ?>" >
               <option value="cse">CSE</option>
                <option value="ece">ECE</option>
               <option value="cse">MECH</option>
                <option value="ece">EEE</option>
               <option value="bio">BIO</option>
            </select>            
            <label class="align_left">Semester</label>                                    
            <select name="semester" value="<?php if(isset($_POST['semester'])) echo $_POST['semester']; ?>" >
                <option value="Sixth">Sixth</option>                
                <option value="fourth">Fourth</option>     
            </select>                         
            <label class="align_left">Department</label>                                    
            <select name="dept" value="<?php if(isset($_POST['dept'])) echo $_POST['dept']; ?>" >
                <option value="uiet">UIET, Panjab Unviersity</option>
                <option value="uiect">UICET, Panjab Unviersity</option>
                <option value="uiect">CCET</option>
            </select>
            <label>CGPA</label>            
            <input type="tel" name="cgpa" placeholder="CGPA"  value="<?php if(isset($_POST['be_pass_year'])) echo $_POST['be_pass_year']; ?>"  onKeyDown="if(this.value.length==4&& event.keyCode!=8) return false;"/><br>                        
            <label class="align_left">B.E. Passing Year </label>
            <input type="tel" name="be_pass_year" placeholder="2018" value="<?php if(isset($_POST['be_pass_year'])) echo $_POST['be_pass_year']; ?>"  onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;" required/><br>                  
            <label class="align_left">12th Percentage</label>            
            <input type="tel" name="twelveth_marks" placeholder="Don't include '%'" value=" <?php if(isset($_POST['twelveth_marks'])) echo $_POST['twelveth_marks']; ?>"  onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;" required/>
            <label class="align_left">12th Passing year</label>            
            <input type="tel"  name="twelveth_year" placeholder="2014"  value="<?php if(isset($_POST['twelveth_year'])) echo $_POST['twelveth_year']; ?>" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;"  required/>
            
            <label class="align_left">10th Percentage</label>            
            <input type="tel"  name="tenth_marks" placeholder="Don't include '%'"  value="<?php if(isset($_POST['tenth_marks'])) echo $_POST['tenth_marks']; ?>" onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;"  required/>    
            <label class="align_left">10th Passing Year</label>            
            <input type="tel"  name="tenth_year" placeholder="2012"  value="<?php if(isset($_POST['tenth_year'])) echo $_POST['tenth_year']; ?>" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;"  required/> 
            
            <label class="align_left">Projects</label>                  
            <textarea name="projects" value="<?php if(isset($_POST['projects'])) echo $_POST['projects']; ?>" maxlenght="150" required>            
            </textarea>
            
            <label class="align_left">Address</label>                  
            <textarea name="address" value="<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"  maxlenght="150" required>
            </textarea>   
            
            <label class="align_left">Reappear</label>                                    
            <select name="reappear"  value="<?php if(isset($_POST['reappear'])) echo $_POST['reappear']; ?>" required>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">>2</option>                
            </select>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="submit" name="signup" class="submit action-button" value="Submit" />
            <input type="submit" name="submit" value="Register" class="btnRegister">            
            <!--<input type="submit" name="submit" value="Register" class="btnRegister">
            <button type="submit" class="submit action-button" name="signup">Sign Up</button>            -->
        </fieldset>
    
</form>
<script src='./js/jquery.min.js'></script>
    <script src='./js/javascript.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="./signup/js/index.js"></script>    
</body>
</html>
