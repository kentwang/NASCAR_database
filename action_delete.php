<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<h1>Your query: <?php echo "\"" . $_POST["deleteQuery"] . "\"";?>;</h1>
	<?php 
	include 'print_table.php';
	$deleteQuery = stripslashes($_POST["deleteQuery"]); // strip the slashes in string for quotes
	?>

	<!-- database link  -->
	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }
	mysql_select_db('kwang18') or die ('Could not select database');
	?>

	<?php 
	// can be 0 affected when not exist
	$result = mysql_query($deleteQuery, $link);
	if($result) {
		echo "Deletion is successful!";
	}
	else die( 'Error in SQL: ' . mysql_error());
	?>




	<?php 
	include 'footer.php';	
	// mysql_close($link);
	?>
</div>
</body>