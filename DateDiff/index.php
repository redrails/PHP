<?php

class Duration
{
    
    public $date_1;
    public $date_2;
    
    function __construct($date_1, $date_2){
        
        if(empty($date_1)){
            
            $date = date("Y-m-d");
            $time = date("h:i:s");
            
            $this->datetime = $date ." ". $time;
            
            
            $this->date_1 = $this->datetime;
                     
        } else {
            
            $this->date_1 = $date_1;
            
        }
        
        $this->date_2 = $date_2;
        
    }
    
    function DaysBetween(){
        
        $this->date_1_class = new Datetime($this->date_1);
        $this->date_2_class = new Datetime($this->date_2);
        
        $this->result = $this->date_1_class->diff($this->date_2_class);
        
        return($this->result->format('%d days, %m months, %y years // %h hours, %i minutes, %s seconds'));
    }
    
    
}


if(isset($_POST['calculate'])){
    
    $firstDay = $_POST['day1'];
$firstMonth = $_POST['month1'];
$firstYear = $_POST['year1'];

$secondDay = $_POST['day2'];
$secondMonth = $_POST['month2'];
$secondYear = $_POST['year2'];
    
    if(!empty($firstDay)){
        
        $constructDateOne = "$firstYear-$firstMonth-$firstDay";
        
    } elseif(empty($firstDay) || empty($firstMonth)){
        
        $constructDateOne = "";
        
    }
    
    $constructDateTwo = "$secondYear-$secondMonth-$secondDay";
    
    $constructClass = new Duration($constructDateOne, $constructDateTwo);
    
    $final = $constructClass->DaysBetween();
    
    
}
?>
<html>
 <style type="text/css">
			body{
				background:#EEE;
				color:black; text-shadow:1px 1px 5px grey; font-family:Calibri;
				margin-top:10%; text-align:center;
			}
			
			#box{
				width:100%; border:1px dashed Grey;
				padding-top: 20px;
				height:150px;
			}
			
			input.button{
				color:#EEE; background:Grey; text-shadow:1px 1px 5px grey; font-family:Calibri;
			}
			input.button:hover{
				color:#EEE; background:LightGrey; text-shadow:1px 1px 5px grey; font-family:Calibri;
			}
</style>

    <body>
    <center>
        
        <h1>Duration calculator!</h1><hr /><br>
        <div id="box">
      <table border="1" bordercolor="#FFCC00" style="background-color:#FFFFCC" width="" cellpadding="2" cellspacing="3">

       
        <form action="#" method="post">
            <tr>
                
                <td>Start Date (Day, Month, Year)(Leave empty for today's date): </td> 
                    <td><input type="text" name="day1"></td>
            <td><select name="month1">

                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
         
                </select></td>
            
                <td><input type="text" name="year1">
            </tr>
            <tr>
                <td>End Date (Day, Month, Year):  </td>
                <td><input type="text" name="day2"></td>
            <td><select name="month2">

                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
         
                </select></td>
            
                <td><input type="text" name="year2"></td>
            </tr>
            <tr><td><input type="submit" name="calculate" value="Find Distance!"></td></tr>
            
        </form>
      </table>
        </div>
    </center>
    
    <?php     echo "<h1>". $final ."</h1>"; ?>
    </body>
    
    
</html>
