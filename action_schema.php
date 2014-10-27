<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	

	<?php include 'print_table.php';
	$tableName = $_POST["tableName"];?>

	<h1>
		Insertion into table
		<?php 
		echo strtoupper($tableName);
		?>
	</h1>

	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }
	mysql_select_db('kwang18') or die ('Could not select database'); 
	$query = "describe " . $tableName; 
	$result = mysql_query($query, $link);
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}
	?>

	<!-- Print the table schema -->
	<center>
		Schema for table <?php 
		echo strtoupper ($tableName);?>
	</center>
	<?php
	echo print_table($result);
	?>
	<br></br>
	<h3>Insert value for each attribute based on the table schema above</h3>

	<?php 
	$query2 = "select * from " . $tableName; 
	$result2 = mysql_query($query2, $link);
	$ncol = mysql_num_fields($result2);
	
	echo '<table>';
	echo '<form action="demo_form.asp">';
	for ($i = 0; $i < $ncol; $i++) {
		// echo "<th>" . mysql_field_name($result2, $i);	
		echo '<tr>';	
		echo '<td>' . mysql_field_name($result2, $i) . '</td>'; 
		echo '<td><input type="text" name="args[]"></td>';
		echo '</tr>';
	}
	echo '</form>';
	echo '</table>'
	?>

	<?php 
	include 'footer.php';
	mysql_close($link);
	?>

</div>
</body>