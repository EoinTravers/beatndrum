<?php
// Resources from a list
function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
}
// Set path to CSV file
$csvFile = 'links.csv';
$csv = readCSV($csvFile);

// Get list of dropbox files from the shared folder
// Based on original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
$url = "https://www.dropbox.com/sh/7d5bs4u2via9mql/6aTpJAU6Nd";
$input = @file_get_contents($url) or die("Could not access file: $url");
$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
if(preg_match_all("/$regexp/siU", $input, $matches))
{
	// Execute if links found
	$all_links = $matches[2];
	$dropbox_files = [];
	for ($i = 0; $i < count($all_links); ++$i)
	{
		$link = $all_links[$i];
		if (substr($link, 0, 5) == 'https')
		{
			array_push($dropbox_files, $link);
		}
	}
}

//~ $table = [];
//~ $dropbox_keys = array('format', 'song', 'type', 'comments', 'url', 'embed');
//~ for ($i= 0; $i < count($dropbox_files); ++$i)
//~ {
	//~ $dropbox_link = $dropbox_files[$i];
	//~ 
	//~ $data = array('file', $d[1], $d[2], $d[4], $d[3]);  
	//~ $row = array_combine($dropbox_keys, $data);
	//~ array_push($table, $row);
//~ }

$table = array();
$dropbox_keys = array('format', 'song', 'type', 'comments', 'url');
for ($i = 0; $i < count($dropbox_files); $i+=2) // Skip every second entry 
{
	$url = $dropbox_files[$i];
	//~ echo $url . PHP_EOL;
	$file = rawurldecode(end(explode('/', $url)));
	$split = explode('#', $file);
	$song = $split[0];
	$metadata = explode('.', $split[1]);
	$type = $metadata[0];
	$extension = $metadata[1];
	// Use: 'file', song, type, extension, url
	$values = array('file', $song, $type, $extension, $url);
	$new_row = array_combine($dropbox_keys, $values);
	//~ print_r($dropbox_keys) . PHP_EOL;
	//~ print_r($values) . PHP_EOL;
	//~ print_r($new_row) . PHP_EOL;
	//~ echo(array_combine($dropbox_keys, $vaues)) . PHP_EOL;
	echo  '' . PHP_EOL;
	//~ print_r($new_row);
	//~ echo $row;
	//~ echo 'foo' . PHP_EOL;
	array_push($table, $new_row);
}

//~ // Add the csv rows
$csv_keys = $csv[0];
//~ print_r($csv_keys);
echo PHP_EOL;
for ($i = 1; $i < count($csv)-1; ++$i)
{
	$data = $csv[$i];
	//~ print_r($data) . PHP_EOL;  
	$new_row = array_combine($csv_keys, $data);
	//~ print_r($new_row);
	//~ echo PHP_EOL;
	array_push($table, $new_row);
}
//~ print_r($table);

function cmp_by_song($a, $b)
{
    return strcmp($a["song"], $b["song"]);
}

usort($table, 'cmp_by_song');
//~ print_r($table);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title>Resources</title>
	   </head>
	   <body>

<h1>Resources</h1>
<table style="width:80%; align:left;">

<?php
echo "<thead>";
foreach (array('song', 'format', 'type', 'comments/filetype', 'instrument') as $key) {
    echo "<th>$key</th>";
}
echo "</thead>";

$last_song = $table[0]['song'];
//~ foreach ($table as $row) // Skip every second entry 
for ($i = 0; $i < count($table); ++$i)
{
	$row = $table[$i];
	
	//~ echo strtolower($row['song']) . PHP_EOL;
	//~ echo strtolower($last_song) . PHP_EOL;
	//~ echo (strtolower($row['song']) != strtolower($last_song)) . PHP_EOL;
	echo "<tr>" . PHP_EOL;
	echo "<td>$row[song]</td>" . PHP_EOL;
	echo "<td>$row[format]</td>" . PHP_EOL;
	echo "<td><a href=$row[url]>$row[type]</a></td>" . PHP_EOL;
	echo "<td>$row[comments]</td>" . PHP_EOL;
	echo "<td>$row[instrument]</td>" . PHP_EOL;
	echo "</tr>" . PHP_EOL;
	// Special row for embedded link types
	if ($row[type] == 'soundcloud' or $row[type] == 'youtube')
	{
		echo "	<tr><td colspan='5'>$row[embed_code]</td></tr>" . PHP_EOL;
	}
	$last_song = $row['song'];
}
?>
</table>
</body>
</html>
