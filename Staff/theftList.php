<?php 

$link = connection();
$name= "";
$mobile = 0;
$time ="" ;
$date = "";
$report = "";

$sql = "SELECT * FROM `theft`";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        
        $name =  $row['theft_name'];
        $mobile = $row['theft_mobile'];
        $time = $row['theft_time'];
        $date = $row['theft_date'];
        $dateN = date("d-m-Y", strtotime($date));
        $report = $row['theft_report'];
            
            
            
     echo "
        <div class='theftBox'>
            <div>
                <div class ='theftLeft'>
                    <div class='theftDetails'>
                    <label>Victim's Name</label>
                    <p>".$name."</p>
                    </div>

                    <div class='theftDetails'>
                    <label>Victim's Mobile</label>
                    <p>".$mobile."</p>
                    </div>      

                    <div class='theftDetails'>
                    <p>DATE: ".$dateN."  TIME:  ".$time."</p>
                    </div>

                 </div>
            </div>
        <div class='theftRight'>
            <label >Theft Report</label>
            <p>".$report." </p>
        </div>

        </div>";
            
        }// end of While loop 
        mysqli_close($link);  
    ?>