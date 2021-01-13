<?php  
include "form-functions.php";
$self = htmlspecialchars($_SERVER['PHP_SELF']);

$fName = "";
$mob = "";
$email = ""; 
$bookDate = "";
$bar = 0;
$buffet = 0;
$notes ="";
$form_submitted = false;
$errorFound = false;
$errorMsg = [];

$complete = "";

if (isset($_POST['submit'])){
    $form_submitted = true;
    
    $fName = clean_input($_POST['fName']);
    $mob  = clean_input($_POST['mob']);
    $email = clean_input($_POST['email']);
    $bookDate = clean_input($_POST['bookDate']);
    $bar = clean_input($_POST['bar']); 
    $buffet = clean_input($_POST['buff']);
    $notes = clean_input($_POST['notes']);
   
    if(validMobile($mob) == false){
        $errorFound = true;
    }
    if(validName($fName) == false){
        $errorFound = true;
    }
    if(validNote($notes) == false){
        $errorFound = true;	
    }
    if(validEmail($email) == false){
        $errorFound = true;
    }
    if(validDate($bookDate)== false){
        $errorFound = true;
    }
    if(validOption($bar)== false){
        $errorFound = true;
    }    
    if(validOption($buffet)== false){
        $errorFound = true;	
    }
    // add only when no errors and input is valid
    $link = connection();
    if($errorFound == false){
         $sql_add = "INSERT INTO `bookings` (`booking_id`, `booking_name`, `booking_mobile`, `booking_bar`, `booking_buffet`, `booking_email`, `booking_notes`, `booking_date`) VALUES (NULL, '".$fName."', '".$mob."', '".$bar."', '".$buffet."', '".$email."','".$notes."','".$bookDate."')";
        
        mysqli_query($link,$sql_add) or die(mysqli_error($link));
        mysqli_close($link);
        echo  '<script> alert("Thank you, we will be in touch to confirm"); </script>';
    }
    
}
?>

<form action="<?php $self; ?>#" method="post" class="form">
        <fieldset>
			<legend>New Booking</legend>
                <div class="formEl">            
                    <label for="fName">Full Name:</label>
                    <input type="text" name="fName" id="fName" value="<?php echo $fName ?>" />
                    
                    <!-- Error checking -->
                <?php        
                if(validName($fName) == false and $form_submitted == true){ 
                    echo '
                    <div class="showError" id="nameError">Invalid name</div>  
                    <script>document.getElementById("fName").classList.add("errorField"); </script>';
                 }else if(validEmail($email) == true and $form_submitted == true){ 
                  echo  '<script>  document.getElementById("fName").classList.remove("errorField");</script>';
                }
                    ?>  
                </div>
                <div class="formEl">            
                    <label for="mob">Mobile:</label>
                   <input type="text" name="mob" id="mob" value="<?php echo $mob ?>"/>
                    <!-- Error checking -->
                <?php         
                if(validMobile($mob) == false and $form_submitted == true){ 
                    echo '<div class="showError" id="mobError"> Invalid mobile (11 digits) </div>  
                          <script> document.getElementById("mob").classList.add("errorField");</script>';
                 }else if(validMobile($mob) == true and $form_submitted == true){
                  echo  '<script>  document.getElementById("mob").classList.remove("errorField"); </script>';
                }
                    ?>  
                </div>
                <div class="formEl">            
                    <label for="emailField">Email:</label>
                    <input type="text" name="email" id="emailField" value="<?php echo $email  ?>"/>
                    <!-- Error checking -->
                <?php        
                    
                if(validEmail($email) == false and $form_submitted == true){ 
                    echo '<div class="showError" id="emailError">Invalid email address</div>  
                            <script>document.getElementById("emailField").classList.add("errorField");</script>';
                 }else if(validEmail($email) == true and $form_submitted == true){
                  echo  '
                  <script>document.getElementById("emailField").classList.remove("errorField");</script>';   
                }
                    ?>  
                </div>
                <div class="formEl">            
                    <label  for="date">Date Of Booking:</label>
                    <input type="date" name="bookDate" id="date" value="<?php echo $bookDate ?>" />
                     <!-- Error checking -->
                <?php        
                    
                if(validDate($bookDate) == false and $form_submitted == true){ 
                echo '
                        <div class="showError" id="dateError">Date is invalid</div>              
                        <script>document.getElementById("date").classList.add("errorField");</script>';
                 }else if(validDate($bookDate) == true and $form_submitted == true){
                echo '<script> document.getElementById("date").classList.remove("errorField");</script>';
                }
                    ?>
                </div>
                <div class="formEl">            
                    <label for="bar">Bar Open?</label>
                       <select name='bar' id="bar">   
                           <option value="1">Yes</option>
                           <option value="0" selected>No</option>
                        </select>
                    
                      <!-- Error checking -->
                <?php        
                    
                if(validOption($bar) == false and $form_submitted == true){ 
                echo '
                    <div class="showError" id="barError">Option invalid</div>  
                    <script> document.getElementById("bar").classList.add("errorField"); </script>';
                 }else if(validOption($bar) == true and $form_submitted == true){
                echo '<script> document.getElementById("bar").classList.remove("errorField"); </script>';
                }
                    ?>
                </div> 
                <div class="formEl">            
                    <label for="buff">Buffet?</label>
                        <select name='buff' id="buff">   
                           <option value="1">Yes</option>
                           <option value="0" selected>No</option>
                        </select>
                     <!-- Error checking -->
                <?php        
                    
                if(validOption($bar) == false and $form_submitted == true){ 
                echo '<div class="showError" id="buffError">Option invalid</div>  
                    <script>document.getElementById("buff").classList.add("errorField");</script>';
                 }else if(validOption($bar) == true and $form_submitted == true){
                echo '<script>document.getElementById("buff").classList.remove("errorField");</script>';
                }
                    ?>
                </div>
                <div class="formEl" >            
                    <label for="notes">Notes</label>
                     <textarea name="notes" class="notesBox" maxlength="400" id="notes"></textarea>
                     <!-- Error checking -->
                <?php        
                    
                if(validNote($notes) == false and $form_submitted == true){ 
                echo '<div class="showError" id="noteError">Field is too long (400 Characters)</div>  
                        <script>document.getElementById("notes").classList.add("errorField");</script>';
                 }else if(validNote($notes) == true and $form_submitted == true){
                echo '<script>document.getElementById("notes").classList.remove("errorField");</script>';
                }
                    ?>
                </div>
                <div class="formEl">            
                    <input type="submit" name="submit" value="Submit" />
                </div>
        </fieldset>
</form>