<?php
		$username = "vamshi_reader";
		$password = "team1";
		$hostname = "apple.heliohost.org:3306/"; 


		$conn = mysql_connect($hostname, $username, $password) 
		or die("Unable to connect to MySQL");

		

		//include('pi.html')
?>
<html>

	<head>
		<title>E-Bins Monitor</title>
		<meta http-equiv="refresh" content="60"/> <!-- change this -->


		<link rel="stylesheet" href="battery_style.css">
		<link href='http://pics.cssbakery.com/pics/css/verticalbargraph.css' rel='stylesheet' type='text/css'/>
		<style type="text/css">
			td
			{
    			padding:0 29px 0 29px;
			}
			html { 
  	background: url(bg.png) no-repeat center center fixed; 
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
	<div id="txt" class="topright"></div></br></br>
	
	<!--<div class="avatar-container p-<?php
		$rs=mysql_query('select *from vamshi_team1db.table1 ORDER BY date DESC');
    	$row = mysql_fetch_array($rs);
		echo $row['percentage']

	?>">
		<img src="https://s3.amazonaws.com/uifaces/faces/twitter/soffes/128.jpg" alt="" class="avatar"/>
	</div>

	<div class="avatar-container p-34">
  		<img src="https://s3.amazonaws.com/uifaces/faces/twitter/soffes/128.jpg" alt="" class="avatar"/>
	</div>

  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="js/index.js"></script> -->
	<?php 
    	$row = mysql_fetch_array(mysql_query('select *from vamshi_team1db.PGB ORDER BY date DESC'));
		
	?>

	<table>
		<tr>
			<td>
				<p>PG Block:</p><p><?php echo "Last Updated at:".split(" ",$row['date'])[1]; ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $row['percentage']; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
	<?php 
    	$row = mysql_fetch_array(mysql_query('select *from vamshi_team1db.MAI ORDER BY date DESC'));
		
	?>


			<td>
				<p>Main Block:</p><p><?php echo "Last Updated at:".split(" ",$row['date'])[1]; ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $row['percentage']; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
	<?php 
    	$row = mysql_fetch_array(mysql_query('select *from vamshi_team1db.CSE ORDER BY date DESC'));
		
	?>


			<td>
				<p>CSE Block:</p><p><?php echo "Last Updated at:".split(" ",$row['date'])[1]; ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $row['percentage']; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>

	<?php 
    	$row = mysql_fetch_array(mysql_query('select *from vamshi_team1db.LIB ORDER BY date DESC'));
		
	?>


			<td>
				<p>Library:</p><p><?php echo "Last Updated at:".split(" ",$row['date'])[1]; ?></p><div id="bin" class="battery" data-max="100" data-fill="<?php echo $row['percentage']; ?>">
			<div></div><div></div><div></div><div></div><div></div><div></div>
			</div>
			</td>
			<?php mysql_close($conn) ?>
			
		</tr>
	</table>
	</center>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

	<script src="battery_index.js"></script>

</body>
</html>







