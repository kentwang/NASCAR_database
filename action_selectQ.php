<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Your query: <?php echo "\"" . $_POST["selectQuery"] . "\"";?>;</h1>
	<?php 
	include 'print_table.php';
	$selectQuery = stripslashes($_POST["selectQuery"]); // strip the slashes in string for quotes
	?>


	<!-- database link  -->
	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }
	mysql_select_db('kwang18') or die ('Could not select database');
	?>

	<!-- query result -->
	<?php 
	$result = mysql_query($selectQuery, $link);
	if (!$result) {
		echo 'Error in SQL: ' . mysql_error();
		echo "<h3>Please check your query on the following table!</h3>";
		$qArray = explode(" ", $selectQuery);
		$tablePos = array_search("from", $qArray) + 1;
		$tableName = $qArray[$tablePos];
		echo '<center>' . strtoupper($tableName) . '</center>';
		$subSelectQuery = "select * from " . $tableName;
		$subSelectResult = mysql_query($subSelectQuery, $link);
		// echo $subSelectQuery;
		echo print_table($subSelectResult);
	}
	else echo print_table($result);
	?>
	<br>

	<hr>

	<h2>Type in a SELECT Query</h2>
	<form method="post" action="action_selectQ.php">
		Input your SELECT query again? (on only one table)<input type="text" name="selectQuery" size = "50"> 
		<input type="submit" value="Submit">
	</form>
	<hr>

	<?php 
	include 'footer.php';	
	mysql_close($link);
	?>
</div>
</body>