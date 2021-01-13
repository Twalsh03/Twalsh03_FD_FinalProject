<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
  
        <ul >
            <li tabindex="1" ><a href="index.php">Home</a></li>
            <li tabindex="2" ><a href="booking.php">Bookings</a></li>
             <li tabindex="3"><a href="about.php">History</a></li>
            <li tabindex="4"><a href="contact.php">Contact</a></li>
        </ul>
        <script>
         // When the user scrolls the page, execute fixedNav
            window.onscroll = function() {fixedNav()};

            // Get the navbar
            var navbar = document.getElementById("primarynav");

            // Get the offset position of the navbar
            var sticky = navbar.offsetTop;


            function fixedNav() {
              if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
              } else {
                navbar.classList.remove("sticky");
              }
            } 
            </script>
    </nav>
</header>
<main>

    <div class="background-1"></div>
    <div class="info-Banner"> 
            <div class="panel">
                <img src="img/black-and-red-glass-bottle-3090893.jpg" alt="black-and-red-glass-bottle" class="small">
                <img src="img/guinness-glass-filled-with-beer-2848681.jpg" alt="guinness-glass-filled-with-beer" class="small">
                <img src="img/stay.jpg" alt="stay at home!" class="medium centre">
                
                <ul id="openTimes" class="small">
                    <li>Monday  - CLOSED</li>
                    <li>Tuesday  - CLOSED</li>
                    <li>Wednesday  - CLOSED</li>
                    <li>Thursday  - CLOSED</li>
                    <li>Friday  - CLOSED</li>
                    <li>Saturday  - CLOSED</li>
                    <li>Sunday  - CLOSED</li>
                </ul>
                <img src="img/close-up-photography-of-wine-glasses-1123260.jpg" alt="guinness-glass-filled-with-beer" class="small" >
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

<!-- https://www.w3schools.com/howto/howto_js_navbar_sticky.asp -->