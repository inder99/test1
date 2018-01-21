<?php
include_once 'connect.php';
if(isset($_SESSION['user'])=="")
{
    header("Location: index.php");
}
?>

<?php
  if(isset($_POST['submit'])) {
	if(!isset($message)) {
		require_once("dbcontroller.php");
		$db_handle = new DBController();
		$query = "SELECT * FROM tpc_company where comp_name = '" . $_POST["comp_name"] . "'";
		$count = $db_handle->numRows($query);
		
		if($count==0) {
            if($_POST['stipend']==0){
                echo $_POST['stipend'];
                $_POST['stipend']='NULL';
                echo $_POST['stipend'];
            }
            
            $c_ntid =preg_replace('/\s+/','',$_POST["c_ntid"]);
            /*
                If you know the white space is only due to spaces, you can use:
                $string = str_replace(' ','',$string); 
                
                But if it could be due to space, tab...you can use:
                $string = preg_replace('/\s+/','',$string);            
            */
			$query = "INSERT INTO tpc_company (c_ntid, comp_name, comp_email,arrival_date,branch_cse, branch_ece,branch_mech,branch_it,branch_eee, branch_bio,type,package,stipend,job_profile,location,min_qual,cgpa,twelveth_marks,tenth_marks) VALUES
	('" . $c_ntid . "','" . $_POST["comp_name"] . "','" . strtolower($_POST["comp_email"]) . "', '" . $_POST["arrival_date"] . "', '" . $_POST["branch_cse"] . "', '" . $_POST["branch_ece"] . "',  '" . $_POST["branch_mech"] . "','" . $_POST["branch_it"] . "', '" . $_POST["branch_eee"] . "','" . $_POST["branch_bio"] . "', '" . $_POST["type"] . "', '" . $_POST["package"] . "','" . $_POST["stipend"] . "', '" . $_POST["job_profile"] . "','" . $_POST["location"] . "','" . $_POST["min_qual"] . "', '" . $_POST["cgpa"] . "','" . $_POST["twelveth_marks"] . "','" . $_POST["tenth_marks"] . "')";
            $current_id = $db_handle->insertQuery($query);
            if(!empty($current_id)) {
            ?>
            <script>alert('successfully registered ');</script>
            <?php
            }
            
		} else {
			$message = "Company Name is already in use";	
		}
	}
    else{
        ?>
        <script>alert('error while registering you...');</script>
        <?php        
    }
}
// value="<?php if(isset($_POST['comp_email'])) echo $_POST['comp_email'];
?>
<html>
<head>
  <title>SignUp Student</title>
  <link rel="stylesheet" href="./signup/css/reset.min.css"  type="text/css">
  <link rel="stylesheet" href="./signup/css/style.css"  type="text/css">  
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
            <label class="align_left">Company Name</label>
            <input type="text" name="comp_name" placeholder="Company Name" autofocus required/>            
            <label style="text-align:left;">Email</label>            
            <input type="email" name="comp_email" placeholder="Email" onblur="ValidateEmail(this);"required/>                     
            <label class="align_left">Arrival Date</label>            
            <input type="date" name="arrival_date" placeholder="YYYY-MM-DD"  required/>                        
            
            <input type="button" name="next" class="next action-button" value="Next"/>           
            
       </fieldset>
    
        <fieldset>
            <h2 class="fs-title">Company Details</h2>
            <h3 class="fs-subtitle">Your Company Info</h3>
            <label class="color_violet">Branch Allowed</label><br><br>
            
            <div class="selectall">
            <div class="checkbox">
                <label>CSE</label><input type="checkbox" class="branch_checkbox" name="branch_cse" value="Y"  checked>
            </div>
            <div class="checkbox">
                <label>ECE</label><input type="checkbox" class="branch_checkbox" name="branch_ece" value="Y" checked>
            </div>
            <div class="checkbox">
                <label>MECH</label><input type="checkbox" class="branch_checkbox" name="branch_mech" value="Y" checked  >
            </div>
            <div class="checkbox">
                <label>IT</label><input type="checkbox" class="branch_checkbox"  name="branch_it" value="Y" checked >
            </div>            
            <div class="checkbox">
                <label>EEE</label><input type="checkbox" class="branch_checkbox" name="branch_eee" value="Y" checked >
            </div>
            <div class="checkbox">
                <label>BIO</label><input type="checkbox" class="branch_checkbox" name="branch_bio" value="Y" checked >
            </div>
            </div>    
            <br>            
            <label>Type</label>                        
            <select  name="type">
                <option value="core">Core</option>
                <option value="non-core">Non-Core</option>
                <option value="consultancy">Consultancy</option>
            </select>
            <label>Package(In Lakhs)</label>            
            <div class="font10">Fill 0 in case not provide Job</div>            
            <input type="number" name="package" placeholder="Numbers only" onKeyDown="if(this.value.length==5 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/>   
            <label>Internship Stipend(Rs per Month)</label><br>            
            <div class="font10">Fill 0 in case not provide Internship</div>
            <input type="tel" name="stipend" onKeyDown="if(this.value.length==5 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/>
            <label>Job Profile</label>            
            <textarea type="text" name="job_profile" placeholder="Job Profile Offered" maxlength="50" required></textarea>     
            <label>Location</label>            
            <textarea type="text" name="location" placeholder="Location of the Company" maxlength="50" required></textarea>     
            
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
            
        </fieldset>
    
        <fieldset>        
            <h2 class="fs-title">Academics</h2>
            <h3 class="fs-subtitle">Your Academics Details</h3>
            <label>Minimum Qualification</label>                        
            <select  name="min_qual" id="registration_id" class="form-control c-registration-category">
                <option value="be">B.E.</option>
                <option value="me">M.E.</option>
            </select>                         
            <br>                
            <label>CGPA</label>            
            <input type="tel" name="cgpa" placeholder="CGPA required greater than" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;"/><br>
            <label>12th Percentage</label>
            <div class="font10">Minimum percentage required</div>
            <input type="tel"  name="twelveth_marks" placeholder="Don't include '%'" onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;"/>
            <label>10th Percentage</label>        
            <div class="font10">Minimum percentage required</div>
            <input type="tel"  name="tenth_marks" placeholder="Don't include '%'" onKeyDown="if(this.value.length==5 && event.keyCode!=8) return false;"/>            
            <br>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
<!--            <input type="submit" name="submit" class="submit action-button" value="Submit" />-->
            <input type="submit" name="submit" value="Register" class="btnRegister bg_green">     
        </fieldset>
    
</form>
<script src='./js/jquery.min.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>    
  <script language="javascript" type="text/javascript">
      
$("form").submit(function () {

    var this_master = $(this);

    this_master.find('input[type="checkbox"]').each( function () {
        var checkbox_this = $(this);


        if( checkbox_this.is(":checked") == true ) {
            checkbox_this.attr('value','Y');
        } else {
            checkbox_this.prop('checked',true);
            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
            checkbox_this.attr('value','N');
        }
    })
})      
/*
$(function() {
  $('.branch_checkbox').on('change', function(e) {
    e.stopPropagation();
    this.value = this.checked ? 'Y' : 'N';
    alert(this.value);	
  });
})
*/
    </script>    
    <script src='./js/javascript.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
    <script src="./signup/js/index.js"></script>    
    
</body>
</html>
