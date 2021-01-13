<?php 
include "form-functions.php";
$link = connection();



$user = "";
$pass  = "";
$logSubmit = false;
$errorFound =  false;
$verify = false;
$error = array();
$clean = array(); 
$userType = 0;
$userFound = false;


if(isset($_POST['submit'])){
    $logSubmit = true;
    
    $clean[0] = clean_input($_POST['user']);
    $clean[1] = clean_input($_POST['pwd']);
    
    $user = $clean[0];
    $pass = $clean[1];
    
    
    
    // check DB for username
    if($user != "" ){
        $sql = "SELECT * FROM `staff` WHERE `staff_username` LIKE '$user'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
            $userFound = true;
            $user = $row["staff_username"];
            $userType = $row['staff_ea'];
                
            // check password entered against found username hash
            $verify = password_verify($pass, $row["staff_password"]);
            mysqli_close($link);
            }//end of while loop
            
        } else { 
            $errorFound = true;  
             
         $error['username'] = "<p id='userError' >Username not found</p>"  ; 
        }
        
    }else{
        $errorFound = true;
        $error['username'] = "<p id='userError' >Enter a username</p>";
    }
    
    if($verify == true){
        $_SESSION["auth"] = true;
        $_SESSION["user"] = $user;
        if($userType == 1){
             $_SESSION["admin"] = 1;
        }else{
             $_SESSION["admin"] = 0;
        }
        
        //refresh page to force redirect header on login.php
        echo "<meta http-equiv='refresh' content='0'>";
        
    }else if($verify == false){
        if($pass == ""){
            $errorFound = true;
            $error['pass'] = "<p id='passError'>Enter a password </p>"; 
        }else{
            $errorFound = true;
             $error['pass'] = "<p id='passError'> Wrong password </p>"; 
        }
    }
     
} // end of log submit



?><form action="<?php $self; ?>#" method="post" class="form">
            <fieldset>
			<legend>Duke Of York Staff login</legend>
                <div class="formEl">            
                    <label for="user">Username</label>
                    <input type="text" name="user" id="user" value = "<?php echo $user ?>" />
                    <?php
                     if(isset($error['username'])){
                        echo $error['username'];
                        echo   ' <script>
                                document.getElementById("userError").classList.add("showError");
                                document.getElementById("user").classList.add("errorField");
                                </script> ' ;
                     }
                         ?>
                </div>
                <div class="formEl">            
                    <label for="pwd">Password</label>   
                    <input type="password" name="pwd" id="pwd" />
                <?php
                     if(isset($error['pass'])){
                        echo $error['pass'];
                        echo   ' <script>
                                document.getElementById("passError").classList.add("showError");
                                document.getElementById("pwd").classList.add("errorField");
                                </script> ' ;
                     }
                         ?>
                    
                </div>
                <div class="formEl">            
                    <input type="submit" name="submit" value="Submit" />
                </div>
            </fieldset>
</form>

<!-- used to refresh page
https://stackoverflow.com/questions/10643626/refresh-page-after-form-submitting/14667451 -->
    