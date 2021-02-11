<html>
<head>
<meta name="viewport" content="width=device-width" />
<title>Wahida's RPi Garden</title>
<style>
    body {
	background-color: lightblue;
    }
    .button1 {
	  background-color: white;
	  border: 2px solid #008CBA;
	  color: black;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  cursor: pointer;
    }

    .button2 {
	  background-color: white;
	  border: 2px solid black;
	  color: black;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 4px 2px;
	  cursor: pointer;
    }
</style>

</head>
<body>
<center>
    <h1>Whassup Gardening Nerd</h1></br></br>      
         <form method="get" action="index.php">                
            <h3>Press to manually water plants:</h3>
	    <input class="button1" type="submit" style="font-size: 14pt" value="On pump (5 secs)" name="pumpOn">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button1" type="submit" style="font-size: 14pt" value="Off pump" name="pumpOff">
	    
	    </br></br>
	    <h3>Press to manually cool box:</h3>
	    <input class="button2" type="submit" style="font-size: 14pt" value="On fan" name="fanOn">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="button2" type="submit" style="font-size: 14pt" value="Off fan" name="fanOff">
         </form>​​​

<?php
    
    //we use physical pin 3 (GPIO 2) to control IN1 of relay (controls pump)
    system("gpio -g mode 2 out");
    
    //we use physical pin 7 (GPIO 4) to control IN2 of relay (controls fan)
    system("gpio -g mode 4 out");
    
    if(isset($_GET['pumpOn']))
    {
	$txt1 = "pump was activated at ".date('h:i:s');
	echo $txt1;
	system("gpio -g write 2 0");
	sleep(5); //pump is activated for n seconds
	
	$txt2 = "</br>pump was deactivated at ".date('h:i:s')."</br>";
	echo $txt2;
	system("gpio -g write 2 1");
    }
    
    else if(isset($_GET['pumpOff']))
    {
	system("gpio -g write 2 1");
    }
 
    else if(isset($_GET['fanOn']))
    {
	echo "Status: Fan is on from ". date("d-M-Y h:i:sa");
	system("gpio -g write 4 0");
    } 
      
    else if(isset($_GET['fanOff']))
    {
	system("gpio -g write 4 1");
    }
    
    else
    {
	echo "";
    }

//read last line of watering log to show when it was last autowatered
 
$line = '';
$f = fopen('/home/pi/watering_log.txt', 'r');
$cursor = -1;
fseek($f, $cursor, SEEK_END);
$char = fgetc($f);
//Trim trailing newline characters in the file
while ($char === "\n" || $char === "\r") {
   fseek($f, $cursor--, SEEK_END);
   $char = fgetc($f);
}
//Read until the next line of the file begins or the first newline char
while ($char !== false && $char !== "\n" && $char !== "\r") {
   //Prepend the new character
   $line = $char . $line;
   fseek($f, $cursor--, SEEK_END);
   $char = fgetc($f);
}
echo '</br></br><h3>Last auto-watered:</h3> <p>'.$line.'</p>';
    
?>
</center>
</body>
</html>
