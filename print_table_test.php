<!-- This script tests the UDF print_tabl($result) from SQL query-->
<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Welcomes to Ketong (Kent) Wang's NASCAR Mini-World</h1> 

  	<?php
  	include 'print_table.php';
	// echo print_table($result);


	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	mysql_select_db('kwang18') or die ('Could not select database');  // see if worked

	// Now the query
	$query = "select * from drivers";     // testit has 2 columns, id and age
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	$ncol = mysql_num_fields($result);
	echo print_table($result);
	mysql_close($link);
	?>
  	<?php include 'footer.php';?>
</div>
</body>




