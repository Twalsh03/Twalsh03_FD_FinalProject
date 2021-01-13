<?php
$link = connection();

$date = "";
$dateN = "";
$name = "";
$mobile = 0;
$text = "";
$buf = 0;
$bar = 0;
$email = "";

 $sql = "SELECT * FROM `bookings`";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            
            $date = $row["booking_date"];
            $name = $row["booking_name"];
            $mobile = $row["booking_mobile"];
            $text = $row["booking_notes"];
            $buf = $row["booking_buffet"];
            $bar = $row["booking_bar"];
            $email = $row["booking_email"];
            $text = $row["booking_notes"];
            
            if($bar == 0){
                $bar = "No";
            }else{
                $bar = "Yes";
            }
            
            if($buf == 0){
                $buf = "No";
            }else{
                $buf = "Yes";
            }
            
            
            $dateN = date("d-m-Y", strtotime($date));
            
              echo "

                <div class='booking'>
    
    
                    <h3 class='bookDate'>DATE: ".$dateN."</h3>
                    <h2 class = 'bookDate'>CONTACT: ".$name." </h2>
    
                    <div class='bookleft' >
                        <label class='bookEmail'>EMAIL:</label>
                        <p class='bookEmail'>".$email."</p>
    
                        <p class='bookMob'>MOBILE:</p>
                        <p class='bookMob'>".$mobile."</p>
                </div>
     
                <div class ='bookright'>
                    <label class='bookBar'>Bar open?</label>
                    <p class='bookBar'>".$bar."</p>
    
                    <label class='buffet'>buffet Requested</label>
                    <p class='buffet'>".$buf."</p>
                </div>
     
                <p class='text'>".$text." </p>
    
            </div> ";  

            
            }//end of while loop
mysqli_close($link);


?>