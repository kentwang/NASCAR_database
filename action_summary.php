<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>ALL TABLES</h1> 

	<?php include 'print_table.php';?>

	<!-- establish the link only -->
	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	mysql_select_db('kwang18') or die ('Could not select database');  // see if worked
	?>

	<?php 
	$result = mysql_query("show tables", $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}

	while ($row = mysql_fetch_array($result))
	{
        // select the table
        $tableName = $row[0];
        $subQuery = "Select * from " . $tableName;
        $subResult = mysql_query($subQuery, $link);
        if (!$subResult) {die( 'Error in SQL: ' . mysql_error());}

        // print the whole table
        echo '<center> <h3>Table: ' . strtoupper($tableName) .'</h3></center>';
        echo print_table($subResult);
		echo '<br></br>';
    }
	?>

	
	<?php include 'footer.php';
	mysql_close($link);?>


</div>
</body>