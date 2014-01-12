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
	<div id="table_div">Hello
	</div>
	<div>
		<?php
			echo "<table>" . PHP_EOL;
			// Headings
			$row = mysqli_fetch_assoc($result);
			$headings = array_keys($row);
			foreach ($headings as $head) {
					echo "	<th>" . $head . "</th>" . PHP_EOL;
				};
			mysqli_data_seek($result, 0);
			
			while($row = mysqli_fetch_assoc($result)){
				echo "	<tr>" . PHP_EOL;
				foreach ($row as $col) {
					echo "		<td>" . $col . "</td>" . PHP_EOL;
				};
				echo "	</tr>" . PHP_EOL;
			};
			echo "</table>";
		?>
	</div>
<script src="js/main.js"></script>	
</body>
</html>
