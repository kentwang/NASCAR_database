<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Result from insertion</h1>
	<?php
	include 'print_table.php';
	$args = $_POST["args"];
	$tableName = array_shift($args);
	// echo implode(', ', $args);
	// echo $tableName;
	// echo gettype($args[0]);
	?>

	<!-- query -->
	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "usrname", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }
	mysql_select_db('usrname18') or die ('Could not select database');
	?>

	<!-- append quotes in the char -->
	<?php
	$schema = mysql_query("describe " . $tableName, $link);
	// echo print_table($schema);
	$nrow = mysql_num_rows($schema);
	
	$i = 0;
	while($row = mysql_fetch_array($schema)) {
		if(strpos($row['Type'], 'char') !== FALSE or strpos($row['Type'], 'date') !== FALSE) // trick copmarison. 0 can be stil valid
			$args[$i] = '\'' . $args[$i] . '\'';
		$i++;
	}
	?>

	<?php
	$query = "insert into " . $tableName . " values (" . implode(', ', $args) . ")"; 
	// echo $query;
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	else echo 'Insertion is successful!';

	if(strpos(mysql_error(), 'FOREIGN KEY') !== FALSE) {
		
	}
	?>

	
	<?php 
	// $query2 = "Select * from " . $tableName;
	// $result2 = mysql_query($query2, $link);
	// if (!$result2) {die( 'Error in SQL: ' . mysql_error());}
	// echo print_table($result2);
	?>






	<?php 
	include 'footer.php';	
	mysql_close($link);
	?>
</div>
</body>