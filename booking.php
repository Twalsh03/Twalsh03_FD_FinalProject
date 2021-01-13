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
                echo"<li tabindex='0' ><a href='login.php'>Login</a></li>";
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
    <div class="background-3"></div>
    <div class="panel">
    <h1> Make a booking with us! </h1>
            <p class="notice"> Our spacious function room can be reserved for your every need. If you need us for birthday's, retirement parties or even a busieness meeting. Let is know in advance and we will get in touch!  </p>
    

        <?php require "booking-new.php";?>
    <p class="notice">Please be aware, booking will not be confirmed until you are contacted by a member of staff. </p>
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
