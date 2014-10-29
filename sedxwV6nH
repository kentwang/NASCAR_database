<link href="Site.css" rel="stylesheet" type="text/css">
<body>
<div id="main">
	<?php
	function print_table($result){
		$ncol = mysql_num_fields($result);
		echo '<center>';
	  	echo '<table class="gridtable">';		
		
		// print the headers
		echo "<tr>";
		for ($i = 0; $i < $ncol; $i++) {
			echo "<th>" . mysql_field_name($result, $i);
		}
		echo "</tr>";
		
		// print the records
		while ($row = mysql_fetch_array($result))
		{
	        echo '<tr>';
        	for ($j = 0; $j < $ncol; $j++) {
        		echo "<td>" . $row[$j];
        	}
	        echo '</tr>';
	    }

		echo '</table>';
		echo '</center>';
	}
	?>
</div>
</body>