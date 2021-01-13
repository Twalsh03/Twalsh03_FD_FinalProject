<?php
session_start();
require "../form-functions.php";

    if(!isset($_SESSION["auth"])){
      header('Location: ../index.php');
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Duke of York</title>
    <link href="../stylesheet.css" type="text/css" rel= "stylesheet"/>
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
                <li><a href='staff-home.php'>".$_SESSION["user"]."</a></li>
                <li><a href='../logout.php'>Logout</a></li>";
                
           } else{
                echo"<li><a href='login.php'>Login</a></li>";
            }   ?>
        </ul>
    </nav>
    <nav id="primarynav">
        <ul>
            <li tabindex="1"><a href="../index.php">Home</a></li>
            <li tabindex="2"><a href="../booking.php">Bookings</a></li>
             <li tabindex="3"><a href="../about.php">History</a></li>
            <li tabindex="4"><a href="../contact.php">Contact</a></li>
        </ul>
        <div id="staffNav">
                <ul>
                <li tabindex="5" > <a href="staff-home.php">Staff Home</a></li>
                <li tabindex="6"> <a href="staff-theft.php">Theft Logs</a></li>
                <li tabindex="7"> <a href="staff-bookings.php">All Bookings</a></li>
                <li tabindex="8"> <a href="staff-new.php">New Staff registration</a></li>
                </ul>
        </div>
    </nav>
</header>
<main>
    <h1>Staff Home</h1>
    <div class="panel">

        
    <div>    
        <div class="staffRight">
            <h2>Staff Annoucements</h2>
            <p>Due to Covid19 The duke of york is closed. When the government reopens pubs such as ours then you will be notified via email or whatsApp. Thank You.   </p>
                <p>Management.</p>
        </div>
    
        <div class="staffRight">
            <h2>Upcoming Events</h2>
                <p>When we reopen please be aware of the alohol intake of customers. Also please be vigilant of theives in the area, we are all too aware of the issue. </p>
                    <p>Management.</p>
        </div> 
    </div>  
   
    </div>
</main>
<footer>
     <nav id="footer">
        <ul>
            <li><p>&copy; 2020 TomWalsh.dev</p></li>
            <li><p></p></li>
            <li><p></p></li>
        </ul>
    </nav>
</footer>
</html>
