<?php  
$link = connection();
$self = htmlspecialchars($_SERVER['PHP_SELF']);


$theftDate = "";
$theftTime = "";
$vicName = "";
$mob = "";
$report = "";
$cleanArray = array();
$form_submitted = false;
$errorFound = false;
$formErrors = array();

//check if submit is pressed
if (isset($_POST['submit'])){
    $form_submitted = true;
    
    //move $_POST[] to $cleanArrray[] to protect against XSS
    $cleanArray[0] = clean_input($_POST['theftDate']);
    $cleanArray[1] = clean_input($_POST['theftTime']);
    $cleanArray[2] = clean_input($_POST['vicName']);
    $cleanArray[3] = clean_input($_POST['mob']);
    $cleanArray[4] = clean_input($_POST['report']);
    
    $theftDate = $cleanArray[0];
    $theftTime = $cleanArray[1];
    $vicName = $cleanArray[2];
    $mob = $cleanArray[3];
    $report = $cleanArray[4];

    //check for errors
    if(validMobile($mob) == false){
        $errorFound = true;
        $formErrors['mob'] = "<p class = 'showError' id='mob' >invalid mobile number</p>"; 	
    }
    if(validName($vicName) == false){
        $errorFound = true;
        $formErrors['name'] = "<p class = 'showError' id='name' >invalid name</p>"; 	
    }
    if(validNote($report)== false){
        $errorFound = true;
        $formErrors['report'] = "<p class = 'showError' id='theftReport'>Report is invalid</p>"; 	
    }
    if(validDate($theftDate)== false){
        $errorFound = true;
        $formErrors['date'] = "<p class = 'showError' id='theftDate'>Date is invalid</p>"; 	
    }
    if(validTime($theftTime)== false){
        $errorFound = true;
        $formErrors['time'] = "<p class = 'showError' id='theftTime'>Time is invalid</p>"; 	
    }
    
    // add only when no errors and input is valid
    if($errorFound == false){
         $sql_add = "INSERT INTO `theft` (`theft_id`, `theft_admin`, `theft_name`, `theft_mobile`, `theft_time`, `theft_date`, `theft_report`) VALUES (NULL, '1', '".$vicName."', '".$mob."', '".$theftTime."', '".$theftDate."', '".$report."')";
        
        mysqli_query($link,$sql_add) or die(mysqli_error($link));
        mysqli_close($link);

    }
  
}


?>

<form action="<?php $self; ?>#" method="post" class="form">
        <fieldset>
			<legend>New Theft Report</legend>
               <div class="formEl">            
                    <label for="date">Date</label>
                    <input type="date" name="theftDate" id="date" value="<?php echo $theftDate; ?>"/>
                  <?php if(isset($formErrors['date'])){
                        echo $formErrors['date'];
                        echo   ' <script> document.getElementById("date").classList.add("errorField");</script> ' ;
                   }?> 
                </div> 
                <div class="formEl">            
                    <label for="time">Time</label>
                    <input type="time" name="theftTime" id="time" value="<?php echo $theftTime ;?>"/>
                  <?php if(isset($formErrors['time'])){
                        echo $formErrors['time'];
                        echo   ' <script> document.getElementById("time").classList.add("errorField"); </script> ' ;
                   }?> 
                </div>
                <div class="formEl">            
                    <label for="vicName">Name</label>
                    <input type="text" name="vicName" id="vicName" value="<?php echo $vicName;?>" />
                    <?php  
                    
                    if($form_submitted){
                    if($vicName == ''){
                        echo "<p  class = 'showError' id= 'name'>Enter a name<p>";
                        echo   ' <script>document.getElementById("vicName").classList.add("errorField");</script> ' ;
                    }else if(isset($formErrors['name'])){
                        echo $formErrors['name'];
                        echo   ' <script>document.getElementById("vicName").classList.add("errorField");</script> ' ;
                            }
                    }
                    ?>
                    
                </div>
                <div class="formEl">            
                    <label for="mobField">Mobile Number</label>
                   <input type="text" name="mob" id="mobField" value="<?php echo $mob;?>"/>
                   <?php  
                    
                    if($form_submitted){
                        if($mob == ''){ 
                            echo "<p class='showError' id='mob'>Enter a mobile number<p>";
                            echo   '<script>document.getElementById("mobField").classList.add("errorField");</script> ' ;
                        }else if(isset($formErrors['mob'])){
                            echo $formErrors['mob'];
                            echo   ' <script>document.getElementById("mobField").classList.add("errorField");
                                </script> ' ;
                        }
                    }
                    ?>
                </div>
             
                   <div>            
                    <label for="reportField">Detailed Report</label>
                    <textarea name="report" class="notesBox" maxlength="400" id="reportField"><?php echo $report; ?></textarea>
                          <?php  
                    
                    if($form_submitted){
                        if($report == ''){ 
                            echo "<p id= 'report'>Enter a detailed report<p>";
                            echo   ' <script>
                                document.getElementById("report").classList.add("showError");
                                document.getElementById("reportField").classList.add("errorField");
                                </script> ' ;
                        }else if(isset($formErrors['report'])){
                            echo $formErrors['report'];
                            echo   ' <script>
                                document.getElementById("report").classList.add("showError");
                                document.getElementById("reportField").classList.add("errorField");
                                </script> ' ;
                        }
                    }
                    ?>
                       
                    </div>
                <div class="formEl">            
                    <input type="submit" name="submit" value="Submit" />
                </div> 
                <div>
                    <?php 
                    
                    if($form_submitted and $errorFound == false){
                        echo" <script>alert('Your report has been logged')</script>";
                        
                    }
                    
                    ?>

                </div>
        </fieldset>
</form>

