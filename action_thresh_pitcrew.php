<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<?php include 'print_table.php';
	$numPitcrew = $_POST["numPitcrew"];
	?>

	<?php 
	echo '<h2>List driver name, winnings, pitcrew manager\'s name with more than ' . $numPitcrew .  ' pitcrew member(s).</h2>'
	?>
	<hr>

	<!-- Establish the database link -->
	<?php
	$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
	if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

	mysql_select_db('kwang18') or die ('Could not select database');  // see if worked
	?>

	<!-- Check if the argument is valid -->
	<?php
	$query = "select Num_of_people from pitcrew";
	$result = mysql_query($query, $link);		
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}

	// echo print_table($result);
	
	$numPeople = array();
	while ($row = mysql_fetch_array($result))
	{
        $numPeople[] = $row[0];
    }
    // print_r($numPeople);
    // echo $numPitcrew;
    // echo max($numPeople);
	
    if ($numPitcrew > max($numPeople)) {
    	echo "Input for pitcrew threshold is out of range [" . min($numPeople) . ", " . max($numPeople) . "] !";
    } else { // do the join
    	// $subQuery = "Select * from drivers";
    	$subQuery = "Select Name, Winnings, Manager_name from drivers, pitcrew where PC_ID = Pitcrew_ID and Num_of_people > " . $numPitcrew;
    	echo $subQuery;
    	echo '<br></br>';
    	$subResult = mysql_query($subQuery, $link);
		if (!$subResult) {die( 'Error in SQL: ' . mysql_error());}
		echo print_table($subResult);
    }

	?>

	<?php include 'footer.php';
	mysql_close($link);?>


</div>
</body>