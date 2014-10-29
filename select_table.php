<?php
echo "Welcome to Ketong(Kent) Wang's DB";
// Connect to MySQL
$link = mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
if (!$link) {die('Not connected: '. mysql_error()); }  // see if connected

// Select DB will use
mysql_select_db('kwang18') or die ('Could not select database');  // see if worked

// Now the query
$query = "Select * from drivers";     // testit has 2 columns, id and age
$result = mysql_query($query, $link);
if (!$result) {die( 'Error in SQL: ' . mysql_error());}
$ncol = mysql_num_fields($result);

// process results using cursor
echo "<b>
<center>Database Output</center>
</b>
<br>
<br>"; 

echo "<table>";

// print field names
for ($i = 0; $i < $ncol; $i++) {
  echo "<tr>" . mysql_field_name($result, $i). " ";
}

while ($row = mysql_fetch_array($result))
{
        echo "<tr><td>" .$row["Driver_ID"]. "<br />";
        echo "Id: ". $row["Driver_ID"] . "<br />";
        echo "Name: " . $row["Name"] .  "<br />";
        echo "Date of Birth: " . $row["DOB"] .  "<br />";
        echo "Rank: " . $row["Rank"] .  "<br />";
        echo "Winnings: " . $row["Winnings"] .  "<br />";
        echo "pitcrew ID: " . $row["PC_ID"] .  "<br />";
}
echo "</table>";

mysql_free_result ($result);
mysql_close($link);   // disconnecting from MySQL
?>
