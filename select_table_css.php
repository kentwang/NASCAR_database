<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Welcomes to Ketong (Kent) Wang's Database</h1> 
  	<h2>Table Dispaly</h2>

  	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "usrname", "passwd");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	// Select DB will use
	mysql_select_db('usrname18') or die ('Could not select database');  // see if worked

	// Now the query
	$query = "Select * from drivers";     // testit has 2 columns, id and age
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	$ncol = mysql_num_fields($result);
	?>

	<?php 
  	echo '<center>';
  	echo '<h3>Table: DRIVERS</h3>';
  	echo '<table class="gridtable">';
	echo '<tr>';
	for ($i = 0; $i < $ncol; $i++) {
		echo "<th>" . mysql_field_name($result, $i);
	}
	echo '</tr>';

  	// echo '<tr>'; echo '<th>' . "LIST OF TABLES"; echo '</tr>';
	while ($row = mysql_fetch_array($result))
	{
        echo '<tr>';
        	for ($i = 0; $i < $ncol; $i++) {
				echo "<td>" . $row[$i];
			}
        echo '</tr>';
    }

	echo '</table>';
	echo '</center>';
	mysql_close($link);
	?>
	<?php include 'footer.php';?>

  	
</div>
</body>