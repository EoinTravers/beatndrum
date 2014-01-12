<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title>Resources</title>
<!--
	    <link rel="stylesheet" type="text/css" href="style.css">
-->
<?php
	$host = "localhost";
	$database = "beatndrum";
	$username = "root";
	// Get password from a seperate file
	include 'password.php';
	//~ <files password.php>
	//~ order allow,deny
	//~ deny from all
	//~ </files>
		    
	$mysqli = new mysqli($host, $username, $password, $database);
	if (mysqli_connect_error()) {
	    die('Connect Error (' . mysqli_connect_errno() . ') '
	            . mysqli_connect_error());
	}
	$result = $mysqli->query("SELECT * FROM resources ORDER BY song");
	$mysqli->close();
?>
<script type = "text/javascript">
	var table_data = [];
	

<!--
<?php
// Pass variables to Javascript
	//~ while($row = mysqli_fetch_array($result))
	  //~ {
		  //~ echo "var row = " . json_encode($row) . ";" . PHP_EOL;
		  //~ echo 'table_data.push(row);' . PHP_EOL;
	  //~ };
?>
-->
</script>
	

	    
	    
</head>

<body>
<h1>Resources</h1>
	<div>
		<?php
			echo PHP_EOL;
			echo "<table>" . PHP_EOL;
			// Headings
			echo "<thead><tr>" . PHP_EOL;
			$row = mysqli_fetch_assoc($result);
			$headings = array_keys($row);
			foreach ($headings as $head) {
					echo "	<th>" . $head . "</th>" . PHP_EOL;
				};
			echo "</tr></thead>" . PHP_EOL;
			mysqli_data_seek($result, 0);
			
			while($row = mysqli_fetch_assoc($result)){
				echo "	<tr>" . PHP_EOL;
				// Print a row of information for every format
				foreach ($row as $col) {
					echo "		<td>" . $col . "</td>" . PHP_EOL;
				};
				// Implement a different protocol for sound kind of media
				if ($row['type'] == 'soundcloud'){
					// Soundcloud widget
					echo "	</tr>". PHP_EOL;
					echo "	<tr>". PHP_EOL;
					echo '		<td colspan="6"><iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/125177845&amp;color=ff6600&amp;auto_play=false&amp;show_artwork=true"></iframe></td>';
				} elseif ($row['type'] == 'file'){
					echo "	<tr><td colspan='6'><a href='" . $row['url'] . "'>FILE</a></td></tr>" . PHP_EOL;
				echo "	</tr>" . PHP_EOL;
					};
				};
			echo "</table>";
		?>
	</div>
<script src="js/main.js"></script>	
</body>
</html>
