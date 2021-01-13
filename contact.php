<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Duke of York</title>
    <link href="stylesheet.css" type="text/css" rel= "stylesheet"/>
    <link href="https://fonts.google.com/specimen/Open+Sans?selection.family=Open+Sans" rel="stylesheet">
</head>
<header>
        <!-- Social Media links  -->
    <div class="social">
         <!-- Facebook-->
    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=155&layout=button&action=recommend&size=small&share=true&height=65&appId" width="155" height="65" style="border:none;overflow:hidden" allow="encrypted-media"></iframe>
    </div>
  <nav id="headerlinks">
        <ul>
            <?php if(isset($_SESSION["auth"])){
                echo"
                <li tabindex='0'><a href='staff/staff-home.php'>".$_SESSION["user"]."</a></li>
                <li tabindex='0'><a href='logout.php'>Logout</a></li>";
                
           } else{
                echo'<li tabindex="0" id="login"><a href="login.php">Login</a></li>';
            }   ?>
        </ul>
            <div class="title" >The Duke Of York</div>
    </nav>
    <nav id="primarynav">
        <ul>
             <li tabindex="1" ><a href="index.php">Home</a></li>
            <li tabindex="2" ><a href="booking.php">Bookings</a></li>
             <li tabindex="3"><a href="about.php">History</a></li>
            <li tabindex="4"><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="panel">
    <h1> How to reach us</h1>
    
    <p class="notice" > If you have any questions or queries, please don't hesitate to ask!</p>
        <div class="textBox">
            <label >Phone:</label>
            <p>  020 7636 7065 </p>
            <p>  EMAIL: sophhie@duke.com </p>
            <p >Address: <br>
                47 Rathbone St <br>
                Fitzrovia,<br>
                LONDON <br>
               W1T 1NW<br>
                </p>
        </div>
    </div>
</main>
<footer>
     <nav id="footer">
        <ul>
            <li><p>&copy; 2020 TomWalsh.dev</p></li>
     
        </ul>
    </nav>
</footer>
</html>
