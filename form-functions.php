<?php

function clean_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Connection to database
function connection(){
      //  Database details removed for security reasons.
    $link = mysqli_connect();
    
    return $link;
}
//check for staff member
function authCheck(){
    if(!isset($_SESSION["auth"])){
      header('Location: ../index.php');
    }
    
    //check admin privileges
    if(isset($_SESSION["admin"])){
            if($_SESSION["admin"] == 0){
                header('Location: staff-home.php');
                }   
    }
}

// validation checks
// If validation through regular expresion is fine, true is passed

function validEmail($email){
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function validMobile($num){
    return preg_match('/^[0-9]{11}+$/', $num);
   }

function validName($name){
    return preg_match('/^[a-zA-Z]+(([\/\',. -][a-zA-Z ])?[a-zA-Z]*)*$/', $name);
}

function validNote($notes){
    // maximum of 400 characters 
    return preg_match('/^[a-z\sA-Z0-9\/\'\"\.\,\-\!\?\£\(\)\@]{0,400}$/',$notes);
}

function validDate($dateIn){
    //Any date in this centry is valid
    return preg_match('/^[20]{2}[0-9]{2}[-][0-9]{2}[-][0-9]{2}$/',$dateIn);
}

function validTime($timeIn){
    return preg_match('/^[0,1,2][0-9]{1}[:][0-5]{1}[0-9]{1}$/',$timeIn);
}

function validOption($option){
    return preg_match('/^[0,1]{1}$/',$option);
}


// checking if username exists in database
function userExists($link,$user){
    $sql_u = "SELECT * FROM `staff` WHERE staff_username = '".$user."' ";
    $res_u = mysqli_query($link, $sql_u);
    
    if (mysqli_num_rows($res_u) > 0) {
        mysqli_close($link);
        return true;
    }else{
        mysqli_close($link);
        return false;
    }
}



?>
