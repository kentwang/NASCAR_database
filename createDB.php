<?php
$link=mysql_connect("vrbsky-oracle.cs.ua.edu", "usrname", "passwd");
$query = 'CREATE database usrname18_createDB_2';
$result = mysql_query($query, $link);
if(!$result) {die( 'Error in SQL: ' . mysql_error());}
mysql_close($link);
?>
