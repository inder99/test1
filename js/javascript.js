  function ValidateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            emailField.focus();            
            return false;
        }
        return true;

}            

var password;
function ValidatePassword(pass)
  {
    password=pass.value;  
    if(pass.value != "") {
      if(pass.value.length < 6) {
        alert("Error: Password must contain at least six characters!");
        pass.focus();
        return false;
      }
/*      if(pass.value == stu_email.value) {
        alert("Error: Password must be different from Username!");
        pass.focus();
        return false;
      }
*/      
      re = /[0-9]/;
      if(!re.test(pass.value)) {
        alert("Error: password must contain at least one number (0-9)!");
        pass.focus();
        return false;
      }
      re = /[a-z]/;
      if(!re.test(pass.value)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        pass.focus();
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(pass.value)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        pass.focus();
        return false;
      }
    } 
      else {
      alert("Error: Please check that you've entered and confirmed your password!");
      pass.focus();
      return false;
    }

    //alert("You entered a valid password: " + pass.value);
    return true;
  }

function ConfirmPassword(cpass)
  {
    if(cpass.value == "" || cpass.value != password) {
      alert("Error: Please check that you've entered and confirmed your password!");
      cpass.focus();
      return false;      
    }
      else{
//          alert("You entered a valid password: " + cpass.value);
          alert("Password Valid and Verified");
          return true;      
      }
  }