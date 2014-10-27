<?php
$link=mysql_connect("vrbsky-oracle.cs.ua.edu", "kwang", "11499864");
$query = 'CREATE database kwang18_createDB_2';
$result = mysql_query($query, $link);
if(!$result) {die( 'Error in SQL: ' . mysql_error());}
mysql_close($link);
?>
