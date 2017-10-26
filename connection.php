<?php
// untuk menghubungkan ke database,.
	ob_start();
	$dbserver	="localhost";
	$dbusername	="root";
	$dbpassword	="";
	$dbname		="voicenote";
	mysql_connect($dbserver,$dbusername,$dbpassword) or die(mysql_error()." Connection to server mysql Failed");
	mysql_select_db($dbname) or die (mysql_error()."Connection to Database Failed");
	
?>