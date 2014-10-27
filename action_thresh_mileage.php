<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<?php include 'print_table.php';
	$threshMileage = $_POST["threshMileage"];
	?>

	<?php 
	echo '<h2>List car model, make, sponsor\'s name, and driver\'s name where the car\'s mileage is lower than ' . $threshMileage .  ' miles .</h2>'
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
	$query = "select Mileage from cars";
	$result = mysql_query($query, $link);		
	if (!$result) {die( 'Error in SQL: ' . mysql_error());}

	// echo print_table($result);
	
	$mileage = array();
	while ($row = mysql_fetch_array($result))
	{
        $mileage[] = $row[0];
    }
    // print_r($numPeople);
    // echo $numPitcrew;
    // echo max($numPeople);
	
    if ($threshMileage < min($mileage)) {
    	echo "The lowest mileage of racing cars is " . min($mileage) . " miles !";
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