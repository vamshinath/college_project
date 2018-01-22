<?php
        date_default_timezone_set('Asia/Calcutta');
        $curr_time=date('Y-m-d H:i:s');

function get_date_diff( $time1, $time2, $precision = 2 ) {
	// If not numeric then convert timestamps
	if( !is_int( $time1 ) ) {
		$time1 = strtotime( $time1 );
	}
	if( !is_int( $time2 ) ) {
		$time2 = strtotime( $time2 );
	}

	// If time1 > time2 then swap the 2 values
	if( $time1 > $time2 ) {
		list( $time1, $time2 ) = array( $time2, $time1 );
	}

	// Set up intervals and diffs arrays
	$intervals = array( 'year', 'month', 'day', 'hour', 'min', 'second' );
	$diffs = array();

	foreach( $intervals as $interval ) {
		// Create temp time from time1 and interval
		$ttime = strtotime( '+1 ' . $interval, $time1 );
		// Set initial values
		$add = 1;
		$looped = 0;
		// Loop until temp time is smaller than time2
		while ( $time2 >= $ttime ) {
			// Create new temp time from time1 and interval
			$add++;
			$ttime = strtotime( "+" . $add . " " . $interval, $time1 );
			$looped++;
		}

		$time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
		$diffs[ $interval ] = $looped;
	}

	$count = 0;
	$times = array();
	foreach( $diffs as $interval => $value ) {
		// Break if we have needed precission
		if( $count >= $precision ) {
			break;
		}
		// Add value and interval if value is bigger than 0
		if( $value > 0 ) {
			if( $value != 1 ){
				$interval .= "s";
			}
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
		}
	}

	// Return string with times
	return implode( ", ", $times );
}






?>
<html>

	<head>
		<title>E-Bins Monitor</title>
		<meta http-equiv="refresh" content="30"/> <!-- change this -->
		<script src="cvr/bounce.js"></script>
  		<link href="cvr/bounce.css" rel="stylesheet" />

		<link rel="stylesheet" href="cvr/battery_style.css">
		<link href='http://pics.cssbakery.com/pics/css/verticalbargraph.css' rel='stylesheet' type='text/css'/>
		<style type="text/css">
			td
			{
    			padding:0 29px 0 29px;
			}
			html { 
  	background: url(cvr/bg.png) no-repeat center center fixed; 
  	-webkit-background-size: cover;
  	-moz-background-size: cover;
 	 -o-background-size: cover;
  	background-size: cover;
	}



	.topright {
    position: absolute;
    top: 8px;
    right: 16px;
    font-size: 15px;
	}
		</style>


<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>




	</head>


<body onload="startTime()">
	<center>
	<h2>CVR E-Bins</h2>
        <marquee>Welcome</marquee>

	<div id="txt" class="topright"></div></br></br>
	
	<?php 
    	$myfile="PGB.txt";
        $lines=file($myfile);
        $min = get_date_diff($lines[1],$curr_time,1);

		
	?>

	<table>
		<tr>
			<td>
				<p><b>PG Block:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0] ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
	<?php 
    	$myfile="MAI.txt";
	$lines=file($myfile);
    $min = get_date_diff($lines[1],$curr_time,1);
	?>


			<td>
				<p><b>Main Block:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0]; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
	<?php 
    	$myfile="CSE.txt";
	$lines=file($myfile);
    $min = get_date_diff($lines[1],$curr_time,1);
	?>


			<td>
				<p><b>CSE Block:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0]; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
	<?php 
    	$myfile="FIR.txt";
	$lines=file($myfile);
    $min = get_date_diff($lines[1],$curr_time,1);
	?>


			<td>
				<p><b>I yr Block:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0]; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>

	<?php 
    	$myfile="LIB.txt";
	$lines=file($myfile);
    $min = get_date_diff($lines[1],$curr_time,1);
	?>


			<td>
				<p><b>Library:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0]; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>


        <?php 
    	    $myfile="CAN.txt";
	$lines=file($myfile);
    $min = get_date_diff($lines[1],$curr_time,1);
	?>


			<td>
				<p><b>Canteen:</b></p><p><?php echo "Last Updated :".$min; ?></p><p><?php echo "State:" ; $sec =(strtotime($curr_time)-strtotime($lines[1]));if ($sec < 600){
				echo "<b><font color='green'>"." ACTIVE"."</font></b>";} else{ echo "<b><font color='red'>"." INACTIVE"."</font></b>";} ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $lines[0]; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>


			
		</tr>
	</table>
	</center>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script src="cvr/battery_index.js"></script>

</body>
</html>







