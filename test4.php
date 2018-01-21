<?php
  if(isset($_POST['submit'])) {
    if($_POST['stipend']==0){
        echo $_POST['stipend'];
        $_POST['stipend']='NULL';
        echo $_POST['stipend'];
    }
      else{
       echo "Hello" . $_POST['stipend'];   
      }
        
  }
?>
<form  id="msform" name="student_reg" class="ms_form_left" method="post" action="">
<label>Internship Stipend(Rs per Month)</label><br>            
<div class="font10">Fill 0 in case not provide Internship</div>
<input type="tel" name="stipend" onKeyDown="if(this.value.length==5 && event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=13) return false;"  required/>
<input type="submit" name="submit" value="Register" class="btnRegister">                        
</form>    