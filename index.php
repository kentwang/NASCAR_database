<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Welcomes to Ketong (Kent) Wang's NASCAR Mini-World</h1> 

	<?php include 'print_table.php';?>

  	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	// Select DB will use
	mysql_select_db('kwang18') or die ('Could not select database');  // see if worked

	// Now the query
	$query = "Show tables";     // testit has 2 columns, id and age
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	$ncol = mysql_num_fields($result);
	mysql_close($link);
	?>

	<!-- print the table list -->
	<?php echo print_table($result);?>
	<!-- Result is empty after print. Maybe mysql_fetch_array -->
	<?php echo '<center> <h3>LIST OF TABLES</h3> </center>';?>
	
	<br>
	<br>

	<hr>
	<h2>Show Data</h2>
	<ul>
		<li>
			<form action="action_summary.php">
				Print all table. Caution! <input type="submit" value="Print All">
			</form>
		</li>
		<li>
			<form method="post" action="action_select.php">
				One table only: <input type="text" name="tableName">
				<input type="submit" value="Submit">
			</form>
		</li>
	</ul>

	<hr>
	<h2>Try a Query</h2>
	<ul>
		<li>
			<form method = "post", action="action_thresh_pitcrew.php">
				List driver name, winnings, pitcrew manager's name with more than  <input type="text" name="numPitcrew">  pitcrew member(s).
				<input type="submit" value="Submit">
			</form>
		</li>
		<li>
			<form method="post" action="action_thresh_mileage.php">
				List driver's name, car model, make, sponsor's name, and driver's name where the car's mileage is lower than <input type="text" name="threshMileage"> miles.
				<input type="submit" value="Submit">
			</form>
		</li>
	</ul>
	<hr>

	<h2>Insert Tuple into Table</h2>
	<form method="post" action="action_schema.php">
		Input a table name to insert <input type="text" name="tableName"> 
		<input type="submit" value="Submit"> (Note: Table schema will be displayed after submission.)
	</form>
	<hr>

	<h2>Type in a SELECT Query</h2>
	<form method="post" action="action_selectQ.php">
		What's your SELECT query? (on only one table) <input type="text" name="selectQuery" size = "50"> 
		<input type="submit" value="Submit">
	</form>
	<hr>

	<h2>Delete Tuples From a Table</h2>
	<form method="post" action="action_delete.php">
		Your delete query (e.g. DELETE FROM cars WHERE model = "creepy car") <input type="text" name="deleteQuery" size = "50"> 
		<input type="submit" value="Submit">
	</form>
	<hr>

  	<?php include 'footer.php';?>
</div>
</body>




