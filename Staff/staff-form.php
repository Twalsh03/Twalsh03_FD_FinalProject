
<?php

$link = connection();
$self = htmlspecialchars($_SERVER['PHP_SELF']);

$user = "";
$pwd = "";
$pwdCon = "";
$userType= "0";
$cleanArray = array();
$form_submitted = false;
$errorFound = false;
$formErrors = array();
$PASS_LENGTH = 6;

//check if submit is pressed
if (isset($_POST['submit'])){
    $form_submitted = true;
    
    
    //move $_POST[] to $cleanArrray[] to protect against XSS
    $cleanArray[0] = clean_input($_POST['user']);
    $cleanArray[1] = clean_input($_POST['pwd'] );
    $cleanArray[2] = clean_input($_POST['pwdCon']);
    $cleanArray[3] = clean_input($_POST['userType']);
    
    $user = $cleanArray[0];  
    $pwd = $cleanArray[1]; 
    $pwdCon = $cleanArray[2];
    $userType = $cleanArray[3];

    //check for valid username
    if($user == ''){
        $errorFound = true;
        $formErrors['blankUser'] = "<p id='error' >Need a username </p>"; 	
    }else if(userExists($link,$user) == true){
        $errorFound = true;
        $formErrors['takenUser'] = "<p id='error'>Username already taken </p>"; 	
    }

    //Check Password length
    if(strlen($pwd) < $PASS_LENGTH){
        $errorFound = true;
        $formErrors['pass'] = "<p id='passError'>Too short(6+ characters) </p>"; 
        
        // check if passwords match
        }else if($pwd != $pwdCon){
        $errorFound = true;
        $formErrors['pass'] = "<p id='passError' >Passwords do not match</p>";    
    }
    
    //check valid option
    if(validOption($userType)== false){
        $errorFound = true;
        $formErrors['option'] = "<p id='optionError' >Option Invalid</p>";    
    }
    
        //Hash password when matched 
        $hashed_pass = password_hash($pwd, PASSWORD_DEFAULT);
        
        // add only when no errors and input has been cleaned
        if($errorFound == false){
            $sql_add = "INSERT INTO `staff` (`staff_id`, `staff_username`, `staff_password`, `staff_ea`) VALUES ( NULL ,'".$user."', '".$hashed_pass."', '".$userType."')";
            $link = connection();
            mysqli_query($link, $sql_add);
        
            //Get the Primary Key of last insert
            $link = connection();
            $last_id = mysqli_insert_id($link);

            if ($userType == 0){
                mysqli_close($link);
                $complete =  "User (".$user.") has been created";
                echo  '<script> alert("'.$complete.'"); </script>'; 
                
            }else if($userType == 1) {
                
                // To Keep database integrity, add to admin table
                $sql_admin = " INSERT INTO `staffAdmin` (`staffAdmin`, `staff_id`) VALUES (NULL, '".$last_id."')";
                mysqli_query($link, $sql_admin);
                mysqli_close($link);
                $complete =  "Admin user (".$user.") has been created";
                echo  '<script> alert("'.$complete.'"); </script>'; 
            }else{
                $complete =  "There has been an error, please contact IT Team";
                
                echo  '<script> alert("'.$complete.'"); </script>'; 
                }
    }
    

//end of form submit IF
}


?>

<form action="<?php $self; ?>#" method="post" class="form">
        <fieldset>
			<legend>New Staff</legend>
                <div class="formEl">            
                    <label for="user">Username</label>
                    <input type="text" name="user" id="user" value="<?php echo $user ?>" />
                    <?php  
                    
                    if(isset($formErrors['blankUser'])){
                        echo $formErrors['blankUser'];
                        echo   ' <script>
                                document.getElementById("error").classList.add("showError");
                                document.getElementById("user").classList.add("errorField");
                                </script> ' ;
                    }else if(isset($formErrors['takenUser'])){
                        echo $formErrors['takenUser'];
                        echo   ' <script>
                                document.getElementById("error").classList.add("showError");
                                document.getElementById("user").classList.add("errorField");
                                </script> ' ;
                    }
                    ?>
                </div>
                <div class="formEl">            
                    <label for="pwd">Password</label>
                   <input type="password" name="pwd" id="pwd" value="<?php echo $pwd  ?>"/>
                </div>
                <div class="formEl">            
                    <label for="pwdCon">Confirm password</label>
                    <input type="password" name="pwdCon" id="pwdCon" value=""/>
                    <?php  
                    
                    if(isset($formErrors['pass'])){
                        echo $formErrors['pass'];
                        echo   ' <script>
                                document.getElementById("passError").classList.add("showError");
                                document.getElementById("pwd").classList.add("errorField");
                                document.getElementById("pwdCon").classList.add("errorField");
                                </script> ' ;
                    }
                        ?>
                    
                </div>
                   <div>            
                    <label for="option">Type of User?</label>
                       <select name='userType' id='option'>   
                           <option value="1">Admin</option>
                           <option value="0" selected>User</option>
                           </select>
                <?php  
                    
                    if(isset($formErrors['option'])){
                        echo $formErrors['option'];
                        echo   ' <script>
                                document.getElementById("optionError").classList.add("showError");
                                document.getElementById("option").classList.add("errorField");
                                </script> ' ;
                    }
                        ?>
                       
                    </div>
                <div class="formEl">            
                    <input type="submit" name="submit" value="Submit" />
                </div> 
        </fieldset>
</form>
<!-- 

references:

to conncet to DB
https://www.php.net/manual/en/function.mysqli-connect.php

to get data from a DB
https://www.w3schools.com/php/func_mysqli_fetch_row.asp

to avoid XSS
https://www.w3schools.com/php/php_form_validation.asp

-->




