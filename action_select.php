<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<?php include 'print_table.php';?>

	<?php
	echo '<h1>Query: SELECT * FROM ' . $_POST["tableName"] . '</h1>';
	?>

	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "usrname", "passwd");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	mysql_select_db('usrname18') or die ('Could not select database');  // see if worked

	// Now the query
	$query = "select * from " . $_POST["tableName"];     // testit has 2 columns, id and age
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	$ncol = mysql_num_fields($result);
	mysql_close($link);
	?>

	<?php 
  	echo '<center>';
  	echo '<h3>' . $_POST["tableName"] . '</h3>';
	echo '</center>';
	echo print_table($result);
	?>
	<?php include 'footer.php';?>


</div>
</body>