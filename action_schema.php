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

	<h3>Insert value for each attribute.  </h3><h5>(1) Obey the schema types. (2) Select among available foreign keys if existed</h5>
	
	<?php 
	$query2 = "select * from " . $tableName; 
	$result2 = mysql_query($query2, $link);
	$ncol = mysql_num_fields($result2);
	
	echo '<table>';
	echo '<form method="post" action="action_insert.php">';
	echo '<input type="submit" value="Submit">';
	echo '<tr>';
	// echo the table names default
	echo '<td>' . "<strong>TABLE</strong>" . '</td>'; 
		echo '<td><input type="text" name="args[]" value="'. strtoupper($tableName) .'" ></td>';
	echo '</tr>';
	for ($i = 0; $i < $ncol; $i++) {
		// echo "<th>" . mysql_field_name($result2, $i);	
		echo '<tr>';	
		echo '<td>' . mysql_field_name($result2, $i) . '</td>'; 
		echo '<td><input type="text" name="args[]"></td>';
		echo '</tr>';
	}
	echo '</form>';
	echo '</table>';
	echo '<br></br>';
	?>

	<!-- Print the table schema -->
	<center>
		Schema for table <?php 
		echo strtoupper ($tableName);?>
	</center>
	<br>
	<?php
	echo print_table($result);
	?>
	<br><br>

	<!-- Print foreign key constraints -->
	<center>Valid values for foreign keys (can be empty)
	</center>
	<br>
	<?php
	$fkQuery = "Select REFERENCED_TABLE_NAME,	REFERENCED_COLUMN_NAME, COLUMN_NAME from INFORMATION_SCHEMA.KEY_COLUMN_USAGE where table_schema = 'kwang18' and TABLE_NAME = \"" . $tableName . "\" and REFERENCED_TABLE_NAME is not null";
	$fkResult = mysql_query($fkQuery, $link);
	if (!$fkResult) {die( 'Error in SQL: ' . mysql_error());}
	// echo print_table($fkResult);
	?>

	<!-- print the value of referenced key. Note, only need to print foreign key values in the referenced table. Don't have to be used as foreign key! But "AS" is need to help input-->
	<?php 
	// $rowReference = mysql_fetch_row($fkResult);
	$qTables = array();
	$qcolumns = array();
	// $qConditions = array();
	while($rowReference = mysql_fetch_array($fkResult)) {
		$qTables[] = $rowReference[0];
		$qColumns[] = $rowReference[1]. " as " . $rowReference[2]; 
		// $qConditions[] = $rowReference[0] . "." . $rowReference[1] . "=" . $tableName . "." . $rowReference[2];
		// $refTabQuery = "select " . $rowReference[1] . " as " . $rowReference[2] . " from " . $rowReference[0];
		// $refTabResult = mysql_query($refTabQuery, $link);
		// if (!$refTabResult) {die( 'Error in SQL: ' . mysql_error());}
		// echo print_table($refTabResult);
	}
	$refTabQuery = "select " . implode(", ", $qColumns) . " from " . implode(", ", $qTables);
	// echo $refTabQuery;
	$refTabResult = mysql_query($refTabQuery, $link);
	if (!$refTabResult) {die( 'Error in SQL: ' .mysql_error());}
	echo print_table($refTabResult);
	?>
	

	<?php 
	include 'footer.php';
	mysql_close($link);
	?>

</div>
</body>